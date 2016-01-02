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
		$this->app->bindShared('destiny.client', function($app)
		{
			$apiKey = $app['config']->get('destiny.key');

			return new DestinyClient($apiKey);
		});

		$this->app->bindShared('destiny.manifest', function($app)
		{
			return new DestinyManifest;
		});

		$this->app->bindShared('destiny.platform', function($app)
		{
			return new DestinyPlatform;
		});

		$this->app->bindShared('destiny', function($app)
		{
			return new Destiny($app['destiny.client'], $app['destiny.platform']);
		});
	}
}
