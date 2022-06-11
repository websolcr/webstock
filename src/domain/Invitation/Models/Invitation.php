<?php

namespace Domain\Invitation\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Domain\Invitation\Factories\InvitationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class Invitation extends BaseModel
{
    use HasFactory;
    use CentralConnection;
    use SoftDeletes;

    protected $fillable = [
        'email',
        'tenant_id',
        'token',
        'sender_id',
    ];

    public static function newFactory(): InvitationFactory
    {
        return InvitationFactory::new();
    }
}
