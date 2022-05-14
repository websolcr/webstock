<?php

namespace App\Actions\Tenant;

use Exception;

class AttachInvitedUserToOrganization
{
    /**
     * @throws Exception
     */
    public function handle($request, $next)
    {
        if (! $request->has('invitation_token')) {
            return $next($request);
        }

        app(AttachInvitedUserToOrganizationAction::class)
            ->handle($request->invitation_token, auth()->user());

        return $next($request);
    }
}
