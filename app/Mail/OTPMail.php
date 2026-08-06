<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;
    public $otp;
    public $purpose;

    public function __construct($otp, $purpose)
    {
        $this->otp = $otp;
        $this->purpose = $purpose;
    }


    public function envelope(): Envelope
    {
        $subject = ($this->purpose === 'register') ? 'Account Verification' : 'Password Reset';

        return new Envelope(
            subject: $subject . ' Code - Bhaiya Housing',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'frontend.auth.otp',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
