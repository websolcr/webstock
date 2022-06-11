<?php

namespace App\Actions\Tenant;

use Stancl\Tenancy\Contracts\TenantWithDatabase;

class AttachOwnerToTenant
{
    public function __construct(
        protected TenantWithDatabase $tenant
    ) {
    }

    public function handle(): void
    {
        auth()->user()->organizations()->attach($this->tenant);
    }
}
