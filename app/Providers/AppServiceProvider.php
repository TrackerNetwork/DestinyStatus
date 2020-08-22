<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
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
        $this->bootBladeChanges();
    }

    public function register(): void
    {
        //
    }

    private function bootBungieSocialite()
    {
        $socialite = $this->app->make(\Laravel\Socialite\Contracts\Factory::class);
        $socialite->extend('bungie', function ($app) use ($socialite) {
            $config = $app['config']['services.bungie'];

            return $socialite->buildProvider(BungieSocialiteProvider::class, $config);
        });
    }

    private function bootBladeChanges()
    {
        Blade::if('env', function ($environment) {
            return app()->environment($environment);
        });

        Blade::directive('bool', function ($expression) {
            return "<?php echo boolval($expression) ? 'true' : 'false'; ?>";
        });

        Blade::directive('bungie', function ($expression) {
            return "<?php echo App\Helpers\DestinyHelper::bungie($expression); ?>";
        });

        Blade::directive('n', function ($expression) {
            [$value, $decimals] = explode(',', $expression);

            if (empty($decimals)) {
                $decimals = 0;
            }

            return "<?php echo Aoo\Helpers\StringHelper::number($value, $decimals); ?>";
        });
    }
}
