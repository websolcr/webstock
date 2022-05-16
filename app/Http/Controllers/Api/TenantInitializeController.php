<?php

namespace App\Http\Controllers\Api;

use App\Events\SwitchTenant;
use App\Models\Tenant;
use App\Http\Controllers\Controller;

class TenantInitializeController extends Controller
{
    public function __invoke(Tenant $tenant)
    {
        if (
            ! request()->header('X-Tenant')
            && request()->session()->exists('tenant_id')
            && Tenant::find(request()->session()->get('tenant_id'))
        ) {
            event(new SwitchTenant());
        }

        tenancy()->initialize($tenant);

        session(['tenant_id' => $tenant->id]);

        return response()->json(tenancy());
    }
}
