<?php

namespace App\Actions\Tenant;

use App\Models\User;
use App\Models\Member;
use App\Models\Invitation;
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
            'name' => $user->name,
            'email' => $user->email,
            'role' => 'role',
            'invited_by' => Member::firstWhere('global_id', $invitation->sender_id)->id,
        ]);

        event(new InvitationAccept($invitation, $user));

        $invitation->delete();
    }
}
