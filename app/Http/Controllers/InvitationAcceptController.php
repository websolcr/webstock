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

        if (auth()->user()) {
            tenancy()->end();
            auth()->logout();

            //todo: send response to frontend for clear browser local storage
        }

        $invitation = Invitation::firstWhere('token', $request->get('invitation_token'));

        if (! $invitation) {
            abort(401);
        }

        $invitationData = [
            'email' => $invitation->email,
            'invitation_token' => $invitation->token,
        ];

        $user = User::firstWhere('email', $invitationData['email']);

        $user ? $view = 'authentication.login' : $view = 'authentication.register';

        return view($view)->with('invitationData', $invitationData);
    }
}
