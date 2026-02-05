<?php

namespace App\Modules\Auth\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\Api\V1\Auth\PhoneSendOtpRequest;
use App\Modules\Auth\Http\Requests\Api\V1\Auth\PhoneVerifyOtpRequest;
use App\Modules\Auth\Http\Services\Api\V1\Auth\PhoneAuthService;

/**
 * @group Phone Authentication
 *
 * OTP-based phone authentication for mobile applications
 */
class PhoneController extends Controller
{
    public function __construct(
        private readonly PhoneAuthService $phoneAuthService,
    ) {}

    /**
     * Send OTP
     *
     * Send an OTP code to the provided phone number.
     *
     * @bodyParam phone string required The phone number (11 digits). Example: 01012345678
     *
     * @response 200 {
     *   "status": 200,
     *   "message": "تم إرسال رمز التحقق بنجاح",
     *   "data": {
     *     "otp_token": "abc123"
     *   }
     * }
     */
    public function sendOtp(PhoneSendOtpRequest $request)
    {
        return $this->phoneAuthService->sendOtp($request);
    }

    /**
     * Verify OTP
     *
     * Verify the OTP code and authenticate the user.
     *
     * @bodyParam phone string required The phone number. Example: 01012345678
     * @bodyParam code string required The OTP code. Example: 123456
     *
     * @response 200 {
     *   "status": 200,
     *   "message": "تم التحقق بنجاح",
     *   "data": {
     *     "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
     *     "user": {
     *       "id": 1,
     *       "name": "Ahmed Mohamed",
     *       "phone": "01012345678"
     *     }
     *   }
     * }
     */
    public function verifyOtp(PhoneVerifyOtpRequest $request)
    {
        return $this->phoneAuthService->verifyOtpAndAuth($request);
    }

    /**
     * Resend OTP
     *
     * Resend the OTP code to the phone number.
     *
     * @bodyParam phone string required The phone number. Example: 01012345678
     *
     * @response 200 {
     *   "status": 200,
     *   "message": "تم إعادة إرسال رمز التحقق",
     *   "data": {
     *     "otp_token": "xyz789"
     *   }
     * }
     */
    public function resendOtp(PhoneSendOtpRequest $request)
    {
        return $this->phoneAuthService->resendOtp($request);
    }
}
