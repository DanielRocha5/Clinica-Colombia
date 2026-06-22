<?php

namespace App\Mail;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CitaCancelada extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Cita $cita,
        public User $user
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu cita no fue aceptada - Clínica Colombia',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.cita-cancelada',
        );
    }
}