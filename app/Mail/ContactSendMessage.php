<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactSendMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user_send_message')
            ->with(['data' => $this->data])
            ->subject($this->data['subject']);
    }

    public function envelope()
    {
        return new Envelope(
            subject: $this->data['subject'],
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.user_send_message',
        );
    }

    public function attachments()
    {
        return [];
    }
}
