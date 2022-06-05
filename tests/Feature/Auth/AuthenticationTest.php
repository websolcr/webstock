<?php

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

test('show register page', function () {
    $response = $this->get('/register');

    $response->assertViewIs('authentication.register');
});

test('can register', function () {
    $response = $this->post('/register', [
        'name' => 'test name',
        'email' => 'testuser@gmail.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(Response::HTTP_FOUND);

    $this->assertDatabaseHas('users', [
        'name' => 'test name',
        'email' => 'testuser@gmail.com',
    ]);
});

test('show login page', function () {
    $response = $this->get('/login');

    $response->assertViewIs('authentication.login');
});

test('can login to central application', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertEquals($user->id, auth()->id());
});

it('will redirect to login when unauthenticated user enters url which is not login or register', function () {
    $response = $this->get('/any-url');

    $response->assertRedirect('/login');
});

it('will redirect to organization index page when authenticated user try to access login or register page', function () {
    actingAsSuperAdmin();

    collect(['/login', '/register'])->each(function (string $uri) {
        $response = $this->get($uri);

        $response->assertRedirect('/organization-index');
    });
});
