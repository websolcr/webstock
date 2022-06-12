<?php

namespace Domain\Supplier\Actions;

use Illuminate\Support\Collection;
use Domain\Supplier\Models\Supplier;
use Domain\Supplier\Data\SupplierData;
use Domain\Supplier\Events\UpdateSupplierEvent;

class MultipleSuppliersUpdateAction
{
    public function execute(Collection $modifiedSuppliers)
    {
        $modifiedSuppliers->each(function (SupplierData $supplierData) {
            $supplier = Supplier::firstOrNew(
                ['id' => $supplierData->id],
                [
                    'name' => $supplierData->name,
                    'email' => $supplierData->email,
                    'address' => $supplierData->address,
                    'primary_contact_no' => $supplierData->primaryContactNumber,
                    'secondary_contact_no' => $supplierData->secondaryContactNumber,
                ]
            );

            event(new UpdateSupplierEvent($supplier, $supplierData));

            $supplier->save();
        });
    }
}
