<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Facades\DB;
use Paypal;
use App\Models\Deposit;
use App\Models\ItemPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\PaymentController;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaypalController extends Controller
{
    private $_apiContext;

    public function __construct()
    {
        $pay = DB::table('infix_payment_gateway_settings')->where('gateway_name', 'PayPal')->first();
        if ($pay->active_status == 1 && $pay->mode == 1) {
            $mode = 'sandbox';
            $endPoint = 'https://api.sandbox.paypal.com';
        }
        if ($pay->active_status == 1 && $pay->mode == 2) {
            $mode = 'live';
            $endPoint = 'https://api.paypal.com';
        }

        $this->_apiContext = PayPal::ApiContext(
            env('PAYPAL_CLIENT_ID'),
            env('PAYPAL_SECRET')
        );

        $this->_apiContext->setConfig(array(
            'mode' => $mode,
            'service.EndPoint' => $endPoint,
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));
    }

    public function payment($total_amount, $url)
    {

        try {
            $payer = PayPal::Payer();
            $payer->setPaymentMethod('paypal');
            $amount = PayPal::Amount();
            $amount->setCurrency('USD');
            $amount->setTotal((int)$total_amount);
            // $amount->setTotal(convert_to_usd($total_amount));
            $description = 'Payment for order completion';
            $transaction = PayPal::Transaction();
            $transaction->setAmount($amount);
            $transaction->setDescription($description);
            $redirectUrls = PayPal::RedirectUrls();
            $redirectUrls->setReturnUrl($url);
            $redirectUrls->setCancelUrl(url('paypal/payment/cancel'));
            $payment = PayPal::Payment();
            $payment->setIntent('sale');
            $payment->setPayer($payer);
            $payment->setRedirectUrls($redirectUrls);
            $payment->setTransactions(array($transaction));
            $response = $payment->create($this->_apiContext);
            $redirectUrl = $response->links[1]->href;

            return Redirect::to($redirectUrl);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function getCheckout($total_amount)
    {
        try {
            $url = url('paypal/payment/done');
            return  $this->payment($total_amount, $url);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    public function getCancel(Request $request)
    {

        try {
            $request->session()->forget('order_id');
            $request->session()->forget('payment_data');
            flash(__('Payment cancelled'))->success();
            return redirect()->url()->previous();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function getDone(Request $request)
    {

        try {
            $payment_id = $request->get('paymentId');
            $token = $request->get('token');
            $payer_id = $request->get('PayerID');
            $payment = PayPal::getById($payment_id, $this->_apiContext);
            $paymentExecution = PayPal::PaymentExecution();

            $paymentExecution->setPayerId($payer_id);
            $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

            foreach (Cart::content() as $key => $value) {
                ItemPayment::create([
                    'user_id' => Auth::user()->id,
                    'amount' => $value->price,
                    'type' => 'Paypal',
                    'payment_id' => $payment_id,
                    'token' => $token,
                    'payer_id' => $payer_id,
                    'item_id' => $value->options['item_id'],
                ]);
            }
            // $checkoutController = new PaymentController;
            return app(PaymentController::class)->payment_store();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function paypalDepositAdd(Request $request)
    {

        try {
            if (Session::has('deposit_amount')) {
                $url = url('paypal/fund-deposit/done');
                $total_amount = $request->amount;
                return $this->payment($total_amount, $url);
            } else {
                return redirect()->route('user.deposit', Auth::user()->username);
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function FundgetDone(Request $request)
    {

        try {
            $payment_id = $request->get('paymentId');
            $token = $request->get('token');
            $payer_id = $request->get('PayerID');
            $payment = PayPal::getById($payment_id, $this->_apiContext);
            $paymentExecution = PayPal::PaymentExecution();

            $paymentExecution->setPayerId($payer_id);
            $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

            $from_currency = 'USD';
            $to_currency = GeneralSetting()->currency;
            $amount = convertCurrency($from_currency, $to_currency, Session::get('deposit_amount'));

            $deposit = new Deposit();
            $deposit->user_id = Auth::user()->id;
            $deposit->title = 'deposit';
            $deposit->details = 'Fund deposit via paypal';
            $deposit->amount = floatval($amount);
            $deposit->save();

            $balnc  = Auth::user()->balance;
            $balnc->amount = $balnc->amount + floatval($amount);
            $balnc->save();

            Toastr::success('Fund added successful!', 'Success');
            return redirect()->route('user.deposit', Auth::user()->username);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
