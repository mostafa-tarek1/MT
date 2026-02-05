<?php

namespace App\Modules\Structure\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Routes, migrations, views, and translations are automatically loaded by AppServiceProvider
        // using the centralized ModuleLoader. No need to load them manually here.
        //
        // Note: This ServiceProvider seems to be a duplicate or legacy file.
        // Consider removing it if StructureServiceProvider handles all Structure module needs.
    }
}
