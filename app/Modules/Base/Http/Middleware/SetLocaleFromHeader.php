<?php

namespace App\Modules\Base\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromHeader
{
    /**
     * Handle an incoming request for API.
     * Sets locale based on Accept-Language header
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from Accept-Language header
        $locale = $request->header('Accept-Language', 'ar');

        // Clean the locale (remove region codes like ar-SA -> ar)
        $locale = strtolower(substr($locale, 0, 2));

        // Check if locale is supported
        $supportedLocales = ['ar', 'en'];

        if (in_array($locale, $supportedLocales)) {
            App::setLocale($locale);
        } else {
            // Fallback to default
            App::setLocale(config('app.locale', 'ar'));
        }

        return $next($request);
    }
}
