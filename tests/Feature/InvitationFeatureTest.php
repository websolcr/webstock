<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Str;
use Domain\Member\Models\Member;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Domain\Invitation\Models\Invitation;
use Domain\Invitation\Events\InvitationSend;
use Domain\Invitation\Events\InvitationAccept;
use Symfony\Component\HttpFoundation\Response;
use Domain\Invitation\Mails\MembershipInvitation;

beforeEach(fn () => beginTestInsideTenant());

afterEach(fn () => endTestInsideTenant());

const CENTRAL_DATABASE_CONNECTION = 'pgsql_test';

test('can send invitation', function () {
    Mail::fake();

    $receiver = 'testmail@test.com';

    $this->postJson('api/invitations/store', [
        'email_to' => $receiver,
        'auditable' => true,
    ]);

    $this->assertDatabaseHas('invitations', [
        'email' => $receiver,
        'tenant_id' => tenant('id'),
    ], CENTRAL_DATABASE_CONNECTION);

    $this->assertDatabaseHas('audits', [
        'member_id' => Member::id(),
        'area' => 'invitation',
        'action' => 'send',
        'before_value' => null,
        'after_value' => $receiver,
    ]);

    Mail::assertQueued(MembershipInvitation::class, function ($email) use ($receiver) {
        return $email->hasTo($receiver);
    });
});

test('existing user accepts invitation then user redirect to login page', function () {
    $user = User::factory()->create();

    $invitation = Invitation::factory()->create([
        'email' => $user->email,
        'tenant_id' => tenant('id'),
        'token' => Str::random(200),
        'sender_id'=> $user->id,
    ]);

    $invitationUrl = URL::signedRoute('invitation.accept', [
        'invitation_token' => $invitation->token,
    ]);

    auth()->logout();

    $response = $this->get($invitationUrl);

    $response->assertViewIs('authentication.login')->assertViewHas('invitationData', [
        'email' => $invitation->email,
        'invitation_token' => $invitation->token,
    ]);
});

test('can not become a member with changed invitation url', function () {
    $user = User::factory()->create();

    $invitation = Invitation::factory()->create([
        'email' => 'newuser@test.com',
        'tenant_id' => tenant('id'),
        'token' => Str::random(200),
        'sender_id'=> $user->id,
    ]);

    auth()->logout();

    $response = $this->get(route('invitation.accept', [
        'invitation_token' => $invitation->token,
        'signature' => Str::random(),
    ]));

    $response->assertStatus(Response::HTTP_FORBIDDEN);
});

test('non existing user accepts invitation then user will redirect to register page', function () {
    $user = User::factory()->create();

    $invitation = Invitation::factory()->create([
        'email' => 'newuser@test.com',
        'tenant_id' => tenant('id'),
        'token' => Str::random(200),
        'sender_id'=> $user->id,
    ]);

    $invitationUrl = URL::signedRoute('invitation.accept', [
        'invitation_token' => $invitation->token,
    ]);

    $response = $this->get($invitationUrl);

    $response->assertViewIs('authentication.register')->assertViewHas('invitationData', [
        'email' => $invitation->email,
        'invitation_token' => $invitation->token,
    ]);
});

test('existing user becomes member after accept the invitation', function () {
    $user = User::factory()->create();

    $invitation = Invitation::factory()->create([
        'email' => $user->email,
        'tenant_id' => tenant('id'),
        'token' => Str::random(200),
        'sender_id' => auth()->id(),
    ]);

    auth()->logout();
    tenancy()->end();

    $response = $this->post('/login', [
        'email' => $invitation->email,
        'password' => 'password',
        'invitation_token' => $invitation->token,
    ]);

    $response->assertStatus(302);

    $this->assertEquals(auth()->id(), $user->id);

    $this->assertDatabaseHas('tenant_user', [
        'tenant_id' => $invitation->tenant_id,
        'user_id' => $user->id,
    ], CENTRAL_DATABASE_CONNECTION);

    $this->assertDatabaseHas('audits', [
        'member_id' => Member::id(),
        'area' => 'invitation',
        'action' => 'accept',
        'before_value' => null,
        'after_value' => $user->email,
    ]);

    $this->assertSoftDeleted($invitation);

    $this->assertDatabaseHas('members', [
        'global_id' => $user->id,
    ]);
});

