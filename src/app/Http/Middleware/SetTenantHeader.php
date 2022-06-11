<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetTenantHeader
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (
            ! $request->header('X-Tenant')
            && $request->session()->exists('tenant_id')
        ) {
            $request->headers->set('X-Tenant', $request->session()->get('tenant_id'));
        }

        return $next($request);
    }
}
