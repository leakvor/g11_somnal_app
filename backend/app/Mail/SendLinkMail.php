<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendLinkMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Send Link')
                    ->view('emails.sendCode')
                    ->with([
                        'token' => $this->token,
                    ]);
    }
}