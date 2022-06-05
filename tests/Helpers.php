<?php

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Str;

function actingAsSuperAdmin(): User
{
    $user = User::factory()->create();

    test()->actingAs($user);

    return $user;
}

function beginTestInsideTenant(): Tenant
{
    actingAsSuperAdmin();

    $tenant = Tenant::create([
        'user_id' => auth()->id(),
        'name' => Str::random(),
    ]);

    tenancy()->initialize($tenant);
    session(['tenant_id' => $tenant->id]);

    return $tenant;
}

function endTestInsideTenant()
{
    tenancy()->end();
    session()->forget('tenant_id');
}
