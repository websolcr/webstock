<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;

class SetTenantInSession
{
    public function __construct()
    {
        //
    }

    public function handle(Authenticated $event): void
    {

    }
}
