<?php

use App\Modules\Structure\Http\Controllers\LandingController;
use App\Modules\Structure\Http\Controllers\ContactMessageController;
use App\Modules\Structure\Http\Controllers\QuoteRequestController;
use Illuminate\Support\Facades\Route;

Route::post('/contact/submit', [ContactMessageController::class, 'store'])->name('contact.submit');
Route::post('/quote-requests', [QuoteRequestController::class, 'store'])->name('quote-requests.store');

