<?php

namespace App\Providers;

use App\Models\Bungie;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        $this->registerPolicies();

        \Gate::define('hide-ads', function (Bungie $user) {
            if ($user === null) {
                return false;
            }

            return $user->isDonator();
        });
    }
}
