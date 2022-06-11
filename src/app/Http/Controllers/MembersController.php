<?php

namespace App\Http\Controllers;

use Domain\Member\Models\Member;
use Illuminate\Http\JsonResponse;

class MembersController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Member::with('invitedBy')->get()
        );
    }
}
