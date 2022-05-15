<?php

namespace App\Events;

use App\Models\Invitation;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InvitationSend implements ShouldBroadcast
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
}
