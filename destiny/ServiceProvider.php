<?php namespace Destiny;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('destiny.client', function($app)
		{
			$apiKey = $app['config']->get('destiny.key');

			return new DestinyClient($apiKey);
		});

		$this->app->singleton('destiny.manifest', function($app)
		{
			return new DestinyManifest;
		});

		$this->app->singleton('destiny.platform', function($app)
		{
			return new DestinyPlatform;
		});

		$this->app->singleton('destiny', function($app)
		{
			return new Destiny($app['destiny.client'], $app['destiny.platform']);
		});
	}
}
