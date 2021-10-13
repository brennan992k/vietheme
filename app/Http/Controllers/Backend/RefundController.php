<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\User;
use App\Models\Refund;
use App\Models\Balance;
use App\Models\ItemOrder;
use App\Models\Statement;
use App\Models\BalanceSheet;
use App\Models\PurchaseCode;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class RefundController extends Controller
{
  function refund_order()
  {
    try {
      $data['refund_order'] = Refund::leftjoin('item_orders', 'item_orders.order_id', '=', 'refunds.order_item_id')
        ->where('refunds.status', 0)
        ->select('refunds.*', 'item_orders.download_status')
        ->latest()->get();
      //   return $data['refund_order'];
      return view('backend.refund.request_refund_item', compact('data'));
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
      $balance = User::find($data->author_id)->balance;
      $balance->amount = $balance->amount - $balance_sheet->income;
      $balance->save();

      $purchase_licence = PurchaseCode::where('order_id', $data->order_item_id)->first();
      $purchase_licence->active_status = 0;
      $purchase_licence->save();

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

      $statement = new Statement();
      $statement->author_id = $data->author_id;
      $statement->item_id = $item->id;
      $statement->order_id = $item_order->id;
      $statement->type = "e";
      $statement->title = "Refund";
      $statement->details = "Buyer Refunded";
      $statement->price = $balance_sheet->price;
      $statement->save();

      $to_name = $data->user->username;
      $to_email = $data->user->email;
      $dat['message'] = 'Author approved refund on this ' .  $data->Item->title . ' product';
      $email_sms_title = 'Approved refund product';
      MailNotification($dat, $to_name, $to_email, $email_sms_title);
      DB::commit();
      Toastr::success('Refund Approve for this request');
      return redirect()->route('admin.refund_order');
    } catch (Exception $e) {
      DB::rollback();
      $msg = str_replace("'", " ", $e->getMessage());
      Toastr::error($msg, 'Failed');
      return redirect()->back();
    }
  }

  function approved_refund_order()
  {
    try {
      $data['refund_order'] = Refund::where('status', 1)->latest()->get();
      return view('backend.refund.refund_item', compact('data'));
    } catch (Exception $e) {
      $msg = str_replace("'", " ", $e->getMessage());
      Toastr::error($msg, 'Failed');
      return redirect()->back();
    }
  }
}
