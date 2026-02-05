<?php

namespace App\Modules\Auth\Http\Services\Api\V1\Auth;

use App\Modules\Auth\Http\Requests\Api\V1\Auth\SignInRequest;
use App\Modules\Auth\Http\Requests\Api\V1\Auth\SignUpRequest;
use App\Modules\Auth\Http\Services\Api\V1\Auth\Otp\OtpService;
use App\Modules\Auth\Repository\OtpRepositoryInterface;
use App\Modules\Auth\Repository\UserRepositoryInterface;
use App\Modules\Base\Http\Helpers\Http;

use function App\Modules\Base\Http\Helpers\responseFail;
use function App\Modules\Base\Http\Helpers\responseSuccess;

use App\Modules\Base\Http\Traits\FileTrait;
use App\Modules\Base\Services\PlatformService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends PlatformService
{
    use FileTrait;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly OtpService $otpService,
        private readonly OtpRepositoryInterface $otpRepository,
    ) {}

    public function signUp(SignUpRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            // Check if phone already exists
            $existingUser = $this->userRepository->findByPhone($data['phone']);
            if ($existingUser) {
                DB::rollBack();

                return responseFail(Http::BAD_REQUEST, __('messages.Phone already exists'));
            }

            // Create user without email/password
            $userData = [
                'name' => $data['name'],
                'phone' => $data['phone'],
                'status' => 'active',
            ];

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $userData['profile_image'] = $this->image(
                    $request->file('profile_image'),
                    'profiles/users/images'
                );
            }

            $user = $this->userRepository->create($userData);

            // Generate OTP for phone
            $otp = $this->otpRepository->generateOtpForPhone($data['phone']);

            // Create JWT token
            $token = JWTAuth::fromUser($user);

            DB::commit();

            return responseSuccess(Http::CREATED, __('messages.created successfully'), [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'status' => $user->status,
                'otp_token' => $otp->token ?? null,
                'otp_verified' => false,
                'token' => $token,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Sign Up Error: '.$e->getMessage());
            Log::error('Stack trace: '.$e->getTraceAsString());

            return responseFail(Http::BAD_REQUEST, __('messages.Something went wrong').': '.$e->getMessage());
        }
    }

    public function verifySignUpOtp($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            // Find user by phone
            $user = $this->userRepository->findByPhone($data['phone']);
            if (! $user) {
                return responseFail(Http::NOT_FOUND, __('messages.User not found'));
            }

            // Verify OTP
            $isValid = $this->otpRepository->verifyPhoneOtp($data['phone'], $data['code']);
            if (! $isValid) {
                return responseFail(Http::BAD_REQUEST, __('messages.Invalid or expired OTP'));
            }

            // Mark phone as verified
            $user->update(['phone_verified_at' => now()]);

            // Create Sanctum token
            $token = $user->createToken('mobile-app')->plainTextToken;

            DB::commit();

            return responseSuccess(Http::OK, __('messages.Phone verified successfully'), [
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'phone_verified_at' => $user->phone_verified_at,
                ],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return responseFail(Http::BAD_REQUEST, __('messages.Something went wrong'));
        }
    }

    public function signIn(SignInRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            // Find user by phone
            $user = $this->userRepository->findByPhone($data['phone']);
            if (! $user) {
                return responseFail(Http::NOT_FOUND, __('messages.User not found'));
            }

            // Generate OTP for phone
            $otp = $this->otpRepository->generateOtpForPhone($data['phone']);

            // Create JWT token
            $token = JWTAuth::fromUser($user);

            DB::commit();

            return responseSuccess(Http::CREATED, __('messages.created successfully'), [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'status' => $user->status,
                'otp_token' => $otp->token ?? null,
                'otp_verified' => $user->otp_verified ?? false,
                'token' => $token,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Sign In Error: '.$e->getMessage());

            return responseFail(Http::BAD_REQUEST, __('messages.Something went wrong').': '.$e->getMessage());
        }
    }

    public function signOut()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return responseSuccess(Http::OK, __('messages.Successfully loggedOut'));
        } catch (Exception $e) {
            return responseFail(Http::BAD_REQUEST, __('messages.Something went wrong'));
        }
    }

    public function whatIsMyPlatform(): string
    {
        return 'platform: api';
    }

    public static function platform(): string
    {
        return 'api';
    }
}
