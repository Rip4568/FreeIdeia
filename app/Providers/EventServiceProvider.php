<?php

namespace App\Providers;

use App\Events\NotificationEvent;
use App\Events\WelcomeNotificationEvent;
use App\Listeners\NotificationListner;
use App\Listeners\WelcomeNotificationListner;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();
        Event::listen(
            NotificationEvent::class,
            NotificationListner::class
        );
        Event::listen(
            WelcomeNotificationEvent::class,
            WelcomeNotificationListner::class
        );
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
