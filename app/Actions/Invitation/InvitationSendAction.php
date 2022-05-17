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
    protected string $receiver;

    public function __invoke(string $receiver): void
    {
        $this->receiver = $receiver;

        if ($this->existingUser() && $this->existingMember()) {
            return;
        }

        $invitation = $this->getReceiversInvitation();

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

    protected function existingUser(): ?User
    {
        return User::firstWhere('email', $this->receiver);
    }

    protected function existingMember(): bool
    {
        return Member::firstWhere('global_id', $this->existingUser()->id)->exists();
    }

    protected function getReceiversInvitation(): Invitation
    {
        return $this->receiverAlreadyInvited() ?? $this->createNewInvitation();
    }

    protected function receiverAlreadyInvited(): ?Invitation
    {
        return Invitation::where('email', $this->receiver)->where('tenant_id', tenant('id'))->first();
    }

    protected function createNewInvitation(): Invitation
    {
        return Invitation::create([
            'email' => $this->receiver,
            'tenant_id' => tenant('id'),
            'token' => Str::random(200),
        ]);
    }
}
