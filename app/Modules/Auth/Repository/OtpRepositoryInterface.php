<?php

namespace App\Modules\Auth\Repository;

use App\Modules\Base\Repositories\RepositoryInterface;

interface OtpRepositoryInterface extends RepositoryInterface
{
    public function generateOtp($user = null);

    public function check($otp, $token, $user = null);

    public function generateOtpForEmail($email, $user = null);

    public function checkForEmail($otp, $token, $email);

    public function generateOtpForPhone($phone);

    public function verifyPhoneOtp($phone, $code);
}
