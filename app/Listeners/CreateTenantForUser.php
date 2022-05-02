<?php

namespace App\Listeners;

use App\Models\Organization;
use Illuminate\Auth\Events\Registered;

class CreateTenantForUser
{
    public function __construct()
    {
        //
    }

    public function handle(Registered $event)
    {
        $organization = Organization::create();

        $event->user()->organization()->attach($organization);
    }
}
