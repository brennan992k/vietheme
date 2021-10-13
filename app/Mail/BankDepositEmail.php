<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BankDepositEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $fund_info, $receiver_info;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fund_info,$receiver_info)
    {
        $this->fund_info = $fund_info;
        $this->receiver_info = $receiver_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bank Deposit Approved')
                    ->from(env('MAIL_USERNAME'))
                    ->view('mail.bank_deposit_mail');
    }
}
