<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Deposit;
use App\Models\Payment;
use Omnipay\Omnipay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PayPalDepositController extends Controller
{
    public $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        // $this->gateway->setTestMode(PaymentMode('Paypal')); //set it to 'false' when go live
        if (PaymentMode('Paypal') == 'true') {
            $this->gateway->setTestMode(true);
        } else {
            $this->gateway->setTestMode(false);
        }
    }

    public function index()
    {
        return view('test_payment');
    }

    public function deposit(Request $request)
    {

        if ($request->input('submit')) {
            try {

                $response = $this->gateway->purchase(array(
                    'amount' => $request->input('amount'),
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('paypal/depositsuccess'),
                    'cancelUrl' => url('paypal/depositerror'),
                ))->send();

                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function payment_success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                // The customer has successfully paid.
                $arr_body = $response->getData();

                // Insert transaction data into the database
                $isPaymentExist = Payment::where('payment_id', $arr_body['id'])->first();

                if (!$isPaymentExist) {
                    $payment = new Payment;
                    $payment->payment_id = $arr_body['id'];
                    $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->currency = env('PAYPAL_CURRENCY');
                    $payment->payment_status = $arr_body['state'];
                    $payment->save();

                    //Start DM PayPal

                    if (Session::has('deposit_amount')) {

                        $deposit = new Deposit();
                        $deposit->user_id = Auth::user()->id;
                        $deposit->title = 'Deposit';
                        $deposit->details = 'Fund deposit via paypal';
                        $deposit->amount = $arr_body['transactions'][0]['amount']['total'];
                        $deposit->save();
                        $balnc  = Auth::user()->balance;
                        $balnc->amount = $balnc->amount + $arr_body['transactions'][0]['amount']['total'];
                        $balnc->save();

                        Toastr::success('Fund added successful!', 'Success');
                        return redirect()->route('user.deposit', Auth::user()->username);
                    } else {
                        return redirect()->route('user.deposit', Auth::user()->username);
                    }
                    //End DM PayPal
                }

                // return "Payment is successful. Your transaction id is: ". $arr_body['id'];
                Toastr::success("Fund added successful. Your transaction id is: " . $arr_body['id']);
                return redirect()->route('user.deposit', Auth::user()->username);
            } else {
                $msg = str_replace("'", " ", $response->getMessage());
                Toastr::error($msg, 'Failed');
                return redirect()->route('user.deposit', Auth::user()->username);
            }
        } else {
            Toastr::error('Transaction is declined');
            return redirect()->route('user.deposit', Auth::user()->username);
        }
    }

    public function payment_error()
    {
        // return 'User is canceled the payment.';
        Toastr::error('User is canceled the payment.', 'Failed');
        return redirect()->route('user.deposit', Auth::user()->username);
    }
}
