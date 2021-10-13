<?php

namespace App\Http\Controllers\Backend;

use App\Models\Refund;
use App\Models\ItemOrder;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class OrderController extends Controller
{
  function order()
  {
    try {
      $refunds = Refund::where('status', 1)->get();
      $refunds_list = [];
      foreach ($refunds as $key => $refund) {
        $refunds_list[] = $refund->order_item_id;
      }
      $data['refunds_list'] = $refunds_list;
      $data['item_order'] = ItemOrder::latest()->get();
      return view('backend.order.order_item', compact('data'));
    } catch (Exception $e) {
      $msg = str_replace("'", " ", $e->getMessage());
      Toastr::error($msg, 'Failed');
      return redirect()->back();
    }
  }
}
