<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Domain\Invitation\Actions\InvitationSendAction;

class InvitationsController extends Controller
{
    public function store(InvitationSendAction $invitationSendAction): Response
    {
        request()->validate([
            'email_to' => 'required|email',
        ]);

        DB::transaction(fn () => $invitationSendAction->execute(request('email_to')));

        return response()->noContent();
    }
}
