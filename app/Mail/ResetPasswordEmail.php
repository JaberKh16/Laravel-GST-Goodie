<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $status = null;


    /**
     * Create a new message instance.
     */
    public function __construct($status)
    {
        $this->status = $status;
    }


    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Reset Password Email',
    //     );
    // }

  
    // public function content(): Content
    // {
    //     return new Content(
    //         markdown: 'emails.reset-password',
    //     );
    // }

    public function build()
    {
        return $this->subject('Reset Password Email')
                    ->markdown('emails.reset-password')
                    ->with('status', $this->status);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
