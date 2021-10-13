<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\User;
use App\Models\ItemOrder;
use App\Models\BalanceSheet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class ReportController extends Controller
{
    public function adminRevenue(Request $request)
    {
        try {
            return view('backend.report.revenue');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function getAdminRevenue(Request $request)
    {
        $request->validate([
            'start_date' => "required",
            'end_date' => "required",
        ]);
        try {
            $start_date = date('Y-m-d', strtotime($request->start_date)) . ' 00:00:00';
            $end_date = date('Y-m-d', strtotime($request->end_date)) . ' 23:59:59';
            $item_order = ItemOrder::join('items', 'items.id', '=', 'item_orders.item_id')
                ->leftjoin('refunds', 'refunds.order_item_id', '=', 'item_orders.id')
                ->where('refunds.status', null)
                ->whereBetween('item_orders.created_at', [$start_date, $end_date])
                ->select('item_orders.*', 'items.title')
                ->get();
            $revenue_list = [];
            foreach ($item_order as $key => $value) {

                $author_income = DB::table('balance_sheets')->where('order_id', $value->order_id)->where('expense', '=', null)->first();

                $revenue_list[$key]['order_id'] = $value->order_id;
                $revenue_list[$key]['title'] = $value->title;
                $revenue_list[$key]['price'] = $value->subtotal;
                $revenue_list[$key]['author'] = $author_income->income;
                $revenue_list[$key]['revenue'] = floatval($value->subtotal) - floatval($author_income->income);
                $revenue_list[$key]['date'] = $value->created_at;
            }
            return view('backend.report.revenue', compact('revenue_list'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }



    public function authorRevenue(Request $request)
    {

        try {
            $authors = User::where('role_id', 4)->latest()->get();
            return view('backend.report.author_revenue', compact('authors'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function authorProduct(Request $request)
    {

        $author_products = Item::where('user_id', $request->id)->latest()->get();
        return response()->json([$author_products]);
    }

    public function getAuthorRevenue(Request $request)
    {
        $request->validate([
            // 'author' => "required",
            'start_date' => "required",
            'end_date' => "required",
        ]);

        try {
            $start_date = date('Y-m-d', strtotime($request->start_date)) . ' 00:00:00';
            $end_date = date('Y-m-d', strtotime($request->end_date)) . ' 23:59:59';
            if ($request->product) {
                $item_order = ItemOrder::join('items', 'items.id', '=', 'item_orders.item_id')
                    ->leftjoin('refunds', 'refunds.order_item_id', '=', 'item_orders.id')
                    ->where('refunds.status', null)
                    ->where('item_orders.author_id', $request->author)
                    ->where('item_orders.item_id', $request->product)
                    ->whereBetween('item_orders.created_at', [$start_date, $end_date])
                    ->select('item_orders.*', 'items.title')
                    ->get();
                $revenue_list = [];
                foreach ($item_order as $key => $value) {

                    $author_income = DB::table('balance_sheets')
                        ->where('author_id', $request->author)
                        ->where('order_id', $value->order_id)
                        ->where('expense', '=', null)
                        ->first();

                    $revenue_list[$key]['order_id'] = $value->order_id;
                    $revenue_list[$key]['title'] = $value->title;
                    $revenue_list[$key]['price'] = $value->subtotal;
                    $revenue_list[$key]['author'] = $author_income->income;
                    $revenue_list[$key]['revenue'] = floatval($value->subtotal) - floatval($author_income->income);
                    $revenue_list[$key]['date'] = $value->created_at;
                }
            } else {

                if ($request->author) {
                    $item_order = ItemOrder::join('items', 'items.id', '=', 'item_orders.item_id')
                        ->leftjoin('refunds', 'refunds.order_item_id', '=', 'item_orders.id')
                        ->where('refunds.status', null)
                        ->where('item_orders.author_id', $request->author)
                        ->whereBetween('item_orders.created_at', [$start_date, $end_date])
                        ->select('item_orders.*', 'items.title')
                        ->get();
                } else {
                    $item_order = ItemOrder::join('items', 'items.id', '=', 'item_orders.item_id')
                        ->leftjoin('refunds', 'refunds.order_item_id', '=', 'item_orders.id')
                        ->where('refunds.status', null)
                        // ->where('item_orders.author_id',$request->author)
                        ->whereBetween('item_orders.created_at', [$start_date, $end_date])
                        ->select('item_orders.*', 'items.title')
                        ->get();
                }

                $revenue_list = [];
                foreach ($item_order as $key => $value) {
                    if ($request->author) {
                        $author_income = BalanceSheet::where('author_id', $request->author)
                            ->where('order_id', $value->order_id)
                            ->where('expense', '=', null)
                            ->first();
                    } else {
                        $author_income = BalanceSheet::where('order_id', $value->order_id)
                            ->where('expense', '=', null)
                            ->first();
                    }


                    $revenue_list[$key]['order_id'] = $value->order_id;
                    $revenue_list[$key]['title'] = $value->title;
                    $revenue_list[$key]['price'] = $value->subtotal;
                    $revenue_list[$key]['author'] = $author_income->income;
                    $revenue_list[$key]['revenue'] = floatval($value->subtotal) - floatval($author_income->income);
                    $revenue_list[$key]['date'] = $value->created_at;
                }
            }


            $authors = User::where('role_id', 4)->latest()->get();
            return view('backend.report.author_revenue', compact('revenue_list', 'authors'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
