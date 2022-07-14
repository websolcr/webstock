<?php

namespace Domain\Invitation\Events;

use App\Models\User;
use Support\Audit\AuditArea;
use Support\Audit\AuditAction;
use Domain\Member\Models\Member;
use Illuminate\Queue\SerializesModels;
use Domain\Invitation\Models\Invitation;
use Domain\Audit\Interfaces\AuditableEvent;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InvitationAccept implements ShouldBroadcast, AuditableEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Invitation $invitation,
        public User $user,
    ) {
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('invitations'.tenant('id'));
    }

    public function broadcastAs(): string
    {
        return 'accept';
    }

    public function member(): string
    {
        return Member::where('global_id', $this->user->id)->first()->id;
    }

    public function area(): AuditArea
    {
        return AuditArea::INVITATION;
    }

    public function action(): AuditAction
    {
        return AuditAction::ACCEPT;
    }

    public function beforeValue(): ?string
    {
        return null;
    }

    public function afterValue(): ?string
    {
        return $this->user->email;
    }
}
