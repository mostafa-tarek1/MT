<?php

namespace App\Modules\Auth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockBannedUser
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('api')->user();
        if ($user && $user->is_banned) {
            return response()->json([
                'status' => 403,
                'message' => __('auth.banned'),
                'data' => [],
            ], 403);
        }

        return $next($request);
    }
}
