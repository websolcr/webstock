<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class AuthenticationViewTest extends TestCase
{
    /** @test */
    public function can_show_login_page()
    {
        $this->get('/login')->assertViewIs('authentication.login');
    }

    /** @test */
    public function can_show_register_pae()
    {
        $this->get('/register')->assertViewIs('authentication.register');
    }

    /** @test */
    public function user_will_unauthorized_when_trying_to_go_any_other_page_except_login_or_register()
    {
        $response = $this->get('/anyOtherUri');

        $this->assertEquals('Unauthenticated.', $response->exception->getMessage());
    }

    /** @test */
    public function user_will_redirect_when_trying_to_go_any_other_page_except_login_or_register()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/anyOtherUri');

        $response->assertStatus(200);

        $response->assertViewIs('index');
    }
}
