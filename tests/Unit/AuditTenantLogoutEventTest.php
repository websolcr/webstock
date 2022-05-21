<?php

namespace Tests\Unit;

use App\Models\Member;
use App\Models\Tenant;
use Tests\TenantTestCase;

class AuditTenantLogoutEventTest extends TenantTestCase
{
    /** @test */
    public function audit_as_logout_when_switch_between_tenants()
    {
        $currentlyActiveTenant = tenancy()->tenant;

        auth()->user();

        $tenant = Tenant::create([
            'name' => 'test organization',
            'user_id' => auth()->id(),
        ]);

        $response = $this->postJson('/api/tenant/'.$tenant->id.'/initialize');

        $response->assertOk();

        $this->assertEquals($tenant->id, tenancy()->tenant->id);

        tenancy()->initialize($currentlyActiveTenant);

        $this->assertDatabaseHas('audits', [
            'member_id' => Member::id(),
            'area' => 'organization',
            'action' => 'switch',
            'before_value' => tenant('name'),
            'after_value' => 'classified',
        ]);
    }
}
