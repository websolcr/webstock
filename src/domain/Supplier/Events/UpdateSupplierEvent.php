<?php

namespace Domain\Supplier\Events;

use Domain\Audit\Interfaces\AuditableEvent;
use Domain\Supplier\Data\SupplierData;
use Domain\Supplier\Models\Supplier;

class UpdateSupplierEvent implements AuditableEvent
{
    public function __construct(
        public Supplier $supplier,
        public SupplierData $supplierData,
    )
    {
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
       return 'update';
    }

    public function beforeValue(): ?string
    {
        return $this->supplier->toJson();
    }

    public function afterValue(): ?string
    {
        return json_encode($this->supplierData);
    }
}
