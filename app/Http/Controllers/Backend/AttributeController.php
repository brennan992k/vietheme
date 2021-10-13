<?php

namespace App\Http\Controllers\Backend;

use App\Models\Item;
use App\Models\User;
use App\Models\BuyerFee;
use App\Models\Attribute;
use App\Models\ReviewType;
use App\Models\BuyerFeeType;
use App\Models\ItemCategory;
use App\Models\SubAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Str;

class AttributeController extends Controller
{

    /* ********************* START  Attributes *************************  */
    public function attributes()
    {
        try {
            $data['attributes'] = Attribute::all();

            return view('backend.product.attributes', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function attributesStore(Request $request)
    {
        $request->validate([
            'name' => "required|string|unique:attributes,name",
            'field_name' => "required|string",
            'active_status' => "required",
        ]);
        try {

            $store = new Attribute();
            $store->name = $request->name;
            $store->field_name = $request->field_name;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Attributes Added !', 'Success');
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

    public function editattributes($id)
    {
        try {
            $data['attributes'] = Attribute::all();
            $data['edit'] = Attribute::find($id);
            return view('backend.product.attributes', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function updateattributes(Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:attributes,name,' . $request->id,
            'field_name' => "required|string|",
            'active_status' => "required|",
        ]);

        try {
            $store = Attribute::find($request->id);
            $store->name = $request->name;
            $store->field_name = $request->field_name;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Attributes updated !', 'Success');
                return redirect()->route('admin.attributes');
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



    public function deleteattributes(Request $request, $id)
    {
        // return $id;
        try {
            // $tables = TableList::getTableList('attributes_id', $id);
            // return $tables;
            $tables = SubAttribute::where('attributes_id', $id)->first();
            try {
                if ($tables == null) {

                    $delete_query = Attribute::find($id);
                    $delete_query->delete();

                    Toastr::success('Succsesfully Deleted!', 'Success');
                    return redirect()->back();
                } else {
                    $msg = 'This data already used in Sub Attribute tables, Please remove those data first';
                    Toastr::error($msg, 'Failed');
                    return redirect()->back();
                }
            } catch (\Illuminate\Database\QueryException $e) {

                $msg = 'This data already used in tables, Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    /* *********************  END Attributes  *************************  */


    /* ********************* START SUB attributes *************************  */
    public function subattributes()
    {
        try {
            $data['subattributes'] = SubAttribute::all();
            $data['attributes'] = Attribute::all();
            $data['categories'] = ItemCategory::all();
            return view('backend.product.subattributes', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function CategoryWithAttributeExists($request)
    {
        $is_exist = SubAttribute::where('category_id', $request->category_id)
            ->where('attributes_id', $request->attributes_id)
            ->where('name', $request->name)
            ->first();
        if ($is_exist) {
            return true;
        } else {
            return false;
        }
    }
    function UpdateCategoryWithAttributeExists($request)
    {
        $is_exist = SubAttribute::where('category_id', $request->category_id)
            ->where('attributes_id', $request->attributes_id)
            ->where('name', $request->name)->where('id', '!=', $request->id)
            ->first();
        if ($is_exist) {
            return true;
        } else {
            return false;
        }
    }
    public function subattributesStore(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:200",
            'active_status' => "required|",
            'attributes_id' => "required|",
            'category_id' => "required|",
            'active_status' => "required|",
        ]);


        if ($this->CategoryWithAttributeExists($request)) {
            Toastr::error('The name has already been taken !', 'Failed');
            return redirect()->back()->withInput();
        }


        try {
            $store = new SubAttribute();
            $store->name = $request->name;
            $store->attributes_id = $request->attributes_id;
            $store->category_id = $request->category_id;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully sub attributes Added !', 'Success');
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
    function editSubattributes($id)
    {
        try {
            $data['subattributes'] = SubAttribute::all();
            $data['attributes'] = Attribute::all();
            $data['categories'] = ItemCategory::all();
            $data['edit'] = SubAttribute::find($id);
            return view('backend.product.subattributes', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function updateSubattributes(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'active_status' => "required|",
            'attributes_id' => "required|",
            'category_id' => "required|",
            'active_status' => "required|",
        ]);


        if ($this->UpdateCategoryWithAttributeExists($request)) {
            Toastr::error('The name has already been taken !', 'Failed');
            return redirect()->back()->withInput();
        }

        try {
            $store = SubAttribute::find($request->id);

            $store->name = $request->name;
            $store->attributes_id = $request->attributes_id;
            $store->category_id = $request->category_id;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully sub attributes updated !', 'Success');
                return redirect()->route('admin.subattributes');
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
    //     function deleteSubattributes($id){
    //         try {
    //         $data=SubAttribute::find($id);
    //         $data->delete();
    //         Toastr::success('Succsesfully sub attributes deleted !','Success');
    //         return redirect()->route('admin.subattributes');
    //         } catch (Exception $e) {
    //             $msg=str_replace("'", " ", $e->getMessage()) ;
    //             Toastr::error($msg, 'Failed');
    //             return redirect()->back();
    //         }
    //    }

    public function deleteSubattributes(Request $request, $id)
    {
        try {

            $sub_attribute_info = SubAttribute::leftjoin('attributes', 'attributes.id', '=', 'sub_attributes.attributes_id')
                ->where('sub_attributes.id', $id)
                ->first();
            // return $sub_attribute_info->field_name;


            $tables = Item::where($sub_attribute_info->field_name, $id)->first();
            // return $tables;
            try {
                if ($tables == null) {

                    $delete_query = SubAttribute::find($id);
                    $delete_query->delete();

                    Toastr::success('Succsesfully Deleted!', 'Success');
                    return redirect()->back();
                } else {
                    $msg = 'This data already used in tables, Please remove those data first';
                    Toastr::error($msg, 'Failed');
                    return redirect()->back();
                }
            } catch (\Illuminate\Database\QueryException $e) {

                $msg = 'This data already used in tables, Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /* *********************  END SUB ATTRIBUTE  *************************  */


    /* ********************* START  FEE TYPE *************************  */
    public function fee_type()
    {
        try {
            $data['fee'] = BuyerFeeType::all();
            return view('backend.buyer_fee.fee_type', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function fee_typeStore(Request $request)
    {
        $request->validate([
            'name' => "required|string|unique:buyer_fee_types,name",
            'active_status' => "required|",
        ]);
        try {
            $store = new BuyerFeeType();
            $store->name = $request->name;
            $store->slug = Str::slug($request->name, '_');
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Fee Type Added !', 'Success');
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
    function editfee_type($id)
    {
        try {
            $data['fee'] = BuyerFeeType::all();
            $data['edit'] = BuyerFeeType::find($id);
            return view('backend.buyer_fee.fee_type', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function updatefee_type(Request $request)
    {
        $request->validate([
            'name' => "required|string|",
            'active_status' => "required|",
        ]);
        try {
            $store = BuyerFeeType::find($request->id);

            $store->name = $request->name;
            $store->slug = Str::slug($request->name, '_');
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Fee Type updated !', 'Success');
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
    function deletefee_type($id)
    {
        try {
            $data = BuyerFeeType::find($id);
            $data->delete();
            Toastr::success('Succsesfully Fee Type deleted !', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /* *********************  END FEE TYPE  *************************  */

    /* ********************* START  REVIEW TYPE *************************  */
    public function review_type()
    {
        try {
            $data['fee'] = ReviewType::all();
            return view('backend.review.review_type', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function review_typeStore(Request $request)
    {
        $request->validate([
            'name' => "required|string|unique:review_types,name",
            'active_status' => "required|",
        ]);
        try {
            $store = new ReviewType();
            $store->name = $request->name;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Review Type Added !', 'Success');
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
    function editreview_type($id)
    {
        try {
            $data['fee'] = ReviewType::all();
            $data['edit'] = ReviewType::find($id);
            return view('backend.review.review_type', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function updatereview_type(Request $request)
    {
        $request->validate([
            'name' => "required|string|unique:review_types,name," . $request->id,
            'active_status' => "required|",
        ]);
        try {
            $store = ReviewType::find($request->id);

            $store->name = $request->name;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Fee Type updated !', 'Success');
                return redirect()->route('admin.review_type');
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
    function deletereview_type($id)
    {
        try {
            $data = ReviewType::find($id);
            $data->delete();
            Toastr::success('Succsesfully Fee Type deleted !', 'Success');
            return redirect()->route('admin.review_type');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /* *********************  END FEE TYPE  *************************  */


    /* ********************* START  FEE *************************  */
    public function fee()
    {
        try {
            $data['fee'] = BuyerFee::all();
            $data['fee_type'] = BuyerFeeType::where('status', 1)->get();
            $data['user'] = User::where('role_id', '!=', 1)->where('status', 1)->where('access_status', 1)->get();
            return view('backend.buyer_fee.fee', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function feeStore(Request $request)
    {
        $this->validate($request, [
            'user_id' => "required|unique:buyer_fees,user_id",
            'fee' => "required|",
            'type' => "required|",
            'active_status' => "required|",
        ]);

        try {
            $store = new BuyerFee();
            $store->fee = $request->fee;
            $store->user_id = $request->user_id;
            $store->type = $request->type;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully fee Added !', 'Success');
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
            $data['fee'] = BuyerFee::all();
            $data['edit'] = BuyerFee::find($id);
            $data['fee_type'] = BuyerFeeType::where('status', 1)->get();
            $data['user'] = User::where('role_id', '!=', 1)->get();
            return view('backend.buyer_fee.fee', compact('data'));
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
            'type' => "required|",
        ]);

        try {
            $store = BuyerFee::find($request->id);
            $store->fee = $request->fee;
            $store->user_id = $request->user_id;
            $store->type = $request->type;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully fee updated !', 'Success');
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
    function deletefee($id)
    {
        try {
            $data = BuyerFee::find($id);
            $data->delete();
            Toastr::success('Succsesfully fee deleted !', 'Success');
            return redirect()->route('admin.fee');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    /* *********************  END FEE  *************************  */
}
