<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class Invitation extends AppModel
{
    use HasFactory;
    use CentralConnection;

    protected $fillable = [
        'email',
        'tenant_id',
        'remember_token',
    ];
}
