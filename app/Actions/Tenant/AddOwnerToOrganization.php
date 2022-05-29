<?php

namespace App\Actions\Tenant;

use App\Models\Member;

class AddOwnerToOrganization
{
    public function handle()
    {
        Member::create([
            'global_id' => auth()->id(),
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'role' => 'admin',
        ]);
    }
}
