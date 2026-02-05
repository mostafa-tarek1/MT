<?php

use App\Modules\Auth\Http\Controllers\Dashboard\Auth\AuthController;
use App\Modules\Auth\Http\Controllers\Dashboard\Home\HomeController;
use App\Modules\Auth\Http\Controllers\Dashboard\Mangers\MangerController;
use App\Modules\Auth\Http\Controllers\Dashboard\Roles\RoleController;
use App\Modules\Auth\Http\Controllers\Dashboard\Settings\SettingController;
use App\Modules\Auth\Http\Controllers\Dashboard\User\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Dashboard routes with localization
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function (): void {
        Route::get('login', [AuthController::class, '_login'])->name('_login');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });

    // Add alias for 'login' route (required by auth middleware)
    Route::get('login', [AuthController::class, '_login'])->name('login');

    Route::middleware('auth:manager')->group(function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/', [HomeController::class, 'index'])->name('dashboard.home');

            // // Users routes - with ID constraint to prevent conflicts
            // Route::get('users', [UserController::class, 'index'])->name('users.index');
            // Route::get('users/create', [UserController::class, 'create'])->name('users.create');
            // Route::post('users', [UserController::class, 'store'])->name('users.store');
            // Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->where('id', '[0-9]+');
            // Route::get('users/{id}', [UserController::class, 'show'])->name('users.show')->where('id', '[0-9]+');
            // Route::put('users/{id}', [UserController::class, 'update'])->name('users.update')->where('id', '[0-9]+');
            // Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->where('id', '[0-9]+');

            // Settings routes
            Route::resource('settings', SettingController::class)->only('edit', 'update');
            Route::post('update-password', [SettingController::class, 'updatePassword'])->name('update-password');

            // // Roles routes
            // Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
            // Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
            // Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
            // Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit')->where('id', '[0-9]+');
            // Route::get('roles/{id}', [RoleController::class, 'show'])->name('roles.show')->where('id', '[0-9]+');
            // Route::put('roles/{id}', [RoleController::class, 'update'])->name('roles.update')->where('id', '[0-9]+');
            // Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')->where('id', '[0-9]+');
            // Route::get('role/{id}/managers', [RoleController::class, 'mangers'])->name('roles.mangers');

            // // Managers routes
            // Route::get('managers', [MangerController::class, 'index'])->name('managers.index');
            // Route::controller(MangerController::class)->prefix('managers')->name('managers.')->group(function () {
            //     Route::get('/{role}/create', 'create')->name('create');
            //     Route::post('/', 'store')->name('store');
            //     Route::post('/toggle/{id}', 'toggle')->name('toggle');
            //     Route::get('/{manager}/edit', 'edit')->name('edit');
            //     Route::put('/{manager}', 'update')->name('update');
            //     Route::delete('/{manager}', action: 'destroy')->name('destroy');
            // });
        });
    });
});
