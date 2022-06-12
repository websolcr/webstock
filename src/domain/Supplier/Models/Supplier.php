<?php

namespace Domain\Supplier\Models;

use App\Models\BaseModel;
use Database\Factories\SupplierFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'address',
        'primary_contact_no',
        'secondary_contact_no',
    ];

    public static function newFactory(): SupplierFactory
    {
        return SupplierFactory::new();
    }
}
