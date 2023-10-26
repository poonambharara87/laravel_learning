<?php

namespace App\Mail;
use App\Http\Controllers\AdminController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailVerification extends Mailable
{
    use Queueable, SerializesModels;
    public $user_mail;
    public $user_name;
    public $valid_token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_mail, $user_name, $valid_token)
    {
        $this->user_mail = $user_mail;
        $this->$user_name =  $user_name;
        $this->valid_token = $valid_token;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Mail Verification',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.getOtp',
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
