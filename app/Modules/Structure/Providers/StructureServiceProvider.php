<?php

namespace App\Modules\Structure\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class StructureServiceProvider extends ServiceProvider
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
        // Routes, migrations, views, and translations are automatically loaded by AppServiceProvider
        // using the centralized ModuleLoader. However, this module has custom Blade components
        // that need to be registered, so we handle views here for component registration.

        // Load views under namespace 'structure' if present
        $views = base_path('app/Modules/Structure/Resources/views');
        if (is_dir($views)) {
            $this->loadViewsFrom($views, 'structure');

            // Register Blade components
            Blade::componentNamespace('App\\Modules\\Structure\\View\\Components', 'structure');

            // Register individual components with custom aliases
            Blade::component('breadcrumb.breadcrumb', \App\Modules\Structure\View\Components\Breadcrumb\Breadcrumb::class);
            Blade::component('form.form-component', \App\Modules\Structure\View\Components\Form\FormComponent::class);
            Blade::component('input.input-field', \App\Modules\Structure\View\Components\Input\InputField::class);
            Blade::component('input.image-input', \App\Modules\Structure\View\Components\Input\ImageInput::class);
            Blade::component('editor.summernote', \App\Modules\Structure\View\Components\Editor\Quill::class);
            Blade::component('editor.quill', \App\Modules\Structure\View\Components\Editor\Quill::class);
            Blade::component('cards.page-card', \App\Modules\Structure\View\Components\Cards\PageCard::class);
        }
    }
}
