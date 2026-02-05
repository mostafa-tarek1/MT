<?php

namespace App\Modules\Auth\Repository\Eloquent;

use App\Modules\Auth\Models\Otp;
use App\Modules\Auth\Repository\OtpRepositoryInterface;
use App\Modules\Base\Repositories\Eloquent\Repository;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OtpRepository extends Repository implements OtpRepositoryInterface
{
    public function __construct(Otp $model)
    {
        parent::__construct($model);
    }

    public function generateOtp($user = null)
    {
        if (! $user) {
            $user = auth('api')->user();
        }
        $user->otps()?->delete();

        return $user->otp()?->create([
            'code' => 1111, // Fixed OTP for testing
            'otp' => 1111, // Backward compatibility
            'expire_at' => Carbon::now()->addMinutes(5),
            'expires_at' => Carbon::now()->addMinutes(5), // New column
            'token' => Str::random(30),
        ]);
    }

    public function generateOtpForEmail($email, $user = null)
    {
        if (! $user) {
            $user = auth('api')->user();
        }
        $user->otps()?->delete();

        return $user->otp()?->create([
            'code' => 1111, // Fixed OTP for testing
            'otp' => 1111, // Backward compatibility
            'email' => $email,
            'identifier' => $email,
            'type' => 'email',
            'expire_at' => Carbon::now()->addMinutes(5),
            'expires_at' => Carbon::now()->addMinutes(5),
            'token' => Str::random(30),
        ]);
    }

    public function check($otp, $token, $user = null)
    {
        if (! $user) {
            $user = auth('api')->user();
        }

        return $this->model::query()
            ->where('user_id', $user->id)
            ->where('otp', $otp)
            ->where('token', $token)
            ->where('expire_at', '>', Carbon::now())
            ->exists();
    }

    public function checkForEmail($otp, $token, $email)
    {
        return $this->model::query()
            ->where('user_id', auth('api')->id())
            ->where('otp', $otp)
            ->where('email', $email)
            ->where('token', $token)
            ->where('expire_at', '>', Carbon::now())
            ->exists();
    }

    public function generateOtpForPhone($phone)
    {
        // Delete old OTPs for this phone
        $this->model::where('identifier', $phone)
            ->where('type', 'phone')
            ->delete();

        // Fixed OTP for testing
        $code = 1111; // TODO: Change to rand(100000, 999999) in production

        // Create new OTP
        return $this->model::create([
            'identifier' => $phone,
            'code' => $code,
            'type' => 'phone',
            'expires_at' => Carbon::now()->addMinutes(5),
            'token' => Str::random(30),
        ]);
    }

    public function verifyPhoneOtp($phone, $code)
    {
        return $this->model::where('identifier', $phone)
            ->where('type', 'phone')
            ->where('code', $code)
            ->where('expires_at', '>', Carbon::now())
            ->first();
    }
}
