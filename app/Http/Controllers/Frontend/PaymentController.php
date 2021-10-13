<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Item;
use App\Models\User;
use App\Models\Label;
use App\Models\Order;
use App\Models\ItemOrder;
use App\Models\Statement;
use App\Models\ItemPayment;
use App\Models\PaidPayment;
use App\Models\BalanceSheet;
use App\Models\PurchaseCode;
use App\Models\PaymentMethod;
use App\Models\ItemUpdateNotify;
use App\Models\PaidPackagePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\frontend\PaypalController;
use App\Models\Balance;
use Exception;
use Illuminate\Support\Facades\Log;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\Token;

class PaymentController extends Controller
{

    function AddPayment(Request $r)
    {
        // return $r;
        $r->validate([
            'card_name' => 'required',
            'card_number' => 'required',
            'cvc' => 'required',
            'exp_mm' => 'required|min:2|max:2',
            'exp_yy' => 'required|min:4|max:4' . (date('Y') + 1),
            'address' => 'required|string',
            'zipcode' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $user = User::findOrFail(Auth::user()->id);
            $order = $user->profile;
            $order->user_id = Auth::user()->id;
            $order->first_name = $r->first_name;
            $order->last_name = $r->last_name;
            $order->company_name = $r->company_name;
            $order->address = $r->address;
            $order->country_id = $r->country_id;
            $order->state_id = $r->state_id;
            $order->city_id = $r->city_id;
            $order->zipcode = $r->zipcode;
            $order->save();
            if ($r->name == 'Stripe') {
                try {
                    Stripe::setApiKey(env('STRIPE_SECRET'));
                    $customer = Customer::create(array(
                        'email' => Auth::user()->email,
                        'source' => $r->stripeToken,
                        'card' => $r->stripeCard
                    ));

                    if ($customer) {
                        //  $cardToken = Input::get('stripeToken');

                        $card = Token::create([
                            'card' => [
                                'number'    => $r->card_number,
                                'exp_month' => $r->exp_mm,
                                'exp_year'  => $r->exp_yy,
                                'cvc'       => $r->cvc,
                            ],
                        ]);
                        //   card find
                        /* $card = \Stripe\Token::retrieve(
                            $data->payment_method->card_number
                        ); */
                    } else {
                        Toastr::error('Something went wrong ! try again ', 'Error');
                        return redirect()->back();
                    }
                } catch (Exception $e) {
                    $msg = str_replace("'", " ", $e->getMessage());
                    Toastr::error($msg, 'Failed');
                    return redirect()->back();
                }
            }
            $chck = PaymentMethod::where('user_id', Auth::id())->update(['status' => 0]);
            if (@$r->id) {
                $store = PaymentMethod::findOrFail($r->id);
            } else {
                $store = new PaymentMethod();
            }
            $store->user_id = Auth::user()->id;
            if ($r->name == 'Stripe') {
                $card = $card->id;
            } else {
                $card = uniqid();
            }
            $store->card_id = $card;
            $store->card_number = $r->card_number;
            $store->card_name = $r->card_name;
            $store->cvc = $r->cvc;
            $store->name = $r->name;
            $store->exp_mm = $r->exp_mm;
            $store->exp_yy = $r->exp_yy;
            $store->status = 1;
            $result = $store->save();
            DB::commit();
            if ($result) {
                Toastr::success('Succsesfully payment method added !', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Something went wrong ! try again ', 'Success');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }



    function ItemPayment(Request $request)
    {
        $input = $request->input();
        $balnc  = Auth::user()->balance;
        DB::beginTransaction();
        try {
            if ($input['amount'] >= Cart::subtotal()) {
                Stripe::setApiKey(env('STRIPE_SECRET'));
                $stripe_id = uniqid();
                // Charge to customer
                $charge = Charge::create(array(
                    'description' => " - Amount: " . $input['amount'] . ' - ' . $stripe_id,
                    'source' => $request->stripeToken,
                    'amount' => (int)($input['amount'] * 100),
                    'currency' => 'USD'
                ));
                foreach (Cart::content() as $key => $value) {
                    ItemPayment::create([
                        'user_id' => Auth::user()->id,
                        'amount' => $value->price,
                        'charge_id' => $charge->id,
                        'stripe_id' => $stripe_id,
                        'item_id' => $value->options['item_id'],
                    ]);
                    $paid_payment = PaidPayment::updateOrCreate(['user_id' => Auth::user()->id]);
                    $paid_payment->amount = $input['amount'];
                    $paid_payment->save();
                }
                DB::commit();
                if ($paid_payment) {
                    return $this->payment_store();
                }
                Toastr::success('Payment success!');
                return redirect()->back();
            } else {
                Toastr::error('Please payment minimum  your item price $' . Cart::subtotal());
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function payment_main_balance(Request $r)
    {

        if (empty(Cart::subtotal())) {
            Toastr::error('Something went wrong, Plesae try again !');
            return redirect('cart');
        }

        try {
            $item_price = Cart::subtotal();
            $my_blance = Balance::where('user_id', Auth::user()->id)->first();

            if ($my_blance->amount >= $item_price) {
                $my_blance->amount = (float)$my_blance->amount - (float)$item_price;
                $myBalanceUpdate = $my_blance->save();

                if ($myBalanceUpdate) {
                    $paid_payment = PaidPayment::updateOrCreate(['user_id' => Auth::user()->id]);
                    $paid_payment->amount = $item_price + $paid_payment->amount;
                    $paid_payment->save();

                    if ($paid_payment) {
                        return $this->payment_store();
                    }
                }
            } else {
                Toastr::error('Your balance is insufficient');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }



        /*
         try {
            $_paid = PaidPayment::where('user_id',Auth::user()->id)->where('amount',$item_price)->first(); 
            
             if (@$_paid) {
                $amount = floatval($r->amount) - $_paid->amount;
                $check_Balanc = floatval($r->amount) + $_paid->amount;
               
             }else {
                 $amount = $r->amount;
                 $check_Balanc =$r->amount;
             }
            
            $balnc  = Auth::user()->balance;
             if (Cart::subtotal() > $balnc) {
                Toastr::error('Please payment at list $'.Cart::subtotal());
                return redirect()->back(); 
             }
             
            if (@$_paid) {
                if ($_paid->amount == Cart::subtotal()) {
                    Toastr::error('Already made payment!');
                    return redirect()->back();
                }else {
                    if ($balnc->amount <= $amount) {
                        Toastr::error('Your balance is insufficient');
                        return redirect()->back(); 
                    }else {                    
                            $balnc->amount = $balnc->amount - floatval($amount);
                            $balnc->save();
                            $paid_payment = PaidPayment::updateOrCreate(['user_id' => Auth::user()->id]); 
                            $paid_payment->amount = $amount + $paid_payment->amount;
                            $paid_payment->save(); 
                            if ($paid_payment) {
                                return $this->payment_store();
                            }   
                        }
                }                 

            }else {
                if ($balnc->amount <= $r->amount) {
                    Toastr::error('Your balance is insufficient');
                    return redirect()->back(); 
                }else {                    
                        $balnc->amount = $balnc->amount - floatval($r->amount);
                        $balnc->save();
                        $paid_payment = PaidPayment::updateOrCreate(['user_id' => Auth::user()->id]); 
                        $paid_payment->amount = $r->amount;
                        $paid_payment->save(); 
                        if ($paid_payment) {
                            return $this->payment_store();
                        }
                        // Toastr::success('Payment success!');
                        // return redirect()->back();   
                    }
                
                } 

            } catch (Exception $e) {
               $msg=str_replace("'", " ", $e->getMessage()) ;
                Toastr::error($msg, 'Failed');
                return redirect()->back(); 
            }           
       */
    }


    // paypal 
    function ItemPaymentPaypal(Request $request)
    {
        $input = $request->input();
        $balnc  = Auth::user()->balance;
        DB::beginTransaction();
        try {

            if ($input['amount'] >= Cart::subtotal()) {

                $paid_payment = PaidPayment::updateOrCreate(['user_id' => Auth::user()->id]);
                $paid_payment->amount = $input['amount'];
                $paid_payment->save();
                DB::commit();
                if ($paid_payment) {
                    $paypal = new PaypalController;
                    return $paypal->getCheckout($input['amount']);
                }
                Toastr::success('Payment success!');
                return redirect()->back();
            } else {
                Toastr::error('Please payment minimum  your item price $' . Cart::subtotal());
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function payment_store()
    {

        DB::beginTransaction();
        try {

            $data['paid_payment'] = $paid_payment = PaidPayment::where('user_id', Auth::user()->id)->first();
            $data['user'] = $user = User::findOrFail(Auth::user()->id);
            if (empty(@$paid_payment->id)) {
                Toastr::error('Please complete payment first');
                return redirect()->back();
            }
            if (Cart::subtotal() > $paid_payment->amount) {
                Toastr::error('Please payment at list $' . Cart::subtotal());
                return redirect()->back();
            }

            if (!empty(@$paid_payment->id)) {

                if (!empty(@$user->id)) {
                    try {
                        $order = new Order();
                        $order->user_id = Auth::user()->id;
                        $order->first_name = $user->profile->first_name;
                        $order->last_name = $user->profile->last_name;
                        $order->company_name = $user->profile->company_name;
                        $order->address = $user->profile->address;
                        $order->country_id = $user->profile->country_id;
                        $order->state_id = $user->profile->state_id;
                        $order->city_id = $user->profile->city_id;
                        $order->zipcode = $user->profile->zipcode;
                        $order->total = (float)Cart::subtotal();
                        $order->save();
                        $total_tax = 0.00;
                    } catch (Exception $e) {
                        $msg = str_replace("'", " ", $e->getMessage());
                        Toastr::error($msg, 'Failed');
                    }


                    foreach (Cart::content() as $key => $value) {

                        $product_tax = $value->options['tax'];
                        $total_tax += $product_tax;
                        $countable_price = $value->price - $product_tax;

                        $author = User::find($value->options['user_id']);
                        $author_total_income = BalanceSheet::where('author_id', $value->options['user_id'])->sum('income');
                        if (@$value->options['item_id']) {
                            $label = Label::where('amount', '<=', $author_total_income)->orderBy('id', 'desc')->first();
                            try {
                                $item_order = new ItemOrder();
                                $item_order->user_id = Auth::user()->id;
                                $item_order->order_id = $order->id;
                                $item_order->item_id = $value->options['item_id'];
                                $item_order->subtotal = $countable_price;
                                $item_order->country_id = $user->profile->country_id;
                                if (isset($value->options['coupon_price'])) {
                                    $discount = $value->options['coupon_price'];
                                } else {
                                    $discount = 0;
                                }
                                $item_order->discount = $discount;
                                $item_order->author_id = $value->options['user_id'];
                                $item_order->item = json_encode($value->options);

                                $item_order->save();
                            } catch (Exception $e) {
                                $msg = str_replace("'", " ", $e->getMessage());
                                Toastr::error($msg, 'Failed');
                            }


                            try {
                                $email_notify         = new ItemUpdateNotify();
                                $email_notify->notify = 1;
                                $email_notify->user_id = Auth::user()->id;
                                $email_notify->item_id = $value->options['item_id'];
                                $email_notify->save();
                            } catch (Exception $e) {
                                $msg = str_replace("'", " ", $e->getMessage());
                                Toastr::error($msg, 'Failed');
                            }

                            try {
                                //Purchase Code genarate
                                $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                $random_string = $new = '';
                                $timestr = time() . date('Y');
                                for ($i = 0; $i < 4; $i++) {
                                    $random_character = $permitted_chars[mt_rand(0, strlen($permitted_chars) - $i)];
                                    $random_string .= $random_character;
                                }
                                for ($i = 0; $i <= 11; $i++) {
                                    if ($i % 4 == 0) {
                                        $new = $new . '-' . $timestr[$i];
                                    } else {
                                        $new = $new . $timestr[$i];
                                    }
                                }
                                $purchase_code = $random_string . '' . $new;

                                $purchaseCode = new PurchaseCode();
                                $purchaseCode->product_id = $value->options['item_id'];
                                $purchaseCode->order_id = $item_order->id;
                                $purchaseCode->customer_id = $value->options['user_id'];
                                $purchaseCode->purchase_code = $purchase_code;
                                $purchaseCode->save();
                            } catch (Exception $e) {
                                $msg = str_replace("'", " ", $e->getMessage());
                                Toastr::error($msg, 'Failed');
                            }


                            if ($value->options['buyer_fee'] != 0) {
                                $statement = new Statement();
                                $statement->author_id = $value->options['user_id'];
                                $statement->item_id = $value->options['item_id'];
                                $statement->order_id = $order->id;
                                $statement->type = 'e';
                                $statement->title = 'Author fee';
                                $statement->details = 'Author fee for sale';
                                $statement->price = $value->options['buyer_fee'];
                                $statement->save();
                            }

                            if (isset($value->options['coupon_price'])) {
                                $statement = new Statement();
                                $statement->author_id = $value->options['user_id'];
                                $statement->item_id = $value->options['item_id'];
                                $statement->order_id = $order->id;
                                $statement->type = 'e';
                                $statement->title = 'Couopon';
                                $statement->details = 'Coupon discount';
                                $statement->price = $value->options['coupon_price'];
                                $statement->save();
                                $data['statement'][] = $statement;
                            }


                            try {
                                $details = Item::find($item_order->item_id);
                                $statement1 = new Statement();
                                $statement1->order_id = $order->id;
                                $statement1->author_id = $value->options['user_id'];
                                $statement1->item_id = $value->options['item_id'];
                                $statement1->type = 'i';
                                $statement1->title = 'sale';
                                $statement1->details = $details->title;
                                $statement1->price = $countable_price;
                                $statement1->save();
                            } catch (Exception $e) {
                                $msg = str_replace("'", " ", $e->getMessage());
                                Toastr::error($msg, 'Failed');
                            }

                            try {
                                $itemUp = Item::find($value->options['item_id']);
                                $itemUp->sell = $itemUp->sell + 1;
                                $itemUp->save();
                            } catch (Exception $e) {
                                $msg = str_replace("'", " ", $e->getMessage());
                                Toastr::error($msg, 'Failed');
                            }


                            try {
                                $balnc  = $author->balance;
                                $income = ($countable_price - $value->options['buyer_fee']) - ((@$label->rate / 100) * ($countable_price - $value->options['buyer_fee']));
                                $balnc->amount = $author->balance->amount + $income;
                                $balnc->save();
                            } catch (Exception $e) {
                                $msg = str_replace("'", " ", $e->getMessage());
                                Toastr::error($msg, 'Failed');
                            }


                            try {
                                $balance_sheet = new BalanceSheet();
                                $balance_sheet->author_id = $author->id;
                                $balance_sheet->item_id = (int)$value->options['item_id'];
                                $balance_sheet->order_id = $order->id;
                                $balance_sheet->price = $countable_price;
                                $balance_sheet->discount = $discount;
                                $balance_sheet->fee = $value->options['buyer_fee'];
                                $balance_sheet->income = $income;
                                $balance_sheet->save();
                            } catch (Exception $e) {
                                $msg = str_replace("'", " ", $e->getMessage());
                                Toastr::error($msg, 'Failed');
                            }
                        }
                        //end checking item value 

                        // mail sending error handel
                        try {
                            $data['message'] = Auth::user()->username . ' bought this  <b>' . @$item_order->Item->title . '</b> product';
                            $to_name = Auth::user()->username;
                            $to_email = Auth::user()->email;
                            $email_sms_title = 'Buy product';
                            MailNotification($data, $to_name, $to_email, $email_sms_title);
                        } catch (Exception $e) {
                            $msg = str_replace("'", " ", $e->getMessage());
                            Log::info($msg);
                            Toastr::error('Unable to Send Email, Please check configuration!', 'Failed');
                        }
                    }
                }
            } else {
                DB::rollback();
                Toastr::error('Please complete payment first');
                return redirect()->back();
            }
            if ($paid_payment) {
                $paid_payment->delete();
            }
            DB::commit();
            Cart::destroy();
            Toastr::success('Thank you for purchase');
            return redirect()->route('customer.payment_complete');
        } catch (Exception $e) {
            DB::rollback();
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    function ItempackagePayment(Request $r)
    {
        DB::beginTransaction();
        try {
            $user = User::find(Auth::user()->id);
            if (count(Cart::content()) > 0) {
                if ($user->buyPackage->count() <= 0) {
                    Toastr::error('You have no package anymore! ');
                    return redirect()->back();
                } else {
                    $_paid = PaidPackagePayment::where('user_id', $user->id)->count();
                    if (@$_paid > 0) {
                        Toastr::error('Already made payment!');
                        return redirect()->back();
                    } else {
                        if (@$user->buyPackage()->sum('totalItem') < count(Cart::content())) {
                            Toastr::error('Your package item is insufficient');
                            return redirect()->back();
                        } else {
                            foreach (Cart::content() as $key => $value) {
                                foreach ($user->buyPackage as $key => $value) {
                                    if (@$value->totalItem  != 0) {
                                        $buy_package = $value;
                                        $buy_package->totalItem = $value->totalItem - 1;
                                        $buy_package->save();
                                        break;
                                    }
                                }
                            }
                            $paid_payment = PaidPackagePayment::updateOrCreate(['user_id' => $user->id]);
                            $paid_payment->total = count(Cart::content());
                            $paid_payment->save();
                            DB::commit();
                            Toastr::success('Payment success!');
                            return redirect()->back();
                        }
                    }
                }
            } else {
                Toastr::error('Something went wrong ! try again ');
                return redirect('/');
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
