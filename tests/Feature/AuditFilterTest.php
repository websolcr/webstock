<?php

namespace Tests\Feature;

use App\Models\Audit;
use Tests\TenantTestCase;

class AuditFilterTest extends TenantTestCase
{
    /** @test */
    public function can_filter_audits_for_given_filters()
    {
        Audit::factory()->create([
            'action' => 'send',
            'area' => 'invitation'
        ]);

        $response = $this->getJson('api/audits/filter?'.http_build_query(
            [
                'action' => 'send',
                'area' => 'invitation',
            ]
        ));

        $response->assertJson(Audit::where('action', 'send')->where('area', 'invitation')->get()->toArray());
    }
}
