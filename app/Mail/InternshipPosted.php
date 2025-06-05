<?php

namespace App\Mail;

use App\Models\Internship;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class InternshipPosted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Internship $internship)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Internship Posted',
            from: 'admin@example.com'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.internship-posted',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
