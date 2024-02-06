<?php

namespace App\Providers;

use App\Events\Subscription\InvoicePaymentFailed;
use App\Events\Subscription\Subscribed;
use App\Events\Subscription\SubscriptionCancelled;
use App\Listeners\Subscription\SendInvoicePaymentFailedNotification;
use App\Listeners\Subscription\SendSubscribedNotification;
use App\Listeners\Subscription\SendSubscriptionCancellationNotification;
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
        Subscribed::class => [
            SendSubscribedNotification::class,
        ],
        SubscriptionCancelled::class => [
            SendSubscriptionCancellationNotification::class
        ],
        InvoicePaymentFailed::class => [
            SendInvoicePaymentFailedNotification::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
