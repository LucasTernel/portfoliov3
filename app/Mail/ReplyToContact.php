<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address; // Important pour l'expéditeur
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyToContact extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $replyMessage;

    public function __construct($contact, $replyMessage)
    {
        $this->contact = $contact;
        $this->replyMessage = $replyMessage;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('contact@lucasternel.com', 'Lucas Ternel'),
            subject: 'Réponse à : ' . ($this->contact->subject ?? 'Votre demande'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_reply',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}