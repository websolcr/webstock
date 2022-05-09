<?php

namespace Tests;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TenantTestCase extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->initializeTenancy();

        $this->beforeApplicationDestroyed(fn () => tenancy()->query()->get()->each->delete());
    }

    public function initializeTenancy(): mixed
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $tenant = Tenant::create([
            'user_id' => $user->id,
            'name' => Str::random(),
        ]);

        tenancy()->initialize($tenant);
        session(['tenant_id' => $tenant->id]);

        return $tenant;
    }

    public function tearDown(): void
    {
        config([
            'tenancy.queue_database_deletion' => false,
            'tenancy.delete_database_after_tenant_deletion' => true,
        ]);

        parent::tearDown();
    }
}
