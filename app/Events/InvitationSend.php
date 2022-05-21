<?php

namespace App\Events;

use App\Models\Member;
use App\Models\Invitation;
use App\Interfaces\AuditableEvent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InvitationSend implements ShouldBroadcast, AuditableEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Invitation $invitation
    ) {
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('invitations'.tenant('id'));
    }

    public function broadcastAs(): string
    {
        return 'sent';
    }

    public function member(): string
    {
        return Member::id();
    }

    public function area(): string
    {
        return 'invitation';
    }

    public function action(): string
    {
        return 'send';
    }

    public function beforeValue(): ?string
    {
        return null;
    }

    public function afterValue(): ?string
    {
        return $this->invitation->email;
    }
}
