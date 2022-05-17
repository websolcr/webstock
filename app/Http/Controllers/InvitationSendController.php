<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Actions\Invitation\InvitationSendAction;

class InvitationSendController extends Controller
{
    public function __invoke(InvitationSendAction $invitationSendAction)
    {
        request()->validate([
            'email_to' => 'required|email',
        ]);

        DB::transaction(fn () => $invitationSendAction(request('email_to')));

        return response()->noContent();
    }
}
