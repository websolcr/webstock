<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Organization;

class AuthenticatedUserTest extends TestCase
{
    private function login()
    {
        dd(Organization::create());
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function can_fetch_authenticated_user()
    {
        $this->login();

        $response = $this->getJson('/api/myself');

        $user = auth()->user();

        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
