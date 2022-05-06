<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class OrganizationFeatureTest extends TestCase
{
    /** @test */
    public function can_create_organization()
    {
        $this->actingAs(User::factory()->create());

        $data = [
            'name' => 'test organization',
        ];

        $response = $this->postJson('/api/tenant/create', $data);

        $response->assertNoContent();

        $this->assertDatabaseHas('tenants', $data);
    }
}
