<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Application $application, public string $listingTitle)
    {
    }

    public function envelope(): Envelope
    {
        $subject = match($this->application->status) {
            'accepted' => 'Congratulations! Your application has been accepted',
            'rejected' => 'Update on your application',
            default    => 'Your application status has been updated',
        };

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(view: 'mail.application-status-changed');
    }

    public function attachments(): array
    {
        return [];
    }
}
