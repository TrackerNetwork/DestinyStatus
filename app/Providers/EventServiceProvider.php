<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\BungieSignedIn::class => [
            \App\Listeners\SignedInBadgeCheck::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
