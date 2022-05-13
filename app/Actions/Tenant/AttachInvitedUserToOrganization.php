<?php

namespace App\Actions\Tenant;

use App\Models\Invitation;
use App\Models\Domain\Member;

class AttachInvitedUserToOrganization
{
    public function handle($request, $next)
    {
        if (! $request->has('invitation_token')) {
            return $next($request);
        }

        $invitation = Invitation::firstWhere('token', $request->invitation_token);

        auth()->user()->organizations()->attach($invitation->tenant_id);

        tenancy()->initialize($invitation->tenant_id);

        Member::create([
            'global_id' => auth()->id(),
        ]);

        $invitation->delete();

        return $next($request);
    }
}
