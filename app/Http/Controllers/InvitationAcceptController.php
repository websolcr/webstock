<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class InvitationAcceptController extends Controller
{
    public function __invoke(Request $request): View
    {
        if (! $request->hasValidSignature()) {
            abort(403);
        }

        $invitation = Invitation::firstWhere('token', $request->get('invitation_token'));

        $invitationData = [
            'email' => $invitation->email,
            'tenant_id' => $invitation->tenant_id,
        ];

        $user = User::firstWhere('email', $invitationData['email']);

        $user ? $view = 'authentication.login' : $view = 'authentication.register';

        return view($view)->with('invitationData', $invitationData);
    }
}
