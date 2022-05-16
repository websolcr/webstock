<?php

namespace App\Providers;

use App\Events\SwitchTenant;
use App\Events\InvitationSend;
use App\Listeners\SaveOnAudit;
use App\Events\InvitationAccept;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        SwitchTenant::class => [
          SaveOnAudit::class,
        ],

        InvitationSend::class => [
          SaveOnAudit::class,
        ],

        InvitationAccept::class => [
            SaveOnAudit::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
