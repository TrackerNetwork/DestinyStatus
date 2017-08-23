<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\BungieSignedIn::class => [
            \App\Listeners\SignedInBadgeCheck::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('Illuminate\Cache\Events\KeyWritten', function ($event) {
            \Bugsnag::leaveBreadcrumb('Cache written', 'process', [
                'key'   => $event->key,
                'value' => $event->value,
                'ttl'   => "{$event->minutes}mins",
            ]);
        });

        \Bugsnag::setAppVersion(version());
    }
}
