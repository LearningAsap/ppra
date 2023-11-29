<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SignupMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user_registration')
            ->with(['user' => $this->user])
            ->subject('Welcome to Our Application');
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Signup Mail',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.user_registration',
        );
    }

    public function attachments()
    {
        return [];
    }
}
