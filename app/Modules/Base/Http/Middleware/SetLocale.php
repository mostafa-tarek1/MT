<?php

namespace App\Modules\Base\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from route parameter
        $locale = $request->route('locale') ?? $request->segment(1);

        // Check if locale is supported
        $supportedLocales = ['ar', 'en'];

        if ($locale && in_array($locale, $supportedLocales)) {
            // Set application locale
            App::setLocale($locale);

            // Store in session for persistence
            session(['locale' => $locale]);
        } else {
            // Fallback to default (don't use session to avoid sticking)
            $locale = config('app.locale', 'ar');
            App::setLocale($locale);
        }

        return $next($request);
    }
}
