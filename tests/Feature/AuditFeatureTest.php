<?php

namespace Tests\Feature;

use App\Models\Audit;
use Tests\TenantTestCase;

class AuditFeatureTest extends TenantTestCase
{
    /** @test */
    public function can_list_audits()
    {
        Audit::factory(10)->create();

        $response = $this->getJson('api/audits');

        $response->assertJsonCount(10);
    }
}
