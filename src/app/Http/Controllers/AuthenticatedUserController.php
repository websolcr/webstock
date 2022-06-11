<?php

namespace App\Http\Controllers;

use function auth;
use function response;
use Illuminate\Http\JsonResponse;

class AuthenticatedUserController extends Controller
{
    public function show(): JsonResponse
    {
        return response()->json(auth()->user());
    }
}
