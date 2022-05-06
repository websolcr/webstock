<?php

namespace App\Models;

use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $fillable = [
        'user_id',
        'name',
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'user_id',
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
