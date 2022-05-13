<?php

namespace App\Actions\Invitation;

use App\Models\Invitation;
use Illuminate\Support\Str;
use App\Mail\MembershipInvitation;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class InvitationSendAction
{
    public function __invoke(string $receiver)
    {
        $invitation = Invitation::create([
            'email' => $receiver,
            'tenant_id' => tenant('id'),
            'token' => Str::random(200),
        ]);

        $url = URL::signedRoute('invitation.accept', [
            'invitation_token' => $invitation->remember_token,
        ]);

        Mail::to($invitation->email)
            ->send(new MembershipInvitation(
                organization: tenant('name'),
                signedUrl: $url
            ));
    }
}
