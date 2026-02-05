<?php

namespace App\Modules\Auth\Http\Controllers\Api\V1\Auth\Password;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\Api\V1\Auth\Password\ForgetPasswordRequest;
use App\Modules\Auth\Http\Requests\Api\V1\Auth\Password\PasswordRequest;
use App\Modules\Auth\Http\Requests\Api\V1\Auth\Password\ResetPasswordRequest;
use App\Modules\Auth\Http\Requests\Api\V1\Auth\Password\VerifyOtpRequest;
use App\Modules\Auth\Http\Services\Api\V1\Auth\Password\PasswordService;

class PasswordController extends Controller
{
    public function __construct(private PasswordService $service) {}

    public function forgot(ForgetPasswordRequest $request)
    {
        return $this->service->forgot($request);
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        return $this->service->verifyOtp($request);
    }

    public function reset(ResetPasswordRequest $request)
    {
        return $this->service->reset($request);
    }

    public function updatePassword(PasswordRequest $request)
    {
        return $this->service->updatePassword($request);
    }
}
