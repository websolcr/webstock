<?php

namespace Domain\Supplier\Actions;

use Domain\Supplier\Models\Supplier;
use Domain\Supplier\Data\SupplierData;
use Domain\Supplier\Events\SaveSupplierEvent;

class SaveSupplierAction
{
    public function execute(SupplierData $supplierData): Supplier
    {
        $supplier = Supplier::firstOrNew(
            [
                'email' => $supplierData->email,
            ],
            [
                'name' => $supplierData->name,
                'email' => $supplierData->email,
                'address' => $supplierData->address,
                'primary_contact_no' => $supplierData->primaryContactNumber,
                'secondary_contact_no' => $supplierData->secondaryContactNumber,
            ]
        );

        event(new SaveSupplierEvent($supplier));

        $supplier->save();

        return $supplier;
    }
}
