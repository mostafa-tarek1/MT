<?php

namespace App\Modules\Base\Services;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModuleLoader
{
    /**
     * Get all available modules from the Modules directory.
     *
     * @return array<string>
     */
    public static function getAvailableModules(): array
    {
        $modulesPath = base_path('app/Modules');

        if (! is_dir($modulesPath)) {
            return [];
        }

        $modules = array_filter(glob($modulesPath.'/*'), 'is_dir');
        $moduleNames = array_map('basename', $modules);

        return array_values($moduleNames);
    }

    /**
     * Get all module service providers that exist.
     *
     * @return array<string>
     */
    public static function getModuleServiceProviders(): array
    {
        $modules = self::getAvailableModules();
        $providers = [];

        foreach ($modules as $moduleName) {
            $providersPath = base_path("app/Modules/{$moduleName}/Providers");

            if (! is_dir($providersPath)) {
                continue;
            }

            // Get all PHP files in Providers directory
            $providerFiles = glob($providersPath.'/*ServiceProvider.php');

            foreach ($providerFiles as $file) {
                $fileName = basename($file, '.php');
                $providerClass = "App\\Modules\\{$moduleName}\\Providers\\{$fileName}";

                if (class_exists($providerClass) && ! in_array($providerClass, $providers)) {
                    $providers[] = $providerClass;
                }
            }
        }

        return $providers;
    }

    /**
     * Load all module resources (routes, migrations, views, translations).
     */
    public static function loadModuleResources(ServiceProvider $serviceProvider): void
    {
        $modules = self::getAvailableModules();

        foreach ($modules as $moduleName) {
            $modulePath = base_path("app/Modules/{$moduleName}");

            // Skip Base module as it's handled separately
            if ($moduleName === 'Base') {
                continue;
            }

            // Load Routes
            self::loadModuleRoutes($serviceProvider, $modulePath, $moduleName);

            // Load Migrations
            self::loadModuleMigrations($serviceProvider, $modulePath);

            // Load Views
            self::loadModuleViews($serviceProvider, $modulePath, $moduleName);

            // Load Translations
            self::loadModuleTranslations($serviceProvider, $modulePath, $moduleName);

            // Register Event Service Providers
            self::registerModuleEventProvider($serviceProvider, $moduleName);
        }
    }

    /**
     * Load all route files from a module.
     */
    protected static function loadModuleRoutes(ServiceProvider $serviceProvider, string $modulePath, string $moduleName): void
    {
        // Support both 'Routes' and 'routes' folder names
        $routesPaths = [
            $modulePath.'/Routes',
            $modulePath.'/routes',
        ];

        foreach ($routesPaths as $routesPath) {
            if (! is_dir($routesPath)) {
                continue;
            }

            // Load main route files
            $routeFiles = [
                'api.php',
                'web.php',
                'dashboard.php',
                'console.php',
                'mobile.php',
            ];

            foreach ($routeFiles as $routeFile) {
                $routePath = $routesPath.'/'.$routeFile;
                if (file_exists($routePath)) {
                    Route::group([], function () use ($routePath) {
                        require $routePath;
                    });
                }
            }

            // Recursively load all nested route files (e.g., routes/api/v1/mobile.php)
            self::loadNestedRoutes($serviceProvider, $routesPath);
        }
    }

    /**
     * Recursively load all PHP files in nested route directories.
     */
    protected static function loadNestedRoutes(ServiceProvider $serviceProvider, string $routesPath): void
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($routesPath, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        $mainRouteFiles = ['api.php', 'web.php', 'dashboard.php', 'console.php', 'mobile.php'];

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $fileName = basename($file->getPathname());

                // Skip main route files (already loaded above)
                if (in_array($fileName, $mainRouteFiles)) {
                    continue;
                }

                Route::group([], function () use ($file) {
                    require $file->getPathname();
                });
            }
        }
    }

    /**
     * Load migrations from a module.
     */
    protected static function loadModuleMigrations(ServiceProvider $serviceProvider, string $modulePath): void
    {
        $migrationsPaths = [
            $modulePath.'/Database/Migrations',
            $modulePath.'/database/migrations',
        ];

        foreach ($migrationsPaths as $migrationsPath) {
            if (is_dir($migrationsPath)) {
                $reflection = new \ReflectionClass($serviceProvider);
                $method = $reflection->getMethod('loadMigrationsFrom');
                $method->setAccessible(true);
                $method->invoke($serviceProvider, $migrationsPath);
                break; // Only load from first found path
            }
        }
    }

    /**
     * Load views from a module.
     */
    protected static function loadModuleViews(ServiceProvider $serviceProvider, string $modulePath, string $moduleName): void
    {
        $viewsPaths = [
            $modulePath.'/Resources/views',
            $modulePath.'/resources/views',
        ];

        foreach ($viewsPaths as $viewsPath) {
            if (is_dir($viewsPath)) {
                $reflection = new \ReflectionClass($serviceProvider);
                $method = $reflection->getMethod('loadViewsFrom');
                $method->setAccessible(true);
                $method->invoke($serviceProvider, $viewsPath, strtolower($moduleName));
                break; // Only load from first found path
            }
        }
    }

    /**
     * Load translations from a module.
     */
    protected static function loadModuleTranslations(ServiceProvider $serviceProvider, string $modulePath, string $moduleName): void
    {
        $translationsPaths = [
            $modulePath.'/Resources/lang',
            $modulePath.'/resources/lang',
        ];

        foreach ($translationsPaths as $translationsPath) {
            if (is_dir($translationsPath)) {
                $reflection = new \ReflectionClass($serviceProvider);
                $method = $reflection->getMethod('loadTranslationsFrom');
                $method->setAccessible(true);
                $method->invoke($serviceProvider, $translationsPath, strtolower($moduleName));
                break; // Only load from first found path
            }
        }
    }

    /**
     * Register module event service provider if it exists.
     */
    protected static function registerModuleEventProvider(ServiceProvider $serviceProvider, string $moduleName): void
    {
        $providerClass = "App\\Modules\\{$moduleName}\\Providers\\EventServiceProvider";

        if (class_exists($providerClass)) {
            app()->register($providerClass);
        }
    }
}
