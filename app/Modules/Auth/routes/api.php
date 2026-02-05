<?php

use App\Modules\Auth\Http\Controllers\Api\V1\Auth\AuthController;
use App\Modules\Auth\Http\Controllers\Api\V1\Auth\Email\ChangeEmailController;
use App\Modules\Auth\Http\Controllers\Api\V1\Auth\Otp\OtpController;
use App\Modules\Auth\Http\Controllers\Api\V1\Auth\Password\PasswordController;
use App\Modules\Auth\Http\Controllers\Api\V1\Auth\PhoneController;
use App\Modules\Auth\Http\Controllers\Api\V1\Profile\ProfileController;
use App\Modules\Auth\Http\Controllers\Api\V1\Profile\ProfileImageController;
use App\Modules\Auth\Http\Resources\V1\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes (no authentication required)
Route::prefix('api/v1')->group(function () {
    // Phone Authentication (OTP-based, No password required) - Mobile
    Route::controller(PhoneController::class)->prefix('phone')->name('phone.')->group(function () {
        Route::post('send-otp', 'sendOtp')->name('send-otp');
        Route::post('verify-otp', 'verifyOtp')->name('verify-otp');
        Route::post('resend-otp', 'resendOtp')->name('resend-otp');
    });

    // Traditional Authentication (Email/Password)
    Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
        Route::post('sign-up', 'signUp')->name('sign-up'); // Send OTP
        Route::post('verify-otp', 'verifySignUpOtp')->name('verify-sign-up-otp'); // Verify OTP after sign-up
        Route::post('sign-in', 'signIn')->name('sign-in');
    });

    // Password Reset
    Route::controller(PasswordController::class)->prefix('password')->name('password.')->group(function () {
        Route::post('forgot', 'forgot')->name('forgot');
        Route::post('verify-otp', 'verifyOtp')->name('verify-otp');
        Route::post('reset', 'reset')->name('reset');
    });
});

// Protected routes (require authentication)
Route::middleware('auth:api')->prefix('api/v1')->group(function () {
    // OTP
    Route::controller(OtpController::class)->prefix('otp')->name('otp.')->group(function () {
        Route::get('/', 'send')->name('send-get'); // GET to send OTP
        Route::post('send', 'send')->name('send');
        Route::post('verify', 'verify')->name('verify');
    });

    // Authentication
    Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
        Route::post('sign-out', 'signOut')->name('sign-out');
        Route::get('platform', 'whatIsMyPlatform')->name('platform');
    });

    // Password
    Route::controller(PasswordController::class)->prefix('password')->name('password.')->group(function () {
        Route::post('update', 'updatePassword')->name('update');
    });

    // Change Email
    Route::controller(ChangeEmailController::class)->prefix('email')->name('email.')->group(function () {
        Route::post('send-otp', 'sendOtp')->name('send-otp');
        Route::post('change', 'change')->name('change');
    });

    // Profile Management (Old endpoints - keep for backward compatibility)
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'getProfile')->name('get');
        Route::post('/update', 'updateProfile')->name('update');
    });

    // Profile Image (Old endpoints - keep for backward compatibility)
    Route::controller(ProfileImageController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::post('image/update', 'update')->name('image.update');
        Route::delete('image/delete', 'delete')->name('image.delete');
    });

    // Extended Profile Management (New endpoints)
    Route::controller(\App\Modules\Auth\Http\Controllers\Api\V1\UserProfileController::class)
        ->prefix('profile')->name('profile.extended.')->group(function () {
            // RESTful Profile Update
            Route::match(['put', 'patch'], '/', 'updateProfile')->name('update');

            // Images
            Route::post('/profile-image', 'uploadProfileImage')->name('profile-image');
            Route::post('/background-image', 'uploadBackgroundImage')->name('background-image');

            // Store Location
            Route::match(['put', 'patch'], '/store-location', 'updateStoreLocation')->name('store-location');

            // Contact Information
            Route::match(['put', 'patch'], '/additional-phones', 'updateAdditionalPhones')->name('additional-phones');
            Route::match(['put', 'patch'], '/social-links', 'updateSocialLinks')->name('social-links');
            Route::match(['put', 'patch'], '/tax-number', 'updateTaxNumber')->name('tax-number');

            // Store Sections (Store Windows)
            Route::get('/store-windows', 'getStoreWindows')->name('store-windows.index');
            Route::post('/store-windows', 'createOrUpdateStoreWindow')->name('store-windows.store');
            Route::delete('/store-windows/{windowId}', 'deleteStoreWindow')->name('store-windows.delete');
            Route::match(['put', 'patch'], '/store-windows/order', 'updateStoreWindowOrder')->name('store-windows.order');
        });

    // Get authenticated user
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user(), false);
    })->name('user');
});

// Public Profile (no auth required)
Route::prefix('api/v1')->group(function () {
    Route::get('/users/{userId}/profile', [\App\Modules\Auth\Http\Controllers\Api\V1\UserProfileController::class, 'getPublicProfile'])
        ->name('users.profile');
});
