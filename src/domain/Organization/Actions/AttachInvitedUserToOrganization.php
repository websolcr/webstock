<?php

namespace Domain\Organization\Actions;

use Exception;
use function app;
use function auth;

class AttachInvitedUserToOrganization
{
    /**
     * @throws Exception
     */
    public function handle($request, $next)
    {
        if ($request->has('invitation_token')) {
            app(AttachInvitedUserToOrganizationAction::class)
                ->handle($request->invitation_token, auth()->user());
        }

        return $next($request);
    }
}
