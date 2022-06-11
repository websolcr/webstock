<?php

namespace Domain\Audit\ServiceProviders;

use Domain\Audit\Listeners\SaveOnAudit;
use Domain\Invitation\Events\InvitationSend;
use Domain\Invitation\Events\InvitationAccept;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class AuditServiceProvider extends EventServiceProvider
{
    protected $listen = [
        InvitationSend::class => [
            SaveOnAudit::class,
        ],

        InvitationAccept::class => [
            SaveOnAudit::class,
        ],
    ];
}
