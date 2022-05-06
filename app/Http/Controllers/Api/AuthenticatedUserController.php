<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class AuthenticatedUserController extends Controller
{
    public function show(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function activeTenant(): JsonResponse
    {
        return response()->json(tenant());
    }

    public function createOrganization(Request $request)
    {
        //todo create tenant
    }
}
