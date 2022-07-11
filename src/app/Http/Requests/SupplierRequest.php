<?php

namespace App\Http\Requests;

use Domain\Supplier\Data\SupplierData;
use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'address' => 'required|max:255',
            'primary_contact_no' => 'required|max:15',
            'secondary_contact_no'=> 'nullable|max:15',
        ];
    }

    public function data(): SupplierData
    {
        return new SupplierData(
            name: $this->input('name'),
            email: $this->input('email'),
            address: $this->input('address'),
            primaryContactNumber: $this->input('primary_contact_no'),
            secondaryContactNumber: $this->input('secondary_contact_no')
        );
    }
}
