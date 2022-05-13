<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class Invitation extends AppModel
{
    use HasFactory;
    use CentralConnection;
    use SoftDeletes;

    protected $fillable = [
        'email',
        'tenant_id',
        'token',
    ];
}
