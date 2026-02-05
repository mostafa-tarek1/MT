<?php

use App\Modules\Auth\Http\Controllers\Api\V1\Auth\AuthController;
use App\Modules\Auth\Http\Controllers\Api\V1\UserProfileController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::group(['prefix' => 'sign'], function () {
        Route::post('in', 'signIn');
        Route::post('up', 'signUp');
        Route::post('out', 'signOut');
    });
    Route::get('what-is-my-platform', 'whatIsMyPlatform'); // returns 'platform: mobile!'
});

// User Profile Routes (Protected)
Route::middleware(['auth:api'])->group(function () {
    Route::prefix('profile')->controller(UserProfileController::class)->group(function () {
        // Profile Management
        Route::get('/', 'getProfile');
        Route::put('/', 'updateProfile');

        // Images
        Route::post('/profile-image', 'uploadProfileImage');
        Route::post('/background-image', 'uploadBackgroundImage');

        // Store Location
        Route::put('/store-location', 'updateStoreLocation');

        // Contact Information
        Route::put('/additional-phones', 'updateAdditionalPhones');
        Route::put('/social-links', 'updateSocialLinks');
        Route::put('/tax-number', 'updateTaxNumber');

        // Store Windows (Store Sections)
        Route::get('/store-windows', 'getStoreWindows');
        Route::post('/store-windows', 'createOrUpdateStoreWindow');
        Route::delete('/store-windows/{windowId}', 'deleteStoreWindow');
        Route::put('/store-windows/order', 'updateStoreWindowOrder');
    });
});

// Public Profile (no auth required)
Route::get('/users/{userId}/profile', [UserProfileController::class, 'getPublicProfile']);
