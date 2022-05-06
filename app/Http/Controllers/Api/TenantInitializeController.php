<?php

namespace App\Http\Controllers\Api;

use App\Models\Tenant;
use App\Http\Controllers\Controller;

class TenantInitializeController extends Controller
{
    public function __invoke(Tenant $tenant)
    {
        tenancy()->initialize($tenant);

        session(['tenant_id' => $tenant->id]);

        return response()->json(tenancy());
    }
}
