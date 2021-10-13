<?php

namespace App\Http\Controllers\Frontend\Vendor;

use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Refund;
use App\Models\Review;
use App\Models\Balance;
use App\Models\Withdraw;
use App\Models\ItemOrder;
use Carbon\Carbon;
use App\Models\SocialIcon;
use App\Models\SpnCountry;
use App\Models\BalanceSheet;
use App\Models\RefundComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Pages\Entities\InfixProfileSetting;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'vendorCheck']);
    }
    function chart(Request $res)
    {
        try {
            if (!empty($res->month)) {
                $month = $res->month;
                $year = $res->year;
            } else {

                $month = date("m");
                $year = date("y");
            }

            $number_of_days = date("t", mktime(0, 0, 0, $month, 1, $year));

            $data = [];
            for ($i = 1; $i <= $number_of_days; $i++) {
                if ($i < 10) {
                    $days = '0' . $i;
                } else {
                    $days = $i;
                }
                if ($month < 10) {
                    if (starts_with($month, '0')) {
                        $search_date = $year . '-' . $month . '-' . $days;
                    } else {
                        $search_date = $year . '-0' . $month . '-' . $days;
                    }
                } else {
                    $search_date = $year . '-' . $month . '-' . $days;
                }


                // $search_date = $year . '-' . $month;

                // $data['total_income'] = ItemOrder::leftjoin('refunds','refunds.order_item_id','=','item_orders.id')
                //                     ->where('item_orders.author_id', Auth::user()->id)
                //                     ->where('refunds.status',null)
                //                     ->get();
                $total_price = ItemOrder::leftjoin('refunds', 'refunds.order_item_id', '=', 'item_orders.id')
                    ->where('item_orders.author_id', Auth::user()->id)
                    ->where('refunds.status', null)
                    ->where('item_orders.created_at', 'LIKE', '%' . $search_date . '%')
                    ->sum('subtotal');
                $total_sell = ItemOrder::leftjoin('refunds', 'refunds.order_item_id', '=', 'item_orders.id')
                    ->where('item_orders.author_id', Auth::user()->id)
                    ->where('refunds.status', null)
                    ->where('item_orders.created_at', 'LIKE', '%' . $search_date . '%')
                    ->count();
                if (empty($total_price)) {
                    $total_price = 0;
                }
                if (empty($total_sell)) {
                    $total_sell = 0;
                }
                $data[] = $days . '#' . $total_price . '#' . $total_sell . '#' . $search_date;
            }
            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'data not found'], 201);
        }
    }

    function countrydata()
    {
        try {
            $order = DB::table('item_orders')
                ->leftjoin('refunds', 'refunds.order_item_id', '=', 'item_orders.id')
                ->join('spn_countries', 'item_orders.country_id', '=', 'spn_countries.id')
                ->select('item_orders.*', 'spn_countries.name as countryname', 'item_orders.subtotal as price')
                ->where('item_orders.author_id', Auth::user()->id)
                ->where('refunds.status', null)
                ->get();
            $data = [];
            foreach ($order as $key => $value) {
                $total_price = ItemOrder::leftjoin('refunds', 'refunds.order_item_id', '=', 'item_orders.id')
                    ->where('item_orders.author_id', Auth::user()->id)
                    ->where('refunds.status', null)

                    ->where('country_id', 'LIKE', '%' . $value->country_id . '%')
                    ->sum('subtotal');
                $country = ItemOrder::leftjoin('refunds', 'refunds.order_item_id', '=', 'item_orders.id')

                    ->where('refunds.status', null)
                    ->where('item_orders.author_id', Auth::user()->id)
                    ->where('country_id', 'LIKE', '%' . $value->country_id . '%')
                    ->first();
                $data[] = $total_price . '#' . $country;
            }
            //$order = ItemOrder::where('author_id',Auth::user()->id)->where('created_at','LIKE', '%'.$search_date.'%')->sum('subtotal');
            return response()->json($order, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'data not found'], 201);
        }
    }
    function statementData(Request $res)
    {
        try {
            if (!empty($res->month)) {
                $month = $res->month;
                $year = $res->year;
            } else {

                $month = date("m");
                $year = date("y");
            }
            $search_date = $year . '-' . $month;

            $from_date =  date("Y-m-01", strtotime($search_date));
            $to_date =  date("Y-m-t", strtotime($search_date));
            // return $from_date.'-'.$to_date;
            // return Statement::where('author_id', Auth::user()->id)->get();
            $data['statement'] = DB::table('statements')->where('author_id', Auth::user()->id)->whereBetween('created_at', [$from_date, $to_date])->get();
            if (empty($statement)) {
                $statement = 0;
            }
            $data['AuthorTax'] = Auth::user()->profile->country->tax;
            $data['monthly_sale'] = DB::table('balance_sheets')->where('author_id', Auth::user()->id)->whereBetween('created_at', [$from_date, $to_date])->get();

            // return $data['total_income'];
            $monthly_earn1 = 0.00;
            foreach ($data['monthly_sale'] as $key => $value) {
                $refund = DB::table('refunds')->where('order_item_id', $value->order_id)->where('status', 1)->first();
                if ($refund == null) {
                    $amount = $value->price - $value->fee;
                    $monthly_earn1 += $amount;
                }
            }
            $monthly_earn2 = 0.00;
            foreach ($data['monthly_sale'] as $key => $value) {
                $refund = DB::table('refunds')->where('order_item_id', $value->order_id)->where('status', 1)->first();
                if ($refund == null) {
                    $monthly_earn2 += $value->income;
                }
            }
            $monthly_earn3 = 0.00;
            foreach ($data['monthly_sale'] as $key => $value) {
                $refund = DB::table('refunds')->where('order_item_id', $value->order_id)->where('status', 1)->first();
                if ($refund == null) {
                    $monthly_earn3 += $value->price - $value->income;
                }
            }
            $data['monthly_earn1'] = $monthly_earn1;
            $data['monthly_earn2'] = $monthly_earn2;
            $data['monthly_earn3'] = $monthly_earn3;
            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 201);
        }
    }





    function statementsearch(Request $res)
    {
        try {

            // return response()->json($res->all(), 200);
            if (!empty($res->from) && !empty($res->to)) {
                $data['statement'] = DB::table('statements')->where('author_id', Auth::user()->id)->whereBetween('created_at', [$res->from, $res->to])->get();
                return $data;
                if (empty($statement)) {
                    $statement = 0;
                }
                $data['AuthorTax'] = Auth::user()->profile->country->tax;
                return response()->json($data, 200);
            } else {
                return response()->json(['error' => 'data not found'], 201);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e], 201);
        }
    }

    function dashboard($id)
    {
        try {
            $data['user'] = User::find(Auth::id());
            $data['dashboard'] = route('author.dashboard', $id);
            $data['socila_icons'] = SocialIcon::where('user_id', Auth::user()->id)->first();
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function profile($id)
    {
        try {
            $data['socila_icons'] = SocialIcon::where('user_id', Auth::user()->id)->first();
            $data['profile'] = route('author.profile', $id);
            $data['user'] = User::find(Auth::id());
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function setting($id)
    {

        try {
            $data['user'] = User::find(Auth::id());
            $data['setting'] = route('author.setting', $id);
            $data['socila_icons'] = SocialIcon::where('user_id', Auth::user()->id)->first();
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function download($id)
    {
        try {
            //$data['order'] = Order::where('user_id', Auth::user()->id)->paginate(6);
            $data['user'] = User::find(Auth::id());
            $data['download'] = route('author.download', $id);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    function statement($id)
    {
        try {
            $data['user'] = User::find(Auth::id());
            $data['statement'] = route('author.statement', $id);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    function payout($id)
    {
        try {
            $data['user'] = User::find(Auth::id());
            $data['payout'] = route('author.payout', $id);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function earning($id)
    {
        try {
            $data['user'] = User::find(Auth::id());
            $data['earning'] = route('author.earning', $id);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function portfolio($id)
    {
        try {
            $data['user'] = User::find(Auth::id());
            $data['portfolio'] = route('author.portfolio', $id);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function followers($id)
    {
        try {
            $data['user'] = User::find(Auth::id());
            $data['followers'] = route('author.followers', $id);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function followings($id)
    {
        try {
            $data['user'] = User::find(Auth::id());
            $data['followings'] = route('author.followings', $id);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function hiddenItem($id)
    {
        try {
            $data['user'] = User::find(Auth::id());
            $data['hiddenItem'] = route('author.hiddenItem', $id);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function reviews($id)
    {
        try {
            $data['user'] = User::find(Auth::id());
            $data['reviews'] = route('author.reviews', $id);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function refunds($id)
    {
        try {
            $data['user'] = User::find(Auth::id());
            $data['refund_order'] = $data['user']->itemRefund()->where('author_status', 1)->paginate(5);
            $data['refunds'] = route('author.refunds', $id);
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function ProductDownload(Request $request, $id)
    {
        try {

            $item_details = Item::findOrfail($id);
            // return $item_details;
            if ($item_details->user_id != Auth::user()->id) {
                Toastr::error('You are not authorized', 'Failed');
                return redirect()->back();
            }

            $file = explode('/', $item_details->file);
            $file_name = $file[5];

            $file = public_path() . '/uploads/product/file/zip/' . $file_name;
            if (file_exists($item_details->file)) {
                return Response()->download($item_details->file);
            } else {
                Toastr::error('File not found', 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function vendor($data = null)
    {
        try {
            // return Auth::user()->id;
            // $data['category'] =  ItemCategory::where('active_status', 1)->take(6)->get();
            $data['country'] = SpnCountry::all();
            $data['follower'] = $data['user']->followers()->paginate(6);
            $data['following'] = $data['user']->followings()->paginate(6);
            $data['item'] = Item::where('user_id', $data['user']->id)->where('active_status', 1)->where('status', 1)->latest()->paginate(5);
            $data['hidden_item'] = Item::where('user_id', $data['user']->id)->where('status', '!=', 1)->where('status', '!=', 3)->where('active_status', 1)->paginate(5);
            $data['order'] = Order::where('user_id', Auth::user()->id)->paginate(6);
            $data['monthly_income'] = ItemOrder::where('author_id', Auth::user()->id)->whereMonth('created_at', Carbon::now()->month)->get();
            $data['total_income'] = ItemOrder::leftjoin('refunds', 'refunds.order_item_id', '=', 'item_orders.id')
                ->where('item_orders.author_id', Auth::user()->id)
                ->where('refunds.status', null)
                ->get();
            $data['payout_history'] = Withdraw::join('author_payout_setups', 'author_payout_setups.id', '=', 'withdraws.payment_method_id')
                ->join('users', 'users.id', '=', 'withdraws.user_id')
                ->where('withdraws.user_id', Auth::user()->id)
                ->select('users.username', 'withdraws.amount', 'withdraws.created_at', 'author_payout_setups.*')
                ->get();
            $data['item_review'] = Review::where('vendor_id', Auth::user()->id)->paginate(6);
            $data['profile_setting'] = InfixProfileSetting::where('active_status', 1)->first();

            $data['monthly_sale'] = BalanceSheet::where('author_id', Auth::user()->id)->whereMonth('created_at', Carbon::now()->month)->get();

            // return $data['total_income'];
            $monthly_earn1 = 0.00;
            foreach ($data['monthly_sale'] as $key => $value) {
                $refund = Refund::where('order_item_id', $value->order_id)->where('status', 1)->first();
                if ($refund == null) {
                    $amount = $value->price - $value->fee;
                    $monthly_earn1 += $amount;
                }
            }
            $monthly_earn2 = 0.00;
            foreach ($data['monthly_sale'] as $key => $value) {
                $refund = Refund::where('order_item_id', $value->order_id)->where('status', 1)->first();
                if ($refund == null) {
                    $monthly_earn2 += $value->income;
                }
            }
            $monthly_earn3 = 0.00;
            foreach ($data['monthly_sale'] as $key => $value) {
                $refund = Refund::where('order_item_id', $value->order_id)->where('status', 1)->first();
                if ($refund == null) {
                    $monthly_earn3 += $value->price - $value->income;
                }
            }
            $data['monthly_earn1'] = $monthly_earn1;
            $data['monthly_earn2'] = $monthly_earn2;
            $data['monthly_earn3'] = $monthly_earn3;
            // return $data['monthly_earn1'];


            // return $data['monthly_income'];
            return view('frontend.vendor.dashboard', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function personalUpdate(Request $r, $id)
    {
        // return $r;
        try {
            $validator = Validator::make($r->all(), [
                'first_name' => 'sometimes|nullable|string',
                'last_name' => 'sometimes|nullable|string',
                'email' => 'required|unique:users,email,' . $r->id,
                'company_name' => 'sometimes|nullable|string',
                'address' => 'sometimes|nullable|string',
                'country_id' => 'sometimes|nullable|integer',
                // 'state_id' => 'sometimes|nullable|integer',
                // 'city_id' => 'sometimes|nullable|integer',
                'mobile' => 'sometimes|nullable|string',
                'zipcode' => 'sometimes|nullable|integer',
                'image' => 'sometimes|nullable|mimes:jpeg,jpg,png|max:80000',

            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $user = User::findOrFail($id);
            $user->email = $r->email;
            $user->save();

            $data = $user->profile;
            $data->user_id = $id;
            $data->first_name = $r->first_name;
            $data->last_name = $r->last_name;
            $data->mobile = $r->mobile;
            if ($r->company_name != "") {
                $data->company_name = $r->company_name;
            }
            if ($r->zipcode != "") {
                $data->zipcode = $r->zipcode;
            }
            if ($r->address != "") {
                $data->address = $r->address;
            }
            if ($r->country_id != "") {
                $data->country_id = $r->country_id;
            }
            if ($r->state_id != "") {
                $data->state_id = $r->state_id;
            }
            if ($r->city_id != "") {
                $data->city_id = $r->city_id;
            }
            $data->save();


            Toastr::success('Succsesfully profile updated yes!', 'Success');
            return redirect()->route('author.setting', $id);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function refundView($id)
    {
        try {
            $data['refund'] = Refund::findOrFail($id);
            if ($data['refund']->author_status == 0) {
                return redirect()->route('author.refunds', Auth::user()->id);
            }
            $data['refund_comment'] = RefundComment::where(['user_id' => Auth::id(), 'item_id' => $id])->get();
            return view('frontend.pages.refund_view', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function refundComment(Request $res)
    {
        // $res->validate([
        //     'refund_comment' => 'required|string',
        // ]);
        DB::beginTransaction();
        try {
            $item = Item::find($res->item_id);
            $data = new RefundComment();
            $data->user_id = Auth::user()->id;
            $data->author_id = $item->user_id;
            $data->item_id = $res->item_id;
            $data->refund_comment = $res->refund_comment;
            $data->save();

            $dat['message'] =  $res->refund_comment;
            $email_sms_title = 'Comment on refund product';
            MailNotification($dat, $res->to_name, $res->to_email, $email_sms_title);
            DB::commit();
            Toastr::success('Comment sent for refund', 'Email Sent');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function refundDecline($id)
    {
        DB::beginTransaction();
        try {
            $data = Refund::find($id);
            $data->author_status = 0;
            $data->save();
            $to_name = $data->user->username;
            $to_email = $data->user->email;
            $dat['message'] = 'Author decline refund on this ' .  $data->Item->title . ' product';
            $email_sms_title = 'Decline refund product';
            MailNotification($dat, $to_name, $to_email, $email_sms_title);
            DB::commit();
            Toastr::success('Refund decline for this request');
            return redirect()->route('author.refundView', $data->id);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function refundApprove($id)
    {
        DB::beginTransaction();
        try {
            $data = Refund::find($id);
            $data->status = 1;
            $data->save();
            $item = Item::find($data->item_id);
            $item->sell = $item->sell - 1;
            $item->save();
            $item_order = ItemOrder::find($data->order_item_id);
            $item_order->status = 0;
            $item_order->save();
            $order = $item_order->OrderItem;
            $order->total = $order->total - $item_order->subtotal;
            $order->save();
            $balance_sheet = BalanceSheet::where('order_id', $item_order->id)->where('item_id', $item->id)->first();
            $balance = Auth::user()->balance;
            $balance->amount = $balance->amount - $balance_sheet->income;
            $balance->save();

            // refund user
            $user = Balance::where('user_id', $data->user_id)->first();
            $user->amount = $user->amount + $balance_sheet->price;
            $user->save();
            $balance_ = new BalanceSheet();
            $balance_->author_id = $data->author_id;
            $balance_->item_id = $item->id;
            $balance_->order_id = $item_order->id;
            $balance_->price = $balance_sheet->price;
            $balance_->discount = $balance_sheet->discount;
            $balance_->fee = $balance_sheet->fee;
            $balance_->expense = $balance_sheet->income;
            $balance_->save();

            $to_name = $data->user->username;
            $to_email = $data->user->email;
            $dat['message'] = 'Author approved refund on this ' .  $data->Item->title . ' product';
            $email_sms_title = 'Approved refund product';
            MailNotification($dat, $to_name, $to_email, $email_sms_title);
            DB::commit();
            Toastr::success('Refund Approve for this request');
            return redirect()->route('author.refundView', $data->id);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    public function password_update(Request $request)
    {

        // return $request;
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password|min:6|different:current_password',
            'confirm_password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {

            $user = Auth::user();
            if (Hash::check($request->current_password, $user->password)) {

                $user->password = Hash::make($request->new_password);
                $result = $user->save();

                if ($result) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->route('author.setting', Auth::user()->id);
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->route('author.setting', Auth::user()->id);
                }
            } else {
                Toastr::error('Current password not match!', 'Failed');
                return redirect()->route('author.setting', Auth::user()->id);
            }
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('author.setting', Auth::user()->id);
        }
    }
}
