<?php

namespace Tests\Feature;

use App\Models\Member;
use Tests\TenantTestCase;

class MembersFeatureTest extends TenantTestCase
{
    /** @test */
    public function list_all_members()
    {
        Member::factory(10)->create();

        $response = $this->getJson('/api/members');

        $response->assertJsonCount(Member::count());
    }
}
