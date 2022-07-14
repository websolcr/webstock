<?php

namespace Domain\Invitation\Events;

use function tenant;
use Support\Audit\AuditArea;
use Support\Audit\AuditAction;
use Illuminate\Queue\SerializesModels;
use Domain\Invitation\Models\Invitation;
use Domain\Audit\Interfaces\AuditableEvent;
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
        return authMember()->id;
    }

    public function area(): AuditArea
    {
        return AuditArea::INVITATION;
    }

    public function action(): AuditAction
    {
        return AuditAction::SEND;
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
