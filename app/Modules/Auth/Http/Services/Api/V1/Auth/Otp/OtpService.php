<?php

namespace App\Modules\Auth\Http\Services\Api\V1\Auth\Otp;

use App\Modules\Auth\Http\Resources\V1\Otp\OtpResource;
use App\Modules\Auth\Models\Otp;
use App\Modules\Auth\Repository\OtpRepositoryInterface;

use function App\Modules\Base\Http\Helpers\responseFail;
use function App\Modules\Base\Http\Helpers\responseSuccess;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OtpService
{
    public function __construct(
        private readonly OtpRepositoryInterface $otpRepository,
    ) {}

    public function generate($user = null)
    {
        $otp = $this->otpRepository->generateOtp($user);
        auth('api')->user()?->update([
            'otp_verified' => false,
        ]);

        // TODO :Sending OTP in email
        return responseSuccess(message: __('messages.OTP_Is_Send'), data: OtpResource::make($otp));
    }

    public function verify($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();

            $user = auth('api')->user();

            if (! $user) {
                return responseFail(message: __('messages.Unauthorized'));
            }

            // Check OTP using phone-based verification
            $isValid = Otp::where('token', $data['otp_token'])
                ->where('code', $data['otp'])
                ->where('identifier', $user->phone)
                ->where('type', 'phone')
                ->where('expires_at', '>', now())
                ->exists();

            if (! $isValid) {
                return responseFail(message: __('messages.Wrong OTP code or expired'));
            }

            // Delete OTPs
            Otp::where('identifier', $user->phone)
                ->where('type', 'phone')
                ->delete();

            $user->update([
                'otp_verified' => true,
                'phone_verified_at' => now(),
            ]);

            DB::commit();

            return responseSuccess(message: __('messages.Your account has been verified successfully'), data: [
                'otp_verified' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'otp_verified' => true,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('OTP Verify Error: '.$e->getMessage());

            return responseFail(message: __('messages.Something went wrong').': '.$e->getMessage());
        }
    }

    public function sendPhoneOtp($phone)
    {
        $otp = $this->otpRepository->generateOtpForPhone($phone);

        // TODO: Send OTP via SMS service (Twilio, Nexmo, etc.)

        return responseSuccess(
            message: __('messages.OTP_Is_Send'),
            data: [
                'phone' => $phone,
                'otp' => $otp->code, // REMOVE IN PRODUCTION!
                'expires_in_minutes' => 5,
            ]
        );
    }

    public function verifyPhoneOtp($phone, $code)
    {
        $otp = $this->otpRepository->verifyPhoneOtp($phone, $code);

        if (! $otp) {
            return responseFail(message: __('messages.Wrong OTP code or expired'));
        }

        // Delete used OTP
        $otp->delete();

        return true;
    }
}
