<?php

namespace Adminetic\BusinessHour\Providers;

use Adminetic\BusinessHour\Http\Livewire\Admin\BusinessHourExceptions;
use Adminetic\BusinessHour\Http\Livewire\Admin\BusinessHourPanel;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class BusinessHourServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Publish Ressource
        if ($this->app->runningInConsole()) {
            $this->publishResource();
        }
        // Register Resources
        $this->registerResource();
        // Register View Components
        $this->registerLivewireComponents();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/business_hour.php', 'business_hour');
    }

    /**
     * Register Package Resource.
     *
     * @return void
     */
    protected function registerResource()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'business_hour'); // Loading Views Files
    }

    /**
     * Publish Package Resource.
     *
     * @return void
     */
    protected function publishResource()
    {
        // Publish Config File
        $this->publishes([
            __DIR__.'/../../config/business_hour.php' => config_path('business_hour.php'),
        ], 'business-hour-config');
    }

    /**
     * Register Components.
     *
     * @return void
     */
    protected function registerLivewireComponents()
    {
        Livewire::component('business-hour-exceptions', BusinessHourExceptions::class);
        Livewire::component('business-hour-panel', BusinessHourPanel::class);
    }
}
