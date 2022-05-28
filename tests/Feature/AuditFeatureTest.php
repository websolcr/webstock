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

        $response = $this->getJson('api/audits?'.http_build_query([
            'perPage' => 5
            ]));

        $response->assertJsonCount(5, 'data');
    }

    /** @test */
    public function can_filter_audits_for_given_filters()
    {
        Audit::factory()->create([
            'action' => 'send',
            'area' => 'invitation',
        ]);

        $response = $this->getJson('api/audits?' . http_build_query([
                    'action' => 'send',
                    'area' => 'invitation',
                    'perPage' => 5
                ]
            ));

        $response->assertJsonCount(1, 'data');
    }
}
