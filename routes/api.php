<?php

use Illuminate\Support\Facades\Route;

// Test locale route
Route::get('test-locale', function () {
    return response()->json([

        'message' => __('messages.Phone already exists'),
        'created' => __('messages.created successfully'),
        'error' => __('messages.Something went wrong'),
    ]);
});

Route::get('health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toIso8601String(),
    ]);
});

// Note: All module routes are automatically loaded by AppServiceProvider
// No need to manually require route files here
