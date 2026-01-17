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

    /* * 1. L'ENVELOPPE (Sujet + Expéditeur)
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // Ici on définit l'expéditeur et le sujet dynamique
            from: new Address('contact@lucasternel.com', 'Lucas Ternel'),
            subject: 'Réponse à : ' . ($this->contact->subject ?? 'Votre demande'),
        );
    }

    /* * 2. LE CONTENU (On pointe vers ta vue HTML personnalisée)
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_reply', // C'est le fichier qu'on va créer juste après
        );
    }

    public function attachments(): array
    {
        return [];
    }
}