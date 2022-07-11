<?php

namespace Domain\Supplier\Actions;

use Illuminate\Support\Str;
use Support\Audit\AuditArea;
use Support\Audit\AuditAction;
use Domain\Supplier\Models\Supplier;
use Domain\Supplier\Data\SupplierData;
use Domain\Supplier\Events\CreateSupplierEvent;
use Domain\Supplier\Events\UpdateSupplierEvent;

class SaveSupplierAction
{
    public function execute(SupplierData $supplierData, ?Supplier $supplier = new Supplier()): Supplier
    {
        $supplier->id
            ? $this->logAsUpdate($supplier, $supplierData)
            : $this->logAsCreate($supplier);

        $supplier->fill([
            'name' => $supplierData->name,
            'email' => $supplierData->email,
            'address' => $supplierData->address,
            'primary_contact_no' => $supplierData->primaryContactNo,
            'secondary_contact_no' => $supplierData->secondaryContactNo,
        ]);

        $supplier->save();

        return $supplier;
    }

    protected function logAsCreate(Supplier $supplier)
    {
        event(new CreateSupplierEvent(
            supplier: $supplier,
            area: AuditArea::SUPPLIER,
            action: AuditAction::CREATE
        ));
    }

    protected function logAsUpdate(Supplier $supplier, SupplierData $supplierData)
    {
        $properties = array_keys(get_object_vars($supplierData));

        collect($properties)->each(function ($property) use ($supplier, $supplierData) {
            if ($property === 'id') {
                return;
            }

            if ($supplier[Str::snake($property)] !== $supplierData->{$property}) {
                event(new UpdateSupplierEvent(
                    supplier: $supplier,
                    area: AuditArea::SUPPLIER,
                    action: AuditAction::UPDATE,
                    property: Str::snake($property),
                    before: $supplier[Str::snake($property)],
                    after: $supplierData->{$property},
                ));
            }
        });
    }
}
