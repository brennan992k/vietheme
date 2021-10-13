<?php

namespace Modules\MailSystem\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Modules\MailSystem\Entities\EmailTemplate;

class MailSystemController extends Controller
{
    public function index()
    {
        try {
            return view('mailsystem::mail_template');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function create()
    {
        try {
            $data = EmailTemplate::first();
            return view('mailsystem::mail_template', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required',
            'registration' => 'required',
            'product_purchase' => 'required',
            'mail_verify' => 'required',
            'product_refund' => 'required',
            'product_update' => 'required',
            'user_suspend' => 'required',
            'product_comment' => 'required',
            'product_review_by_buyer' => 'required',
            'product_expiring_support' => 'required'
        ]);
        try {
            EmailTemplate::find($id)->update($request->all());
            Toastr::success('Operation success!', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error('Something went wrong ! try again ', 'Error');
            return redirect()->back();
        }
    }
}
