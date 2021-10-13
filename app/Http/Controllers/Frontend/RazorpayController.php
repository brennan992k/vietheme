<?php

namespace App\Http\Controllers\frontend;

use App\Models\ItemPayment;
use App\Models\PaidPayment;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RazorpayController extends Controller
{
    function Razorpayment()
    {

        try {
            return view('frontend.cart.payRazor');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function payment(Request $request)
    {
        //Input items of form
        $input = $request->all();
        DB::beginTransaction();
        try {
            //  return $input;
            $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

            //Fetch payment information by razorpay_payment_id
            $payment = $api->payment->fetch($input['razorpay_payment_id']);

            if (count($input)  && !empty($input['razorpay_payment_id'])) {
                $payment_detalis = null;
                try {
                    $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));

                    foreach (Cart::content() as $key => $value) {
                        ItemPayment::create([
                            'user_id' => Auth::user()->id,
                            'amount' => $response['amount'],
                            'item_id' => $value->options['item_id'],
                        ]);
                    }
                    $paid_payment = PaidPayment::updateOrCreate(['user_id' => Auth::user()->id]);
                    $paid_payment->amount = $response['amount'];
                    $paid_payment->save();
                    DB::commit();
                    return app(PaymentController::class)->payment_store();

                    // $payment_detalis = json_encode(array('id' => $response['id'],'method' => $response['method'],'amount' => $response['amount'],'currency' => $response['currency']));
                } catch (Exception $e) {
                    return  $e->getMessage();
                    Session::put('error', $e->getMessage());
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
