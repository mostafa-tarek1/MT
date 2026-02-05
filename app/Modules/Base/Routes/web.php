<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Base Module Routes
|--------------------------------------------------------------------------
|
| Add routes related to the "Base" module here. Example route below.
|
*/

Route::get('/base/hello', function () {
    return 'مرحبًا من موديول Base';
});
