<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{name: string, email: string, subject: ?string, message: string}  $contact
     */
    public function __construct(public array $contact) {}

    public function envelope(): Envelope
    {
        $subject = filled($this->contact['subject'] ?? null)
            ? (string) $this->contact['subject']
            : 'Neue Kontaktanfrage';

        return new Envelope(
            subject: '[Kontakt] '.$subject,
            replyTo: [
                new Address($this->contact['email'], $this->contact['name']),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-admin',
        );
    }
}
