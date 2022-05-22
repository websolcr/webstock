<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Member;
use Tests\TenantTestCase;
use App\Models\Invitation;
use Illuminate\Support\Str;
use App\Events\InvitationSend;
use App\Events\InvitationAccept;
use App\Mail\MembershipInvitation;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;

class InvitationFeatureTest extends TenantTestCase
{
    const CENTRAL_DATABASE_CONNECTION = 'pgsql_test';

    /** @test */
    public function can_send_invitation()
    {
        Mail::fake();

        $receiver = 'testmail@test.com';

        $this->postJson('api/invitation-send', [
            'email_to' => $receiver,
            'auditable' => true,
        ]);

        $this->assertDatabaseHas('invitations', [
            'email' => $receiver,
            'tenant_id' => tenant('id'),
        ], self::CENTRAL_DATABASE_CONNECTION);

        $this->assertDatabaseHas('audits', [
            'member' => auth()->user()->name,
            'area' => 'invitation',
            'action' => 'send',
            'before_value' => null,
            'after_value' => $receiver,
        ]);

        Mail::assertQueued(MembershipInvitation::class, function ($email) use ($receiver) {
            return $email->hasTo($receiver);
        });
    }

    /** @test */
    public function when_already_existing_user_accept_invitation_he_will_redirect_to_login_page_with_invited_email()
    {
        $user = User::factory()->create();

        $invitation = Invitation::factory()->create([
            'email' => $user->email,
            'tenant_id' => tenant('id'),
            'token' => Str::random(200),
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
    }

    /** @test */
    public function when_change_invitation_signature_process_will_abort()
    {
        $invitation = Invitation::factory()->create([
            'email' => 'newuser@test.com',
            'tenant_id' => tenant('id'),
            'token' => Str::random(200),
        ]);

        auth()->logout();

        $response = $this->get(route('invitation.accept', [
            'invitation_token' => $invitation->token,
            'signature' => Str::random(),
        ]));

        $response->assertStatus(403);
    }

    /** @test */
    public function when_non_existing_user_accept_invitation_he_will_redirect_to_register_with_invited_email()
    {
        $invitation = Invitation::factory()->create([
            'email' => 'newuser@test.com',
            'tenant_id' => tenant('id'),
            'token' => Str::random(200),
        ]);

        $invitationUrl = URL::signedRoute('invitation.accept', [
            'invitation_token' => $invitation->token,
        ]);

        $response = $this->get($invitationUrl);

        $response->assertViewIs('authentication.register')->assertViewHas('invitationData', [
            'email' => $invitation->email,
            'invitation_token' => $invitation->token,
        ]);

        $this->assertFalse(tenancy()->initialized);
        $this->assertNull(auth()->user());
    }

    /** @test */
    public function invited_existing_user_become_a_member_of_invited_organization_after_authenticated()
    {
        $user = User::factory()->create();

        $invitation = Invitation::factory()->create([
            'email' => $user->email,
            'tenant_id' => tenant('id'),
            'token' => Str::random(200),
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
        ], self::CENTRAL_DATABASE_CONNECTION);

        $this->assertDatabaseHas('audits', [
            'member' => auth()->user()->name,
            'area' => 'invitation',
            'action' => 'accept',
            'before_value' => null,
            'after_value' => $user->email,
        ]);

        $this->assertSoftDeleted($invitation);

        $this->assertDatabaseHas('members', [
            'global_id' => $user->id,
        ]);
    }

    /** @test */
    public function invited_non_existing_user_become_a_member_of_invited_organization_after_authenticated()
    {
        $user = User::factory()->make();

        $invitation = Invitation::factory()->create([
            'email' => 'newuser@test.com',
            'tenant_id' => tenant('id'),
            'token' => Str::random(200),
        ]);

        auth()->logout();
        tenancy()->end();

        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'invitation_token' => $invitation->token,
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('tenant_user', [
            'tenant_id' => $invitation->tenant_id,
            'user_id' => User::firstWhere('email', $user->email)->id,
        ], self::CENTRAL_DATABASE_CONNECTION);

        $this->assertDatabaseHas('audits', [
            'member' => $user->name,
            'area' => 'invitation',
            'action' => 'accept',
            'before_value' => null,
            'after_value' => $user->email,
        ]);

        $this->assertSoftDeleted($invitation);

        $this->assertDatabaseHas('members', [
            'global_id' => User::firstWhere('email', $user->email)->id,
        ]);
    }

    /** @test */
    public function system_will_notify_when_invitation_send_successfully()
    {
        Event::fake(InvitationSend::class);

        $this->postJson('api/invitation-send', [
            'email_to' => 'testmail@test.com',
        ]);

        Event::assertDispatched(InvitationSend::class, function ($event) {
            return [
                $event->invitation->email = 'testmail@test.com',
            ];
        });
    }

    /** @test */
    public function system_will_notify_when_invitation_accept_successfully()
    {
        Event::fake(InvitationAccept::class);

        $invitation = Invitation::factory()->create([
            'email' => 'newuser@test.com',
            'tenant_id' => tenant('id'),
            'token' => Str::random(200),
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
    }

    /** @test */
    public function cant_access_invitation_accept_without_invitation()
    {
        $invitationUrl = URL::signedRoute('invitation.accept', [
            'invitation_token' => Str::random(200),
        ]);

        $response = $this->get($invitationUrl);

        $response->assertStatus(401);
    }

    /** @test */
    public function cant_invite_member_who_is_already_a_member()
    {
        $user = User::factory()->create();

        Member::create([
            'global_id' => $user->id,
        ]);

        $response = $this->postJson('api/invitation-send', [
            'email_to' => $user->email,
            'auditable' => true,
        ]);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('invitations', [
            'email' => $user->email,
            'tenant_id' => tenant('id'),
        ], self::CENTRAL_DATABASE_CONNECTION);
    }

    /** @test */
    public function already_invited_user_will_recieved_same_invitation_again_when_someone_invited_again()
    {
        $this->withoutExceptionHandling();

        Event::fake(InvitationSend::class);

        $invitation = Invitation::factory()->create([
            'email' => 'testmail@test.com',
            'token' => Str::random(200),
        ]);

        $this->postJson('api/invitation-send', [
            'email_to' => 'testmail@test.com',
        ]);

        $this->assertDatabaseCount('invitations', 1, self::CENTRAL_DATABASE_CONNECTION);

        Event::assertDispatched(InvitationSend::class, function ($event) {
            return [
                $event->invitation->email = 'testmail@test.com',
            ];
        });
    }
}
