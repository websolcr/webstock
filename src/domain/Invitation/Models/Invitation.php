<?php

namespace Domain\Invitation\Models;

use App\Models\BaseModel;
use Database\Factories\InvitationFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
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
