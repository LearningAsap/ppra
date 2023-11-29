<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailIsCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $procurement;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $procurement)
    {
        $this->user = $user;
        $this->procurement = $procurement;
    }

    public function build()
    {
        return $this->view('emails.user_published_doc')

        ->with(['user' => $this->user])
        ->with(['procurement' => $this->procurement]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New Department Procurement Document Posted',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.user_published_doc',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
