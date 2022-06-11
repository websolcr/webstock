<?php

namespace Domain\Organization\Actions;

use function auth;
use Domain\Member\Models\Member;

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
