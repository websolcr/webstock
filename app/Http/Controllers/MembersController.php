<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\JsonResponse;

class MembersController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Member::all());
    }
}
