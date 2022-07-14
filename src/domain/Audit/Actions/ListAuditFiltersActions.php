<?php

namespace Domain\Audit\Actions;

use Support\Audit\AuditArea;
use Support\Audit\AuditAction;

class ListAuditFiltersActions
{
    public function execute(): array
    {
        return [
            'areas' => AuditArea::getAllAreas(),
            'actions' => AuditAction::getAllActions(),
        ];
    }
}
