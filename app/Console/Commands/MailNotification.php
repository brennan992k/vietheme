<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ItemOrder;
use App\Models\EmailNotificationSettings;
use Carbon\Carbon;

class MailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily_summary:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily summary mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = EmailNotificationSettings::all();
        foreach ($email as $key => $value) {
            if (@$value->daily_summary == 1) {
                $data['message'] = 'this is mail summary';
                $to_name = @$value->user->username;
                $to_email = @$value->user->email;
                $email_sms_title = 'Daily Summary mail';
                MailNotification($data, $to_name, $to_email, $email_sms_title);
            }
            if (@$value->expiring_support == 1) {
                $item_order = ItemOrder::all();
                foreach ($item_order as $key => $value) {
                    $obj = json_decode($value->item, true);
                    if ($obj['support_time'] == 1) {
                        $deadline = Carbon::now()->subDays(180);
                        if ($value->created_at . eq($deadline)) {
                            $data['message'] = $item_order->Item->title . ' this product will expire at ';
                            $to_name = @$value->user->username;
                            $to_email = @$value->user->email;
                            $email_sms_title = 'Daily Summary mail';
                            MailNotification($data, $to_name, $to_email, $email_sms_title);
                        }
                    }
                    if ($obj['support_time'] == 2) {
                        $deadline = Carbon::now()->subDays(361);
                        if ($value->created_at . eq($deadline)) {
                            $data['message'] = $item_order->Item->title . ' this product will expire at ';
                            $to_name = @$value->user->username;
                            $to_email = @$value->user->email;
                            $email_sms_title = 'Daily Summary mail';
                            MailNotification($data, $to_name, $to_email, $email_sms_title);
                        }
                    }
                }
            }
        }
    }
}
