<?php

namespace App\Modules\Auth\Http\Services\Api\V1\Auth;

use App\Modules\Auth\Http\Resources\V1\User\UserResource;
use App\Modules\Auth\Http\Services\Api\V1\Auth\Otp\OtpService;
use App\Modules\Auth\Repository\UserRepositoryInterface;

use function App\Modules\Base\Http\Helpers\responseFail;
use function App\Modules\Base\Http\Helpers\responseSuccess;

use Illuminate\Support\Facades\Hash;

class PhoneAuthService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly OtpService $otpService,
    ) {}

    public function sendOtp($request)
    {
        $phone = $request->phone;

        return $this->otpService->sendPhoneOtp($phone);
    }

    public function verifyOtpAndAuth($request)
    {
        $phone = $request->phone;
        $code = $request->code;
        $name = $request->name;

        // Verify OTP
        $otpVerified = $this->otpService->verifyPhoneOtp($phone, $code);

        if ($otpVerified !== true) {
            return $otpVerified; // Return error response
        }

        // Check if user exists
        $user = $this->userRepository->findByPhone($phone);

        if (! $user) {
            // Register new user
            if (! $name) {
                return responseFail(message: __('messages.Name is required for registration'));
            }

            $user = $this->userRepository->create([
                'name' => $name,
                'phone' => $phone,
                'phone_verified_at' => now(),
                'email' => null,
                'password' => Hash::make(uniqid()),
            ]);

            $message = __('messages.Registration successful');
        } else {
            // Login existing user
            $user->update([
                'phone_verified_at' => now(),
            ]);

            $message = __('messages.Login successful');
        }

        // Generate Sanctum token
        $token = $user->createToken('mobile-app')->plainTextToken;

        return responseSuccess(
            message: $message,
            data: [
                'user' => new UserResource($user, true),
                'token' => $token,
                'token_type' => 'bearer',
            ]
        );
    }

    public function resendOtp($request)
    {
        return $this->sendOtp($request);
    }
}
