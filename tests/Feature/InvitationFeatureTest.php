<?php

namespace Tests\Feature;

use Tests\TenantTestCase;
use App\Mail\MembershipInvitation;
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

        Mail::assertQueued(MembershipInvitation::class, function ($email) use ($receiver) {
            return $email->hasTo($receiver);
        });
    }
}
