<?php

namespace App\Http\Controllers;

use function session;
use function tenancy;
use App\Models\Tenant;
use function response;

class TenantInitializeController extends Controller
{
    public function __invoke(Tenant $tenant)
    {
        tenancy()->initialize($tenant);

        session(['tenant_id' => $tenant->id]);

        return response()->json(tenancy());
    }
}
