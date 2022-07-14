<?php

namespace App\Http\Requests;

use Illuminate\Support\Collection;
use Domain\Supplier\Data\SupplierData;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'modifiedSuppliers.*.name' => 'required|max:255',
            'modifiedSuppliers.*.email' => 'required|email',
            'modifiedSuppliers.*.address' => 'required|max:255',
            'modifiedSuppliers.*.primary_contact_no' => 'required|max:15',
            'modifiedSuppliers.*.secondary_contact_no'=> 'nullable|max:15',
        ];
    }

    public function modifiedSuppliers(): Collection
    {
        return collect($this->get('modifiedSuppliers'))->map(function ($supplier) {
            return new SupplierData(
                name: $supplier['name'],
                email: $supplier['email'],
                address: $supplier['address'],
                primaryContactNo: $supplier['primary_contact_no'],
                secondaryContactNo: $supplier['secondary_contact_no'] ?? null,
                id: $supplier['id'],
            );
        });
    }
}
