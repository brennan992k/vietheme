<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\ItemFee;
use App\Models\BuyerItemFee;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class ItemFeeController extends Controller
{
    function itemFee()
    {
        try {
            $data['category'] = ItemCategory::where('up_permission', 1)->get();
            $data['item_fee'] = ItemFee::latest()->get();
            return view('backend.item_fee.index', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function itemFeeStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required|unique:item_fees,category_id,',
            're_fee' => 'required|integer',
            'ex_fee' => 'required|integer',
            'co_fee' => 'required|integer',
            'support_fee' => "required|",
            'status' => "required|",
        ]);

        try {
            $store = new ItemFee();
            $store->category_id = $request->category_id;
            $store->re_fee = $request->re_fee;
            $store->ex_fee = $request->ex_fee;
            $store->co_fee = $request->co_fee;
            $store->support_fee = $request->support_fee;
            $store->status = $request->status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully item fee Added !');
                return redirect()->back();
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
    function itemFeeEdit($id)
    {
        try {
            $data['item_fee'] = ItemFee::latest()->get();
            $data['edit'] = ItemFee::findOrFail($id);
            $data['category'] = ItemCategory::where('up_permission', 1)->get();
            return view('backend.item_fee.index', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function itemFeeUpdate(Request $request)
    {
        $request->validate([
            'category_id' => 'required|unique:item_fees,category_id,' . $request->id,
            're_fee' => 'required|integer',
            'ex_fee' => 'required|integer',
            'co_fee' => 'required|integer',
            'support_fee' => 'required',
            'status' => "required|",
        ]);

        try {
            $store = ItemFee::findOrFail($request->id);
            $store->category_id = $request->category_id;
            $store->re_fee = $request->re_fee;
            $store->ex_fee = $request->ex_fee;
            $store->co_fee = $request->co_fee;
            $store->support_fee = $request->support_fee;
            $store->status = $request->status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully item fee updated!');
                return redirect()->route('admin.item_fee');
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

    function itemFeeDelete($id)
    {
        try {
            $data = ItemFee::findOrFail($id);
            $data->delete();
            Toastr::success('Succsesfully item fee deleted!');
            return redirect()->route('admin.item_fee');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function buyerItemFee()
    {
        try {
            $data['user'] = User::where('role_id', '!=', 1)->where('status', 1)->where('access_status', 1)->get();
            $data['fee'] = BuyerItemFee::where('status', 1)->get();
            return view('backend.item_buyer_fee.fee', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function feeStore(Request $request)
    {
        $this->validate($request, [
            'fee' => "required|",
            'type' => "required|unique:buyer_item_fees,type,",
            'active_status' => "required|",
        ]);

        try {
            $store = new BuyerItemFee();
            $store->fee = $request->fee;
            $store->user_id = $request->user_id;
            $store->type = $request->type;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully buyer item  Added !', 'Success');
                return redirect()->back();
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

    public function editfee($id)
    {
        try {
            $data['fee'] = BuyerItemFee::all();
            $data['edit'] = BuyerItemFee::find($id);
            $data['user'] = User::where('role_id', '!=', 1)->get();
            return view('backend.item_buyer_fee.fee', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function updatefee(Request $request)
    {

        $request->validate([
            'fee' => "required|",
            'type' => "required|unique:buyer_item_fees,type," . $request->id,
            'active_status' => "required|",
        ]);

        try {
            $store = BuyerItemFee::find($request->id);
            $store->fee = $request->fee;
            $store->user_id = $request->user_id;
            $store->type = $request->type;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully fee updated !', 'Success');
                return redirect()->route('admin.buyerItemFee');
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
    function deletefee($id)
    {
        try {
            $data = BuyerItemFee::find($id);
            $data->delete();
            Toastr::success('Succsesfully buyer item fee deleted !', 'Success');
            return redirect()->route('admin.buyerItemFee');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
