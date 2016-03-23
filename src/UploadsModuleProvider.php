<?php
namespace Anavel\Uploads;

use Anavel\Foundation\Support\ModuleProvider;
use Request;

class UploadsModuleProvider extends ModuleProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the module provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'anavel-uploads');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'anavel-uploads');

        $this->publishes([
            __DIR__.'/../config/anavel-uploads.php' => config_path('anavel-uploads.php'),
        ], 'config');
    }

    /**
     * Register the module provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/anavel-uploads.php', 'anavel-uploads');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    public function name()
    {
        return config('anavel-uploads.name');
    }

    public function routes()
    {
        return __DIR__.'/Http/routes.php';
    }

    public function mainRoute()
    {
        return route('anavel-uploads.home');
    }

    public function hasSidebar()
    {
        return false;
    }

    public function sidebarMenu()
    {
        return null;
    }

    public function isActive()
    {
        $uri = Request::route()->uri();

        if (strpos($uri, 'uploads') !== false) {
            return true;
        }

        return false;
    }
}
