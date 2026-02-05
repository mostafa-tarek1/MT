<?php

namespace App\Modules\Base\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register all repository bindings
        foreach ($this->bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }

        // Auto-discover and register module repositories
        $this->autoRegisterModuleRepositories();
    }

    /**
     * Auto-discover and register repositories from all modules.
     */
    protected function autoRegisterModuleRepositories(): void
    {
        $modulesPath = base_path('app/Modules');

        if (! is_dir($modulesPath)) {
            return;
        }

        $modules = array_filter(glob($modulesPath.'/*'), 'is_dir');

        foreach ($modules as $modulePath) {
            $moduleName = basename($modulePath);

            // Check both 'Repository' and 'Repositories' folders
            $repositoriesPaths = [
                $modulePath.'/Repository',
                $modulePath.'/Repositories',
            ];

            foreach ($repositoriesPaths as $repositoriesPath) {
                if (! is_dir($repositoriesPath)) {
                    continue;
                }

                // Determine the namespace based on folder name
                $folderName = basename($repositoriesPath);

                // Find all repository files in Eloquent subfolder
                $eloquentPath = $repositoriesPath.'/Eloquent';
                if (is_dir($eloquentPath)) {
                    $files = glob($eloquentPath.'/*Repository.php');

                    foreach ($files as $file) {
                        $fileName = basename($file, '.php');

                        // Build interface and implementation names
                        $interfaceName = "App\\Modules\\{$moduleName}\\{$folderName}\\{$fileName}Interface";
                        $implementationName = "App\\Modules\\{$moduleName}\\{$folderName}\\Eloquent\\{$fileName}";

                        // Check if both interface and implementation exist
                        if (interface_exists($interfaceName) && class_exists($implementationName)) {
                            $this->app->bind($interfaceName, $implementationName);
                        }
                    }
                }

                // Also check for direct repository files (not in Eloquent subfolder)
                $files = glob($repositoriesPath.'/*Repository.php');

                foreach ($files as $file) {
                    $fileName = basename($file, '.php');

                    // Skip interface files
                    if (str_ends_with($fileName, 'Interface')) {
                        continue;
                    }

                    $interfaceName = "App\\Modules\\{$moduleName}\\{$folderName}\\{$fileName}Interface";
                    $implementationName = "App\\Modules\\{$moduleName}\\{$folderName}\\{$fileName}";

                    // Check if both interface and implementation exist
                    if (interface_exists($interfaceName) && class_exists($implementationName)) {
                        $this->app->bind($interfaceName, $implementationName);
                    }
                }
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
