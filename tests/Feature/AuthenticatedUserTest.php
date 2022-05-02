<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class AuthenticatedUserTest extends TestCase
{
    private function login()
    {
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
