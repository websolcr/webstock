<?php

namespace Tests;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TenantTestCase extends TestCase
{
    use DatabaseMigrations;

    protected bool $tenancy = false;

    public function setUp(): void
    {
        parent::setUp();

        if ($this->tenancy) {
            $this->initializeTenancy();
        }
    }

    public function initializeTenancy()
    {
        $tenant = Tenant::create();
        tenancy()->initialize($tenant);
    }
}
