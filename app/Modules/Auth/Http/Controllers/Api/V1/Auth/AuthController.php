<?php

namespace App\Modules\Auth\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\Api\V1\Auth\PhoneVerifyOtpRequest;
use App\Modules\Auth\Http\Requests\Api\V1\Auth\SignInRequest;
use App\Modules\Auth\Http\Requests\Api\V1\Auth\SignUpRequest;
use App\Modules\Auth\Http\Services\Api\V1\Auth\AuthService;

/**
 * @group Authentication
 *
 * APIs for user authentication including sign-up, sign-in, and sign-out
 */
class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $auth,
    ) {}

    /**
     * Sign Up
     *
     * Register a new user with phone number. An OTP will be sent to verify the phone.
     *
     * @bodyParam name string required The user's full name. Example: Ahmed Mohamed
     * @bodyParam phone string required The user's phone number (11 digits). Example: 01012345678
     *
     * @response 201 {
     *   "status": 201,
     *   "message": "تم الإنشاء بنجاح",
     *   "data": {
     *     "name": "Ahmed Mohamed",
     *     "phone": "01012345678",
     *     "status": "active",
     *     "otp_token": "abc123",
     *     "otp_verified": false,
     *     "token": "eyJ0eXAiOiJKV1QiLCJhbGc..."
     *   }
     * }
     * @response 400 {
     *   "status": 400,
     *   "message": "رقم الهاتف موجود بالفعل"
     * }
     */
    public function signUp(SignUpRequest $request)
    {
        return $this->auth->signUp($request);
    }

    /**
     * Verify Sign Up OTP
     *
     * Verify the OTP code sent to the phone number during sign-up.
     *
     * @bodyParam phone string required The user's phone number. Example: 01012345678
     * @bodyParam code string required The OTP code. Example: 123456
     *
     * @response 200 {
     *   "status": 200,
     *   "message": "تم التحقق من الهاتف بنجاح",
     *   "data": {
     *     "token": "1|abc123...",
     *     "user": {
     *       "id": 1,
     *       "name": "Ahmed Mohamed",
     *       "phone": "01012345678",
     *       "phone_verified_at": "2025-11-11T10:00:00.000000Z"
     *     }
     *   }
     * }
     */
    public function verifySignUpOtp(PhoneVerifyOtpRequest $request)
    {
        return $this->auth->verifySignUpOtp($request);
    }

    /**
     * Sign In
     *
     * Sign in with phone number. An OTP will be sent for verification.
     *
     * @bodyParam phone string required The user's phone number. Example: 01012345678
     *
     * @response 201 {
     *   "status": 201,
     *   "message": "تم الإنشاء بنجاح",
     *   "data": {
     *     "name": "Ahmed Mohamed",
     *     "phone": "01012345678",
     *     "otp_token": "abc123",
     *     "token": "eyJ0eXAiOiJKV1QiLCJhbGc..."
     *   }
     * }
     */
    public function signIn(SignInRequest $request)
    {
        return $this->auth->signIn($request);
    }

    /**
     * Sign Out
     *
     * Sign out the authenticated user.
     *
     * @authenticated
     *
     * @response 200 {
     *   "status": 200,
     *   "message": "تم تسجيل الخروج بنجاح"
     * }
     */
    public function signOut()
    {
        return $this->auth->signOut();
    }

    /**
     * Get Platform
     *
     * Get the current platform information.
     *
     * @authenticated
     *
     * @response 200 {
     *   "platform": "mobile"
     * }
     */
    public function whatIsMyPlatform()
    {
        return $this->auth->whatIsMyPlatform();
    }
}
