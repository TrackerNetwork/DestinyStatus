<?php

namespace Destiny;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('destiny.client', function () {
            $apiKey = config('destiny.key');

            return new DestinyClient($apiKey);
        });

        $this->app->singleton('destiny.manifest', function () {
            return new DestinyManifest();
        });

        $this->app->singleton('destiny.platform', function () {
            return new DestinyPlatform();
        });

        $this->app->singleton('destiny', function ($app) {
            return new Destiny($app['destiny.client'], $app['destiny.platform']);
        });
    }
}
