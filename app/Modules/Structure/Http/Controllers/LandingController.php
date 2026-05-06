<?php

namespace App\Modules\Structure\Http\Controllers;

use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        return view('structure::landing');
    }
}
