<?php

namespace App\Listeners;

use App\Models\Audit;
use App\Interfaces\AuditableEvent;

class SaveOnAudit
{
    public function handle(AuditableEvent $event)
    {
        Audit::create([
            'member' => $event->member(),
            'area' => $event->area(),
            'action' => $event->action(),
            'before_value' => $event->beforeValue(),
            'after_value' => $event->afterValue(),
        ]);
    }
}
