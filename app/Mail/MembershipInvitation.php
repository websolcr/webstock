<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MembershipInvitation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        protected string $organization,
        protected string $signedUrl,
    ) {
    }

    public function build(): self
    {
        return $this->subject('Invitation')
            ->markdown('emails.membership-invitation')
            ->with('organization', $this->organization)
            ->with('signedUrl', $this->signedUrl);
    }
}
