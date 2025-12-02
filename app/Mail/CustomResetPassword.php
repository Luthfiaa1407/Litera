<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public $resetUrl;

    public $userName;

    public function __construct($otp, $resetUrl, $userName)
    {
        $this->otp = $otp;
        $this->resetUrl = $resetUrl;
        $this->userName = $userName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password & OTP Verification'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.otp_reset',
            with: [
                'otp' => $this->otp,
                'resetUrl' => $this->resetUrl,
                'userName' => $this->userName,
            ]
        );
    }
}
