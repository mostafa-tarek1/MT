<?php

namespace App\Providers;

use App\Modules\Base\Services\ModuleLoader;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Auto-load all modules resources (routes, migrations, views, translations)
        // This is centralized in ModuleLoader for better organization
        ModuleLoader::loadModuleResources($this);

        // Register event listeners
        $this->registerEventListeners();

        // Use Bootstrap 4 pagination views to match dashboard styling
        Paginator::useBootstrapFour();
    }

    /**
     * Register event listeners for the application.
     * 
     * Note: Event listeners are registered conditionally to prevent errors
     * if the corresponding modules don't exist yet.
     */
    protected function registerEventListeners(): void
    {
    }

}
