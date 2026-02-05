<?php

namespace App\Modules\Base\Providers;

use App\Modules\Base\Console\Commands\MakeModuleCommand;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services for the module.
     */
    public function register(): void
    {
        // Register bindings, singletons, or other container services here.
    }

    /**
     * Bootstrap any module services.
     */
    public function boot(): void
    {
        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeModuleCommand::class,
            ]);
        }

        // Load routes if present
        $routes = base_path('app/Modules/Base/Routes/web.php');
        if (file_exists($routes)) {
            $this->loadRoutesFrom($routes);
        }

        // Load views under namespace 'base' if present
        $views = base_path('app/Modules/Base/Resources/views');
        if (is_dir($views)) {
            $this->loadViewsFrom($views, 'base');

            // Register Blade components with 'dashboard' prefix
            Blade::componentNamespace('App\\Modules\\Base\\View\\Components\\Dashboard', 'dashboard');

            // Register individual components
            // Register anonymous components manually
            Blade::component('base::components.dashboard.button', 'dashboard.button');
            Blade::component('base::components.dashboard.button-link', 'dashboard.button-link');
            Blade::component('base::components.dashboard.icon-button', 'dashboard.icon-button');
            Blade::component('base::components.dashboard.icon-link', 'dashboard.icon-link');
            Blade::component('base::components.dashboard.delete-button', 'dashboard.delete-button');

            // Register pages components
            Blade::component('base::components.pages.datatable', 'pages.datatable');
        }

        // Register individual class-based components (specific ones)
        if (class_exists(\App\Modules\Base\View\Components\Dashboard\Layouts\Breadcrumb::class)) {
            Blade::component('dashboard.layouts.breadcrumb', \App\Modules\Base\View\Components\Dashboard\Layouts\Breadcrumb::class);
        }

        // Load migrations if present
        $migrations = base_path('app/Modules/Base/Database/Migrations');
        if (is_dir($migrations)) {
            $this->loadMigrationsFrom($migrations);
        }
    }
}
