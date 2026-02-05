<?php

namespace App\Modules\Base\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Get locale from URL segment or default to app locale
        $locale = $request->segment(1);
        $supportedLocales = ['ar', 'en'];

        if (! in_array($locale, $supportedLocales)) {
            $locale = app()->getLocale();
        }

        return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($locale, route('auth._login', [], false));
    }
}
