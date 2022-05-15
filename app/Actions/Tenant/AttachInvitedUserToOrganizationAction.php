<?php

namespace App\Actions\Tenant;

use App\Models\User;
use App\Models\Invitation;
use App\Models\Domain\Member;
use App\Events\InvitationAccept;

class AttachInvitedUserToOrganizationAction
{
    public function handle(string $invitationToken, User $user): void
    {
        $invitation = Invitation::firstWhere('token', $invitationToken);

        $user->organizations()->attach($invitation->tenant_id);

        tenancy()->initialize($invitation->tenant_id);

        Member::create([
            'global_id' => $user->id,
        ]);

        event(new InvitationAccept($invitation, $user));

        $invitation->delete();
    }
}
