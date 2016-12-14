<?php

namespace App\Providers;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Contracts\Logging\Log;
use \Psr\Log\LoggerInterface;

/**
 * Class AppServiceProvider
 * @package App\Providers
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
		define('CACHE_ENABLED', config('destiny.cache', true));
		define('CACHE_DEFAULT', config('destiny.cache_default', false));
		define('CACHE_INDEX', config('destiny.cache_index', 60));
		define('CACHE_PLAYER',  config('destiny.cache_player'));
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
