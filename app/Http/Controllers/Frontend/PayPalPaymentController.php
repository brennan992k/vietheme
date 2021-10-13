<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\ItemPayment;
use App\Models\PaidPayment;
use Omnipay\Omnipay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class PayPalPaymentController extends Controller
{
    public $gateway;
 
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        // $this->gateway->setTestMode(PaymentMode('Paypal')); //set it to 'false' when go live
                 if (PaymentMode('Paypal')=='true') {
                    $this->gateway->setTestMode(true);
                } else {
                    $this->gateway->setTestMode(false); 
                }
    }
 
    public function index()
    {
        return view('test_payment');
    }
 
    public function charge(Request $request)
    {
        if($request->input('submit'))
        {
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $request->input('amount'),
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('paypal/paymentsuccess'),
                    'cancelUrl' => url('paypal/paymenterror'),
                ))->send();
                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch(Exception $e) {
                return $e->getMessage();
            }
        }
    }
 
    public function payment_success(Request $request)
    {
        // return $request;
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();
         
                // Insert transaction data into the database
                $isPaymentExist = Payment::where('payment_id', $arr_body['id'])->first();
         
                if(!$isPaymentExist)
                {
                    $payment = new Payment;
                    $payment->payment_id = $arr_body['id'];
                    $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->currency = env('PAYPAL_CURRENCY');
                    $payment->payment_status = $arr_body['state'];
                    $payment->save();

                    //Start DM PayPal

                    if ($arr_body['transactions'][0]['amount']['total'] >= Cart::subtotal()) {  

                        $paid_payment = PaidPayment::updateOrCreate(['user_id' => Auth::user()->id]); 
                        $paid_payment->amount = $arr_body['transactions'][0]['amount']['total'];
                        $paid_payment->save();

                        foreach (Cart::content() as $key => $value) {                            
                            ItemPayment::create([ 
                                'user_id'=>Auth::user()->id,                                      
                                'amount'=> $value->price,
                                'type'=> 'Paypal',
                                'payment_id'=>$arr_body['id'],
                                // 'token'=>$token,
                                'payer_id'=>$arr_body['payer']['payer_info']['payer_id'],                     
                                'item_id'=> $value->options['item_id'],
                            ]);
                        }
                                // $checkoutController = new PaymentController;
                        return app(PaymentController::class)->payment_store();



                        DB::commit();                                           
                        

                        Toastr::success('Payment success!');
                        return redirect()->back();
                    }else{
                        Toastr::error('Please payment minimum  your item price $'.Cart::subtotal());
                        return redirect()->back();
                    }  
                    //End DM PayPal
                }
         
                // return "Payment is successful. Your transaction id is: ". $arr_body['id'];
                        Toastr::success("Payment is successful. Your transaction id is: ". $arr_body['id']);
                        return redirect()->back();
            } else {
                $msg=str_replace("'", " ", $response->getMessage()) ;
                Toastr::error($msg, 'Failed');
                return redirect()->back(); 
            }
        } else {
            Toastr::error('Transaction is declined');
            return redirect()->back();
        }

        
    }
 
    public function payment_error()
    {
        // return 'User is canceled the payment.';
        Toastr::error('User is canceled the payment.', 'Failed');
        return redirect()->back(); 
    }

    
}
