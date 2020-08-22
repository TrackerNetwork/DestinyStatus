<?php

namespace App\Providers;

use Destiny\Destiny;
use Destiny\DestinyClient;
use Destiny\DestinyManifest;
use Destiny\DestinyPlatform;
use Illuminate\Support\ServiceProvider;

class DestinyServiceProvider extends ServiceProvider
{
    public function register(): void
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
