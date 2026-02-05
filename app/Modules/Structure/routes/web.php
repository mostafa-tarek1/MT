<?php

use App\Modules\Structure\Http\Controllers\LandingController;
use App\Modules\Structure\Http\Controllers\ContactMessageController;
use Illuminate\Support\Facades\Route;

Route::post('/contact/submit', [ContactMessageController::class, 'store'])->name('contact.submit');

