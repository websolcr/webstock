<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tenant;

class TenantFeatureTest extends TestCase
{
    /** @test */
    public function can_list_all_tenants_of_authenticated_user()
    {
        $this->actingAs(User::factory()->create());

        collect(['org_1', 'org_2', 'org_3'])->each(function (string $organizationName) {
            Tenant::create([
                'name' => $organizationName,
                'user_id' => auth()->id(),
            ]);
        });

        $response = $this->getJson('api/tenant/index');

        $response->assertJsonCount(3);
    }
}
