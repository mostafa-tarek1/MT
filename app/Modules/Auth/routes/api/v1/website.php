<?php

use App\Modules\Auth\Http\Controllers\Api\V1\Auth\AuthController;
use App\Modules\Auth\Http\Controllers\Api\V1\Auth\Email\ChangeEmailController;
use App\Modules\Auth\Http\Controllers\Api\V1\Auth\Otp\OtpController;
use App\Modules\Auth\Http\Controllers\Api\V1\Auth\Password\PasswordController;
use App\Modules\Auth\Http\Resources\V1\User\UserResource;
use App\Modules\Auth\Models\User;

use function App\Modules\Base\Http\Helpers\paginatedJsonResponse;

use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    $users = User::paginate(10);

    return paginatedJsonResponse(
        __('messages.Data fetched successfully'),

        // must write items
        ['items' => UserResource::collection($users)],
    );
});

Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::group(['prefix' => 'sign'], function () {
        Route::post('in', 'signIn');
        Route::post('up', 'signUp');
        Route::post('out', 'signOut')->middleware('auth:api');
    });
    Route::get('what-is-my-platform', 'whatIsMyPlatform'); // returns 'platform: website!'
});
Route::group(['prefix' => 'otp', 'middleware' => ['auth:api']], function () {
    Route::post('/verify', [OtpController::class, 'verify']);
    Route::get('/', [OtpController::class, 'send']);
});
Route::group(['prefix' => 'email', 'middleware' => ['auth:api']], function () {
    Route::post('/change', [ChangeEmailController::class, 'sendOtp']);
    Route::post('/otp/verify', [ChangeEmailController::class, 'change']);
});
Route::group(['prefix' => 'password'], function () {
    Route::post('/forgot', [PasswordController::class, 'forgot']);
    Route::post('/verify-otp', [PasswordController::class, 'verifyOtp']);
    Route::post('/reset', [PasswordController::class, 'reset']);
    Route::post('/update', [PasswordController::class, 'updatePassword']);
});
