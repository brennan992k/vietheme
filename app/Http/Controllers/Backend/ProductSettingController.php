<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\FreeItem;
use App\Models\ItemCategory;
use App\Models\ProductSetting;
use App\Models\ItemSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class ProductSettingController extends Controller
{


    public function ProductSetting()
    {

        try {
            $data['subCategory'] = ItemSubCategory::all();
            $data['category'] = ItemCategory::all();

            $data['ProductSetting'] = ProductSetting::all();
            return view('backend.product.ProductSetting', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    public function ProductSettingDelete($id)
    {
        try {
            $item = ProductSetting::find($id)->delete();
            Toastr::success('Product Setting Delete Successfully', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    public function ProductSettingStore(Request $request)
    {
        $request->validate([
            'title' => "required",
            'category_id' => 'required|string|unique:product_settings,item_category_id',
            'url' => "required",
            'amount' => "required",
            'active_status' => "required",
        ]);


        try {
            $store = new ProductSetting();
            $store->title = $request->title;
            $store->url = $request->url;
            $store->amount = $request->amount;
            $store->item_category_id = $request->category_id;
            $store->active_status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Sub Category Added !', 'Success');
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
    function ProductSettingEdit($id)
    {

        try {
            $data['ProductSetting'] = ProductSetting::all();
            $data['category'] = ItemCategory::all();
            $data['edit'] = ProductSetting::find($id);
            return view('backend.product.ProductSetting', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function ProductSettingUpdate(Request $request)
    {
        $request->validate([
            'title' => "required",
            'category_id' => 'required|string|unique:product_settings,item_category_id,' . $request->category_id,
            'url' => "required",
            'amount' => "required",
            'active_status' => "required",
        ]);


        try {
            $store = ProductSetting::find($request->id);

            $store->title = $request->title;
            $store->url = $request->url;
            $store->amount = $request->amount;
            $store->item_category_id = $request->category_id;
            $store->active_status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Sub Category updated !', 'Success');
                return redirect()->route('admin.ProductSetting');
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

    /* *********************  START FREE PRODUCT  *************************  */

    function free_product()
    {
        try {
            $data['item'] = Item::where(['active_status' => 1, 'status' => 1, 'free' => 1])->orderBy('id', 'desc')->get();
            return view('backend.product.free_content_list', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function free_product_active(Request $res, $id)
    {

        DB::beginTransaction();
        try {
            $data = Item::findOrFail($id);
            $data->free = 1;
            $data->status = 1;
            $data->save();
            $free_item = FreeItem::updateOrCreate(['item_id' => $id]);
            $free_item->date = $res->date;
            $free_item->save();

            DB::commit();
            Toastr::success('Free product added');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function free_product_deactive(Request $res, $id)
    {
        DB::beginTransaction();
        try {
            $data = Item::findOrFail($id);
            $data->free = 0;
            // $data->status=0;
            $data->save();
            $free_item = $data->freeItem;
            $free_item->delete();
            DB::commit();
            Toastr::success('Free product will be paid');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    /* *********************  END FREE PRODUCT  *************************  */
}
