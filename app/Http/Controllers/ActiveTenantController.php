<?php

namespace App\Http\Controllers;

use function tenancy;
use function response;
use Illuminate\Http\JsonResponse;

class ActiveTenantController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(tenancy());
    }
}
