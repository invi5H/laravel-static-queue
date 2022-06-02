<?php

namespace Invi5h\LaravelStaticQueue;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Invi5h\LaravelStaticQueue\Contracts\QueueServiceInterface;

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

        $this->app->singleton(QueueServiceInterface::class, QueueService::class);
        $manager = $this->app['queue'];
        if (method_exists($manager, 'addConnector')) {
            $manager->addConnector('static', fn() => new Connector());
        }
    }
}
