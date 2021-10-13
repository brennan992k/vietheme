<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromotionalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title, $description, $receiverDetail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$description,$receiverDetail)
    {
        $this->title = $title;
        $this->description = $description;
        $this->receiverDetail = $receiverDetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Promotional Email')
            ->from(env('MAIL_USERNAME'))
            ->view('mail.promotional_email');
    }
}