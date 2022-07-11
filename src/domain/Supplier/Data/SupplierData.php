<?php

namespace Domain\Supplier\Data;

class SupplierData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $address,
        public string $primaryContactNumber,
        public ?string $secondaryContactNumber,
        public ?string $id = null,
    ) {
    }
}
