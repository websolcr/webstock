<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TenantTestCase;
use App\Models\Invitation;
use Illuminate\Support\Str;
use App\Mail\MembershipInvitation;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class InvitationFeatureTest extends TenantTestCase
{
    /** @test */
    public function can_send_invitation()
    {
        Mail::fake();

        $receiver = 'testmail@test.com';

        $this->postJson('api/invitation-send', [
            'email_to' => $receiver,
        ]);

        $this->assertDatabaseHas('invitations', [
            'email' => $receiver,
            'tenant_id' => tenant('id'),
        ], config('tenancy.database.central_connection'));

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
    public function when_already_non_existing_user_accept_invitation_he_will_redirect_to_login_register_with_invited_email()
    {
        $invitation = Invitation::factory()->create([
            'email' => 'newuser@test.com',
            'tenant_id' => tenant('id'),
            'token' => Str::random(200),
        ]);

        $invitationUrl = URL::signedRoute('invitation.accept', [
            'invitation_token' => $invitation->token,
        ]);

        auth()->logout();

        $response = $this->get($invitationUrl);

        $response->assertViewIs('authentication.register')->assertViewHas('invitationData', [
            'email' => $invitation->email,
            'invitation_token' => $invitation->token,
        ]);
    }

    /** @test */
    public function invited_existing_user_become_a_member_of_invited_organization_after_authenticated()
    {
        $user = User::factory()->create();

        $invitation = Invitation::factory()->create([
            'email' => 'newuser@test.com',
            'tenant_id' => tenant('id'),
            'token' => Str::random(200),
        ]);

        auth()->logout();
        tenancy()->end();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            'invitation_token' => $invitation->token,
        ]);

        $response->assertStatus(302);

        $this->assertEquals(auth()->id(), $user->id);

        $this->assertDatabaseHas('tenant_user', [
            'tenant_id' => $invitation->tenant_id,
            'user_id' => $user->id,
        ], config('tenancy.database.central_connection'));

        $this->assertSoftDeleted($invitation);

        $this->assertDatabaseHas('members', [
            'global_id' => $user->id,
        ]);
    }
}
