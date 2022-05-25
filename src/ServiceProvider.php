<?php

namespace Invi5h\LaravelStaticQueue;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Register services.
     */
    public function register() : void
    {
        parent::register();

        $this->mergeConfigFrom(dirname(__DIR__).'/config/laravelstaticqueue.php', 'laravelstaticqueue');
    }

    /**
     * Bootstrap services.
     */
    public function boot() : void
    {
        if ($this->app->runningInConsole()) {
            $paths = [
                    __DIR__.'/../config/laravelstaticqueue.php' => config_path('laravelstaticqueue.php'),
            ];
            $this->publishes($paths, 'laravelstaticqueue');
        }
    }
}
