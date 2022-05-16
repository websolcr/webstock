<?php

namespace App\Events;

use App\Models\Tenant;
use App\Interfaces\AuditableEvent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class SwitchTenant implements AuditableEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct()
    {
        tenancy()->initialize(Tenant::find(request()->session()->get('tenant_id')));
    }

    public function member(): string
    {
        return auth()->user()->name;
    }

    public function area(): string
    {
        return 'organization';
    }

    public function action(): string
    {
        return 'switch';
    }

    public function beforeValue(): ?string
    {
        return tenant('name');
    }

    public function afterValue(): ?string
    {
        return 'classified';
    }
}
