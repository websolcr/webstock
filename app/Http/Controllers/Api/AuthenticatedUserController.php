<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class AuthenticatedUserController extends Controller
{
    public function show(): JsonResponse
    {
        return response()->json(auth()->user());
    }
}
