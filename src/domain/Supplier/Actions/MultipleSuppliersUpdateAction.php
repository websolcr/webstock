<?php

namespace Domain\Supplier\Actions;

use Illuminate\Support\Collection;
use Domain\Supplier\Models\Supplier;
use Domain\Supplier\Data\SupplierData;

class MultipleSuppliersUpdateAction
{
    public function execute(Collection $modifiedSuppliers)
    {
        $modifiedSuppliers->each(function (SupplierData $supplierData) {
            app(SaveSupplierAction::class)->execute(
                supplierData: $supplierData,
                supplier: Supplier::find($supplierData->id)
            );
        });
    }
}
