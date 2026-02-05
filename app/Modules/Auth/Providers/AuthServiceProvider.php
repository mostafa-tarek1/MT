<?php

namespace App\Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register repositories
        $this->app->bind(
            \App\Modules\Auth\Repository\UserProfileRepositoryInterface::class,
            \App\Modules\Auth\Repository\Eloquent\UserProfileRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Routes, migrations, views, and translations are automatically loaded by AppServiceProvider
        // using the centralized ModuleLoader. No need to load them manually here.
        //
        // Custom repository bindings are registered in register() method above.
    }
}
