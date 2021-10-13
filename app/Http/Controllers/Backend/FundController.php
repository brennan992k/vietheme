<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Balance;
use App\Models\Deposit;
use App\Models\ErrorLog;
use App\Models\BankDeposit;
use App\Models\SmNotification;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\Systemsetting\Entities\InfixEmailSetting;
use Throwable;

class FundController extends Controller
{
    public function addFund()
    {

        try {
            $author = User::where('role_id', 4)->join('balances', 'balances.user_id', '=', 'users.id')
                ->select('users.*', 'balances.amount', 'balances.updated_at as balances_updated_at')
                ->get();
            // return $author;
            $customer = User::where('role_id', 5)->join('balances', 'balances.user_id', '=', 'users.id')
                ->select('users.*', 'balances.amount', 'balances.updated_at as balances_updated_at')
                ->get();
            return view('backend.fund.add_fund', compact('author', 'customer'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function addFundStore(Request $request)
    {

        $amount = $request->input('fund_amount');

        if (!is_numeric($request->input('fund_amount')) && $amount > 0) {
            Toastr::warning('Fund amount should be numeric or greater than 0', 'Invalid');
            return redirect()->back();
        }
        try {

            $from_currency = 'USD';
            $to_currency = GeneralSetting()->currency;
            // $amount = convertCurrency($from_currency,$to_currency,$request->fund_amount);

            $deposit = new Deposit();
            $deposit->user_id = $request->user_id;
            $deposit->title = 'deposit';
            $deposit->details = 'Fund deposit by Superadmin';
            $deposit->amount = floatval($amount);
            $deposit->save();

            $balnc  = Balance::where('user_id', $request->user_id)->first();
            $balnc->amount = $balnc->amount + $amount;
            $balnc->save();

            $fund_info = Deposit::where('id', $deposit->id)->first();
            $receiver_info = User::find($request->user_id);

            Toastr::success('Fund added Succsesfully', 'Success');

            try {
                // Mail::to($receiver_info->email)->send(new FundMail($fund_info,$receiver_info));
                // Toastr::success('Fund added Succsesfully', 'Success');
                // return redirect()->back();

                $settings = InfixEmailSetting::first();
                $reciver_email = $receiver_info->email;
                $receiver_name =  $receiver_info->full_name;
                $subject = 'Fund Deposit';
                $view = "mail.add_fund_mail";
                $compact['data'] =  array('fund_info' => $fund_info, 'receiver_info' => $receiver_info);
                // return $compact;
                @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);
            } catch (Exception $e) {
                $msg = $e->getMessage();
                Log::info($msg);
                Toastr::error('Mail not send.Please check email setting', 'Failed');
            }
            return redirect()->back();
            // return $data['receiver_name'];


        } catch (Throwable $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function addFundUpdate(Request $request)
    {

        if (!is_numeric($request->input('fund_amount'))) {
            Toastr::warning('Fund amount should be numeric', 'Invalid');
            return redirect()->back();
        }
        try {


            $from_currency = 'USD';
            $to_currency = GeneralSetting()->currency;
            $amount = convertCurrency($from_currency, $to_currency, $request->fund_amount);

            $deposit = Deposit::find($request->fund_id);
            $current_amount = $deposit->amount;
            $deposit->amount = floatval($amount);
            $deposit->save();

            $balnc  = Balance::where('user_id', $deposit->user_id)->first();
            $balnc->amount = $balnc->amount + floatval($amount) - floatval($current_amount);
            $balnc->save();


            $fund_info = Deposit::where('id', $deposit->id)->first();
            $receiver_info = User::find($deposit->user_id);



            try {
                // Mail::to($receiver_info->email)->send(new FundMail($fund_info,$receiver_info));


                $settings = InfixEmailSetting::first();
                $reciver_email = $receiver_info->email;
                $receiver_name =  $receiver_info->full_name;
                $subject = 'Fund Deposit';
                $view = "mail.add_fund_mail";
                $compact['data'] =  array('fund_info' => $fund_info, 'receiver_info' => $receiver_info);
                // return $compact;
                @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);
            } catch (Exception $e) {
                $msg = $e->getMessage();
                Log::info($msg);
                Toastr::error('Mail not send.Please check email setting', 'Failed');
            }

            Toastr::success('Fund Updated Succsesfully', 'Success');
            return redirect()->back();
        } catch (Throwable $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function fundHistory($id)
    {


        try {
            $funds = Deposit::where('user_id', $id)->get();
            $user_info = User::find($id);
            // return $funds;
            return view('backend.fund.funding_history', compact('funds', 'user_info'));
        } catch (Throwable $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function fundList()
    {


        try {
            $funds = Deposit::leftjoin('users', 'users.id', '=', 'deposits.user_id')
                ->select('deposits.*', 'users.full_name')
                ->get();

            // return $funds;
            return view('backend.fund.fund_list', compact('funds'));
        } catch (Throwable $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function fundrDeleted($id)
    {
        DB::beginTransaction();
        try {
            $fund = Deposit::find($id);
            $fund->delete();

            $balnc  = Balance::where('user_id', $fund->user_id)->first();
            $balnc->amount = $balnc->amount - floatval($fund->amount);
            $balnc->save();
            DB::commit();
            Toastr::success('Fund Deleted Succsesfully', 'Success');
            return redirect()->back();
        } catch (Throwable $e) {
            DB::rollback();
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function depositDelete($id)
    {
        DB::beginTransaction();
        try {
            $fund = BankDeposit::find($id);
            $fund->delete();


            DB::commit();
            Toastr::success('Deposit request Deleted Succsesfully', 'Success');
            return redirect()->back();
        } catch (Throwable $e) {
            DB::rollback();
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function depositRequest()
    {

        try {
            $bank_deposits = BankDeposit::leftjoin('users', 'users.id', '=', 'bank_deposits.depositor_id')
                ->select('bank_deposits.*', 'users.full_name')
                ->where('bank_deposits.status', 0)
                ->get();

            // return $bank_deposits;
            return view('backend.fund.bank_deposit', compact('bank_deposits'));
        } catch (Throwable $e) {

            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function depositRequestNoti($id)
    {

        try {
            $bank_deposit_noti = SmNotification::where('ticket_id', $id)->first();
            $bank_deposit_noti->is_read = 1;
            $bank_deposit_noti->save();

            return redirect()->route('admin.depositRequest');
        } catch (Throwable $e) {

            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function MarkAllNoti()
    {

        try {
            $all_noti = SmNotification::where('received_id', Auth::user()->id)->get();
            foreach ($all_noti as $key => $value) {
                $noti = SmNotification::where('id', $value->id)->first();
                $noti->is_read = 1;
                $noti->save();
            }
            return redirect()->route('admin.depositRequest');
        } catch (Throwable $e) {

            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function depositApproved()
    {

        try {
            $approved_deposits = BankDeposit::leftjoin('users', 'users.id', '=', 'bank_deposits.depositor_id')
                ->select('bank_deposits.*', 'users.full_name')
                ->where('bank_deposits.status', 1)
                ->get();

            // return $bank_deposits;
            return view('backend.fund.approved_deposit', compact('approved_deposits'));
        } catch (Throwable $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function approveDeposit($id)
    {


        // DB::beginTransaction();

        try {

            $deposit_request = BankDeposit::where('bank_deposits.id', $id)
                ->leftjoin('users', 'users.id', '=', 'bank_deposits.depositor_id')
                ->select('bank_deposits.*', 'users.full_name')
                ->first();
            $deposit_request->status = 1;
            $deposit_request->save();

            $deposit = new Deposit();
            $deposit->user_id = $deposit_request->depositor_id;
            $deposit->title = 'bank deposit';
            $deposit->details = 'Bank diposit';
            $deposit->amount = floatval($deposit_request->amount);
            $deposit->save();

            $balnc  = Balance::where('user_id', $deposit_request->depositor_id)->first();
            $balnc->amount = $balnc->amount + floatval($deposit_request->amount);
            $balnc->save();



            $fund_info = Deposit::where('id', $deposit->id)->first();
            $receiver_info = User::find($deposit_request->depositor_id);
            $receiver_email = $receiver_info->email;


            try {
                // Mail::to($receiver_email)->send(new BankDepositEmail($fund_info,$receiver_info));

                $settings = InfixEmailSetting::first();
                $reciver_email = $receiver_info->email;
                $receiver_name =  $receiver_info->full_name;
                $subject = 'Bank Deposit Approved';
                $view = "mail.bank_deposit_mail";
                $compact['data'] =  array('fund_info' => $fund_info, 'receiver_info' => $receiver_info);
                // return $compact;
                @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);
            } catch (Exception $e) {
                $msg = $e->getMessage();
                Log::info($msg);
                Toastr::error('Mail not send.Please check email setting', 'Failed');
            }
            Toastr::success('Deposit Approved', 'Success');
            return redirect()->back();


            DB::commit();
        } catch (Throwable $e) {
            // DB::rollback();  
            $msg = Str::limit(str_replace("'", " ", $e->getMessage()), 50);
            $error = new ErrorLog();
            $error->process_name = 'Product Purchase Email Send';
            $error->error_message = $msg;
            $error->user_id = Auth::user()->id;
            $error->save();
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
