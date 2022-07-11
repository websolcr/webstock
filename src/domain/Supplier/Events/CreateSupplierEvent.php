<?php

namespace Domain\Supplier\Events;

use Support\Audit\AuditArea;
use Support\Audit\AuditAction;
use Domain\Supplier\Models\Supplier;
use Domain\Audit\Interfaces\AuditableEvent;

class CreateSupplierEvent implements AuditableEvent
{
    public function __construct(
        protected Supplier $supplier,
        protected AuditArea $area,
        protected AuditAction $action
    ) {
    }

    public function member(): string
    {
        return authMember()->id;
    }

    public function area(): AuditArea
    {
        return $this->area;
    }

    public function action(): AuditAction
    {
        return $this->action;
    }

    public function beforeValue(): ?string
    {
        return null;
    }

    public function afterValue(): ?string
    {
        return $this->supplier->name;
    }
}
