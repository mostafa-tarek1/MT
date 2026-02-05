<?php

/**
 * Service Providers Registration
 *
 * This file registers all service providers for the application.
 *
 * Base providers are always loaded first, followed by module providers.
 * Module resources (routes, migrations, views, translations) are automatically
 * loaded by AppServiceProvider using the centralized ModuleLoader.
 *
 * To add a new module:
 * 1. Create the module in app/Modules/YourModule/
 * 2. Create a ServiceProvider in app/Modules/YourModule/Providers/YourModuleServiceProvider.php
 * 3. Add it to this array (optional - if the provider follows naming convention, it will be auto-discovered)
 *
 * Note: Routes, migrations, views, and translations are auto-loaded from all modules
 * by AppServiceProvider, so you don't need to manually load them in your module's ServiceProvider.
 */

return [
    // Core Application Provider
    App\Providers\AppServiceProvider::class,

    // Base Module Providers (Required - handles core functionality)
    App\Modules\Base\Providers\BaseServiceProvider::class,
    App\Modules\Base\Providers\RepositoryServiceProvider::class,

    // Module Service Providers (only register if they need custom bindings or boot logic)
    // These are the modules that actually exist in the codebase:

    App\Modules\Structure\Providers\StructureServiceProvider::class,

    // Note: The following modules are referenced in code but don't exist yet:
    // - Points
    // - Locations
    // - Categories
    // - Messages
    // - Reports
    // - QuestionCategory
    // - Favorites
    // - Ratings
    // - Commissions
    // - Wallet
    //
    // When these modules are created, add their ServiceProviders here if needed.
];
