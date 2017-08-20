<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!defined('CACHE_ENABLED')) {
            define('CACHE_ENABLED', config('destiny.cache', true));
        }
        if (!defined('CACHE_DEFAULT')) {
            define('CACHE_DEFAULT', config('destiny.cache_default', false));
        }
        if (!defined('CACHE_INDEX')) {
            define('CACHE_INDEX', config('destiny.cache_index', 60));
        }
        if (!defined('CACHE_PLAYER')) {
            define('CACHE_PLAYER', config('destiny.cache_player'));
        }

        $this->bootBungieSocialite();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
        $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);
    }

    private function bootBungieSocialite()
    {
        $socialite = $this->app->make(\Laravel\Socialite\Contracts\Factory::class);
        $socialite->extend('bungie', function ($app) use ($socialite) {
            $config = $app['config']['services.bungie'];
            return $socialite->buildProvider(BungieSocialiteProvider::class, $config);
        });
    }
}
