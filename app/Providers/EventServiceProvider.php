<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
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
                'key' => $event->key,
                'value' => $event->value,
                'ttl' => "{$event->minutes}mins",
            ]);
        });

        \Bugsnag::setAppVersion(version());
    }
}
