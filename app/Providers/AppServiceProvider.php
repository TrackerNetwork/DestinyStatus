<?php

namespace App\Providers;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

/**
 * Class AppServiceProvider.
 */
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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias('bugsnag.logger', Log::class);
        $this->app->alias('bugsnag.logger', LoggerInterface::class);
    }
}
