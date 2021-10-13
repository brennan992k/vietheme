<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    protected $to_email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $to_email)
    {
        $this->data = $data;
        $this->to_email = $to_email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reciver_email = $this->to_email;
        $receiver_name =  $this->data['to_name'];
        $subject = $this->data['email_sms_title'];
        $view = "mail.mail";
        $compact['data'] =  $this->data;
        @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);
    }
}
