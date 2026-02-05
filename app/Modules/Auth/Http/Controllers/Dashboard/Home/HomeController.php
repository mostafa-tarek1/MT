<?php

namespace App\Modules\Auth\Http\Controllers\Dashboard\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Get statistics for Haraj (classifieds) platform
        // TODO: Replace with actual database queries when models are created

        $data = [
            // Users statistics
            'usersCount' => 0,

            // Ads statistics
            'totalAds' => 0,
            'activeAds' => 0,
            'pendingAds' => 0,
            'rejectedAds' => 0,
            'expiredAds' => 0,

            // Categories statistics - for the bar chart
            'categoryNames' => [],
            'categoryCounts' => [],
        ];

        return view('base::dashboard.index', $data);
    }
}
