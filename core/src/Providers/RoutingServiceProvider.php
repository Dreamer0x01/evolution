<?php

namespace EvolutionCMS\Providers;

use EvolutionCMS\Extensions\Router;
use Illuminate\Routing\RoutingServiceProvider as IlluminateRoutingServiceProvider;
use Illuminate\Support\Facades\Route;

class RoutingServiceProvider extends IlluminateRoutingServiceProvider
{
    /**
     * Register the service provider and routes
     */
    public function register()
    {
        parent::register();

        if (is_readable(EVO_CORE_PATH . 'custom/routes.php')) {
            include EVO_CORE_PATH . 'custom/routes.php';
        }

        Route::fallbackToParser();
    }

    /**
     * We need to overload provider to register our router
     * to use custom route methods
     */
    protected function registerRouter()
    {
        $this->app->singleton('router', function ($app) {
            return new Router($app['events'], $app);
        });
    }
}
