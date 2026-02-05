<?php

use App\Modules\Structure\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Redirect root to login page with default locale
// Route::get('/', function () {
//     $locale = app()->getLocale();

//     return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($locale, route('auth._login', [], false));
// });

// Note: All module routes (web.php, dashboard.php, api.php, mobile.php, console.php)
// are automatically loaded by AppServiceProvider using the centralized ModuleLoader.
// No need to manually require route files here.
//
// If you need special route loading (e.g., without prefix for localization),
// handle it in the module's ServiceProvider boot() method.
Route::group(['prefix' => LaravelLocalization::setLocale(),  'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::get('/', [LandingController::class, 'index'])->name('landing');
});
