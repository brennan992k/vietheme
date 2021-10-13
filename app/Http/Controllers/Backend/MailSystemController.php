<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use App\Models\SmEmailSmsLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Modules\Systemsetting\Entities\InfixEmailSetting;

class MailSystemController extends Controller
{
    public function sendEmailSmsView(Request $request)
    {
        try {
            $roles = Role::select('*')->where('id', '!=', 1)->where('id', '!=', 3)->get();
            return view('backend.communicate.sendEmailSms', compact('roles'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function studStaffByRole(Request $request)
    {
        try {
            $data  = User::where('role_id', $request->id)->latest()->get();
            return response()->json([$data]);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function sendEmailSms(Request $request)
    {
        // return $request;
        $request->validate([
            'email_sms_title' => "required",
            'send_through' => "required",
            'description' => "required",
        ]);
        try {
            if (empty($request->role) && empty($request->role_id)) {
                Toastr::error('Please select whom you want to send', 'Failed');
                return redirect()->back();
            }
            $saveEmailSmsLogData = new SmEmailSmsLog();
            $saveEmailSmsLogData->saveEmailSmsLogData($request);
            if ($request->send_through == 'E' && $request->role) {
                $email_sms_title = $request->email_sms_title;
                $description = $request->description;
                // $message_to = implode(',', $request->role);
                $to_name = '';
                $to_email = [];
                $to_mobile = [];
                $receiverDetails = '';
                foreach ($request->role as $role_id) {
                    $receiverDetails = User::select('email', 'full_name')->where('role_id', $role_id)->where('access_status', 1)->get();
                    foreach ($receiverDetails as $receiverDetail) {
                        $to_name    = $receiverDetail->full_name;
                        $to_email[]   = $receiverDetail->email;



                        try {
                            // Mail::to($receiverDetail->email)->send(new PromotionalMail($email_sms_title,$description,$receiverDetail)); 

                            $settings = InfixEmailSetting::first();
                            $reciver_email = $receiverDetail->email;
                            $receiver_name =  $receiverDetail->full_name;
                            $subject = $email_sms_title;
                            $view = "mail.promotional_email";
                            $compact['data'] =  array(
                                'email_sms_title' => $email_sms_title, 'receiverDetail' => $receiverDetail,
                                'description' => $description
                            );
                            @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);
                        } catch (Exception $e) {
                            $msg = $e->getMessage();
                            Log::info($msg);
                            Toastr::error($msg, 'Failed');
                        }
                    }
                }
                // $data = array('name' => $to_name, 'email_sms_title' => $request->email_sms_title, 'description' => $request->description);
                // $flag = $this->sendEmailFromComunicate($data, $to_name, $to_email, $email_sms_title);
                // $flag = MailNotification($data, $to_name, $to_email, $email_sms_title);  
                // if (!$flag) {
                //     Toastr::error('Operation Failed lolz' . $flag[1], 'Failed');
                //     return redirect()->back();
                // } else {
                //     Toastr::success('Operation successful', 'Success');
                //     return redirect()->back();
                // }

                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                $email_sms_title = $request->email_sms_title;
                $description = $request->description;
                // $message_to = implode(',', $request->role);
                $to_name = '';
                $to_email = [];
                $to_mobile = [];
                $receiverDetails = '';
                foreach ($request->message_to_individual as $email) {
                    $receiverDetail = User::select('email', 'full_name')->where(['role_id' => $request->role_id, 'email' => $email])->where('access_status', 1)->first();
                    $to_name    = $receiverDetail->full_name;
                    $to_email[]   = $receiverDetail->email;
                }
                $data = array('name' => $to_name, 'email_sms_title' => $request->email_sms_title, 'description' => $request->description);
                $flag = MailNotification($data, $to_name, $to_email, $email_sms_title);
                if (!$flag) {
                    Toastr::error('Operation Failed lolz' . $flag[1], 'Failed');
                    return redirect()->back();
                } else {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                }
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
