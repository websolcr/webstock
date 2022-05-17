<?php

namespace App\Actions\Invitation;

use App\Models\User;
use App\Models\Member;
use App\Models\Invitation;
use Illuminate\Support\Str;
use App\Events\InvitationSend;
use App\Mail\MembershipInvitation;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class InvitationSendAction
{
    public function __invoke(string $receiver): void
    {
        if ($this->existingUser($receiver) && $this->existingMember($receiver)) {
            return;
        }

        $invitation = $this->getReceiversInvitation($receiver);

        $url = URL::signedRoute('invitation.accept', [
            'invitation_token' => $invitation->token,
        ]);

        Mail::to($invitation->email)
            ->send(new MembershipInvitation(
                organization: tenant('name'),
                signedUrl: $url
            ));

        event(new InvitationSend($invitation));
    }

    protected function existingUser(string $receiver): ?User
    {
        return User::firstWhere('email', $receiver);
    }

    protected function existingMember(string $receiver): bool
    {
        return Member::firstWhere('global_id', $this->existingUser($receiver)->id)->exists();
    }

    protected function getReceiversInvitation(string $receiver): Invitation
    {
        return $this->receiverAlreadyInvited($receiver) ?? $this->createNewInvitation($receiver);
    }

    protected function receiverAlreadyInvited(string $receiver): ?Invitation
    {
        return Invitation::where('email', $receiver)->where('tenant_id', tenant('id'))->first();
    }

    protected function createNewInvitation(string $receiver): Invitation
    {
        return Invitation::create([
            'email' => $receiver,
            'tenant_id' => tenant('id'),
            'token' => Str::random(200),
        ]);
    }
}
