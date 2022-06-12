<?php

namespace Domain\Audit\ServiceProviders;

use Domain\Audit\Listeners\SaveOnAudit;
use Domain\Audit\Interfaces\AuditableEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class AuditServiceProvider extends EventServiceProvider
{
    protected $listen = [
        AuditableEvent::class => [
            SaveOnAudit::class,
        ],
    ];
}
