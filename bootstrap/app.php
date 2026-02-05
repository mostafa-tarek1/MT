<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Replace default Authenticate middleware with custom one for both web and manager guards
        $middleware->redirectGuestsTo(function ($request) {
            // Get locale from URL segment or default to app locale
            $locale = $request->segment(1);
            $supportedLocales = ['ar', 'en'];

            if (! in_array($locale, $supportedLocales)) {
                $locale = app()->getLocale();
            }

            // Redirect to login page with localization
            return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($locale, route('auth._login', [], false));
        });

        // Custom redirect for manager guard (dashboard)
        $middleware->redirectUsersTo(function () {
            return route('dashboard.home');
        });

        $middleware->alias([
            'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
            'setLocale' => \App\Modules\Base\Http\Middleware\SetLocale::class,
            'role' => \Laratrust\Middleware\Role::class,
            'permission' => \Laratrust\Middleware\Permission::class,
            'ability' => \Laratrust\Middleware\Ability::class,
        ]);

        // LaravelLocalization middleware handles locale automatically
        // No need for custom SetLocale middleware in web group

        // Add SetLocaleFromHeader to API middleware group (from Accept-Language header)
        $middleware->api(append: [
            \App\Modules\Base\Http\Middleware\SetLocaleFromHeader::class,
            \App\Modules\Auth\Http\Middleware\BlockBannedUser::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