test('non existing user becomes member after accept the invitation', function () {
    $user = User::factory()->make();

    $invitation = Invitation::factory()->create([
        'email' => 'newuser@test.com',
        'tenant_id' => tenant('id'),
        'token' => Str::random(200),
        'sender_id'=> auth()->id(),
    ]);

    auth()->logout();
    tenancy()->end();

    $response = $this->post('/register', [
        'name' => $user->name,
        'email' => $invitation->email,
        'password' => 'password',
        'password_confirmation' => 'password',
        'invitation_token' => $invitation->token,
    ]);

    $response->assertStatus(302);

    $this->assertDatabaseHas('tenant_user', [
        'tenant_id' => $invitation->tenant_id,
        'user_id' => User::firstWhere('email', $invitation->email)->id,
    ], CENTRAL_DATABASE_CONNECTION);

    $this->assertDatabaseHas('audits', [
        'member_id' => Member::id(),
        'area' => 'invitation',
        'action' => 'accept',
        'before_value' => null,
        'after_value' => $invitation->email,
    ]);

    $this->assertSoftDeleted($invitation);

    $this->assertDatabaseHas('members', [
        'global_id' => User::firstWhere('email', $invitation->email)->id,
    ]);
});

test('system will notify when invitation sent', function () {
    Event::fake(InvitationSend::class);

    $this->postJson('api/invitations/store', [
        'email_to' => 'testmail@test.com',
    ]);

    Event::assertDispatched(InvitationSend::class, function ($event) {
        return [
            $event->invitation->email = 'testmail@test.com',
        ];
    });
});

test('system will notify when a invitation accept ', function () {
    Event::fake(InvitationAccept::class);

    $invitation = Invitation::factory()->create([
        'email' => 'newuser@test.com',
        'tenant_id' => tenant('id'),
        'token' => Str::random(200),
        'sender_id'=> auth()->id(),
    ]);

    auth()->logout();
    tenancy()->end();

    $this->post('/register', [
        'name' => 'test name',
        'email' => $invitation->email,
        'password' => 'password',
        'password_confirmation' => 'password',
        'invitation_token' => $invitation->token,
    ]);

    Event::assertDispatched(InvitationAccept::class, function ($event) use ($invitation) {
        return [
            $event->invitation->email = $invitation->email,
        ];
    });
});

test('can not access invitation accept page without an invitation', function () {
    $invitationUrl = URL::signedRoute('invitation.accept', [
        'invitation_token' => Str::random(200),
    ]);

    $response = $this->get($invitationUrl);

    $response->assertStatus(Response::HTTP_UNAUTHORIZED);
});

test('can not invite to existing member', function () {
    $user = User::factory()->create();

    Member::create([
        'global_id' => $user->id,
        'name'=>$user->name,
        'email'=>$user->email,
        'role'=> 'admin',
    ]);

    $response = $this->postJson('api/invitations/store', [
        'email_to' => $user->email,
        'auditable' => true,
    ]);

    $response->assertNoContent();

    $this->assertDatabaseMissing('invitations', [
        'email' => $user->email,
        'tenant_id' => tenant('id'),
    ], CENTRAL_DATABASE_CONNECTION);
});

test('when inviting already invited user, user will receive the same invitation what he got before', function () {
    Event::fake(InvitationSend::class);

    $user = User::factory()->create();

    Invitation::factory()->create([
        'email' => 'testmail@test.com',
        'token' => Str::random(200),
        'sender_id'=> $user->id,
    ]);

    $this->postJson('api/invitations/store', [
        'email_to' => 'testmail@test.com',
    ]);

    $this->assertDatabaseCount('invitations', 1, CENTRAL_DATABASE_CONNECTION);

    Event::assertDispatched(InvitationSend::class, function ($event) {
        return [
            $event->invitation->email = 'testmail@test.com',
        ];
    });
});
