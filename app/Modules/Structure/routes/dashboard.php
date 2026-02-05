<?php

use App\Modules\Structure\Http\Controllers\Dashboard\ContactController;
use App\Modules\Structure\Http\Controllers\Dashboard\ContactMessageController;
use App\Modules\Structure\Http\Controllers\Dashboard\CTAController;
use App\Modules\Structure\Http\Controllers\Dashboard\CustomerReviewController;
use App\Modules\Structure\Http\Controllers\Dashboard\FeaturesController;
use App\Modules\Structure\Http\Controllers\Dashboard\FlexibleSystemController;
use App\Modules\Structure\Http\Controllers\Dashboard\HeroController;
use App\Modules\Structure\Http\Controllers\Dashboard\WhoIsThisForController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale().'/admin',
    'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::middleware('auth:manager')->group(function () {
        Route::group(['prefix' => 'structures'], function () {
            Route::resource('hero', HeroController::class)->only('store', 'index');
            Route::resource('features', FeaturesController::class)->only('store', 'index');
            Route::resource('who_is_this_for', WhoIsThisForController::class)->only('store', 'index');
            Route::resource('flexible_system', FlexibleSystemController::class)->only('store', 'index');
            Route::resource('customer_reviews', CustomerReviewController::class)->only('store', 'index');
            Route::resource('cta', CTAController::class)->only('store', 'index');
            Route::resource('contact', ContactController::class)->only('store', 'index');
        });

        // Contact Messages Routes
        Route::group(['prefix' => 'contact-messages', 'as' => 'contact-messages.'], function () {
            Route::get('/', [ContactMessageController::class, 'index'])->name('index');
            Route::get('/{id}', [ContactMessageController::class, 'show'])->name('show');
            Route::post('/{id}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('mark-as-read');
            Route::post('/{id}/mark-as-unread', [ContactMessageController::class, 'markAsUnread'])->name('mark-as-unread');
            Route::delete('/{id}', [ContactMessageController::class, 'destroy'])->name('destroy');
        });
    });
});
