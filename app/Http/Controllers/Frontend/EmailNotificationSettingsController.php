<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\EmailNotificationSettings;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;

class EmailNotificationSettingsController extends Controller
{

    public function store(Request $request)
    {

        try {
            $email_setting = new EmailNotificationSettings();
            $email_setting->rating = $request->rating;
            $email_setting->item_update = $request->item_update;
            $email_setting->item_comment = $request->item_comment;
            $email_setting->item_review = $request->item_review;
            $email_setting->buyer_review = $request->buyer_review;
            $email_setting->expiring_support = $request->expiring_support;
            $email_setting->daily_summary = $request->daily_summary;
            $email_setting->user_id = Auth::user()->id;
            // return $email_setting;
            $result = $email_setting->save();

            if ($result) {
                Toastr::success('Email notification setting Completed !', 'Success');
                if (Auth::user()->role_id == 4) {
                    return redirect()->route('author.setting', Auth::user()->id . '?email_setting');
                } else {
                    return redirect()->route('customer.setting', Auth::user()->username . '?email_setting');
                }
                // return redirect()->route('author.setting', Auth::user()->id.'?email_setting');
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            if (Auth::user()->role_id == 4) {
                return redirect()->route('author.setting', Auth::user()->id . '?email_setting');
            } else {
                return redirect()->route('customer.setting', Auth::user()->username . '?email_setting');
            }
        }
    }

    public function update(Request $request)
    {

        try {
            $email_setting = EmailNotificationSettings::find($request->id);
            $email_setting->rating = $request->rating;
            $email_setting->item_update = $request->item_update;
            $email_setting->item_comment = $request->item_comment;
            $email_setting->item_review = $request->item_review;
            $email_setting->buyer_review = $request->buyer_review;
            $email_setting->expiring_support = $request->expiring_support;
            $email_setting->daily_summary = $request->daily_summary;
            $email_setting->user_id = Auth::user()->id;
            // return $email_setting;
            $result = $email_setting->save();

            if ($result) {
                Toastr::success('Email notification setting Completed !', 'Success');
                if (Auth::user()->role_id == 4) {
                    return redirect()->route('author.setting', Auth::user()->id . '?email_setting');
                } else {
                    return redirect()->route('customer.setting', Auth::user()->username . '?email_setting');
                }
            }
        } catch (Exception $e) {

            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            if (Auth::user()->role_id == 4) {
                return redirect()->route('author.setting', Auth::user()->id . '?email_setting');
            } else {
                return redirect()->route('customer.setting', Auth::user()->username . '?email_setting');
            }
        }
    }
    public function Emailsent()
    {
        $data['message'] = 'test mail';
        $to_name = 'spn11';
        $to_email = 'spn11@spondonit.com';
        $email_sms_title = 'test mail';
        MailNotification($data, $to_name, $to_email, $email_sms_title);
        return 'done';
    }
}
