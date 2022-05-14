<?php

namespace Tests\Feature;

use Tests\TenantTestCase;

class ActiveTenantTest extends TenantTestCase
{
    /** @test */
    public function can_give_active_tenant()
    {
        $response = $this->getJson('/api/active-tenant');

        $response->assertOk();
    }
}
