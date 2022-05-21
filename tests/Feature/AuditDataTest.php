<?php

namespace Tests\Feature;

use App\Data\AuditData;
use Tests\TenantTestCase;

class AuditDataTest extends TenantTestCase
{
    /** @test */
    public function can_list_all_audit_filters()
    {
        collect(['areas', 'actions'])->each(function (string $filter) {
            $response = $this->getJson('api/audit-data?'.http_build_query([
                    'filter' => $filter,
                ]));

            $response->assertJson(AuditData::FILTERS[$filter]);
        });
    }
}
