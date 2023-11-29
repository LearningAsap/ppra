<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DpisPublished extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public $procurement;

    public function __construct($data, $procurement)
    {
        $this->data = $data;
        $this->procurement = $procurement;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->procurement['status'] == 0 ? 'Procurement Publish Request Rejected' : ($this->procurement['status'] == 1 ? 'Procurement Published Success' : ($this->procurement['status'] == 2 ? 'Procurement Publish Request is in Objection' : 'Procurement Is Waiting For Approval')),
        );
    }

    public function build()
    {
        switch ($this->procurement['status']) {
            case 0:
                return $this->view('emails.DpisRejected')
                    ->with('data', $this->data->toArray())
                    ->with('procurement', $this->procurement);
                break;
            case 1:
                return $this->view('emails.DpisPublished')
                    ->with('data', $this->data->toArray())
                    ->with('procurement', $this->procurement);
                break;
            case 2:
                return $this->view('emails.DpisObjection')
                    ->with('data', $this->data->toArray())
                    ->with('procurement', $this->procurement);
                break;
            default:
                return $this->view('emails.DpisWaitingApproval')
                    ->with('data', $this->data->toArray())
                    ->with('procurement', $this->procurement);
                break;
        }
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: $this->procurement['status'] == 0 ? 'emails.DpisRejected' : ($this->procurement['status'] == 1 ? 'emails.DpisPublished' : ($this->procurement['status'] == 2 ? 'emails.DpisObjection' : 'emails.DpisWaitingApproval'))
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
