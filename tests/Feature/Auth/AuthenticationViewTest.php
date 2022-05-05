<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class AuthenticationViewTest extends TestCase
{
    /** @test */
    public function can_show_login_page()
    {
        $this->get('/login')->assertViewIs('authentication.login');
    }

    /** @test */
    public function can_show_register_page()
    {
        $this->get('/register')->assertViewIs('authentication.register');
    }

    /** @test */
    public function it_will_render_frontend_application_when_authenticated_user_enter_any_url()
    {
        $this->actingAs(User::factory()->create());

        $this->get('/anyUrl')->assertViewIs('index');
    }
}
