<?php

namespace App\Providers;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        \Event::listen('Illuminate\Cache\Events\KeyWritten', function ($event) {
            Bugsnag::leaveBreadcrumb('Cache written', 'process', [
                'key'   => $event->key,
                'value' => $event->value,
                'ttl'   => "{$event->minutes}mins",
            ]);
        });

        Bugsnag::setAppVersion(version());
    }
}
