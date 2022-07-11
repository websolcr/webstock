<?php

namespace Domain\Supplier\Events;

use Domain\Supplier\Models\Supplier;
use Domain\Audit\Interfaces\AuditableEvent;

class SaveSupplierEvent implements AuditableEvent
{
    public function __construct(
        public Supplier $supplier,
    ) {
    }

    public function member(): string
    {
        return authMember()->id;
    }

    public function area(): string
    {
        return 'supplier';
    }

    public function action(): string
    {
        return 'create';
    }

    public function beforeValue(): ?string
    {
        return null;
    }

    public function afterValue(): ?string
    {
        return $this->supplier->toJson();
    }
}
