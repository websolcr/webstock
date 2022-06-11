<?php

namespace Domain\Audit\Listeners;

use Domain\Audit\Models\Audit;
use Domain\Audit\Interfaces\AuditableEvent;

class SaveOnAudit
{
    public function handle(AuditableEvent $event)
    {
        Audit::create([
            'member_id' => $event->member(),
            'area' => $event->area(),
            'action' => $event->action(),
            'before_value' => $event->beforeValue(),
            'after_value' => $event->afterValue(),
        ]);
    }
}
