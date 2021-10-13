<?php

namespace App\Http\Controllers;

use App\Models\ItemOrder;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class MailSystemController extends Controller
{
  // Summamy mail 
  function SummaryMail()
  {
    try {
      $data['message'] = 'This is mail summary';
      $to_name = Auth::user()->username;
      $to_email = Auth::user()->email;
      $email_sms_title = 'Daily Summary mail';
      MailNotification($data, $to_name, $to_email, $email_sms_title);
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
    } catch (Exception $e) {
      return redirect()->back();
    }
  }
}
