<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ActiveTenantController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(tenancy());
    }
}
