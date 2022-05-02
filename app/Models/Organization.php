<?php

namespace App\Models;

use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organization extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public function owner(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
