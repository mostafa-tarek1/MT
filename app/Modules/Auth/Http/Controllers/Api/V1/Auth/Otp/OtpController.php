<?php

namespace App\Modules\Auth\Http\Controllers\Api\V1\Auth\Otp;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\Api\V1\Otp\OtpVerifyRequest;
use App\Modules\Auth\Http\Services\Api\V1\Auth\Otp\OtpService;

class OtpController extends Controller
{
    public function __construct(
        private readonly OtpService $otpService
    ) {}

    public function send()
    {
        return $this->otpService->generate();
    }

    public function verify(OtpVerifyRequest $request)
    {
        return $this->otpService->verify($request);
    }
}
