<?php

namespace App\Http\Controllers\Backend;

use App\Models\Item;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Balance;
use App\Models\Profile;
use App\Models\Userlog;
use App\Models\TableList;
use App\Models\BalanceSheet;
use App\Models\ReCaptchaSetting;
use App\Models\RegistrationBonus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    // Start vendor
    function vendor()
    {
        try {
            $user = User::where('role_id', 4)->latest()->get();
            $data['item'] = Item::where(['active_status' => 1, 'status' => 1, 'free' => 0])->orderBy('id', 'desc')->get();
            return view('backend.vendor.vendor_list', compact('user', 'data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function vendor_view($id)
    {
        try {
            $data = User::findOrFail($id);
            return view('backend.vendor.vendor_View', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function vendor_edit($id)
    {
        try {
            $data = User::findOrFail($id);
            return view('backend.vendor.vendorEdit', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function vendor_update(Request $r, $id)
    {
        $this->validate($r, [
            'username' => 'required|string|unique:users,username,' . $id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'sometimes|nullable|string',
            'company_name' => 'sometimes|nullable|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'date_of_birth' => 'sometimes|nullable|date',
            'date_of_joining' => 'sometimes|nullable|date',
            'mobile' => 'sometimes|nullable|',
            'image' => 'sometimes|nullable|mimes:jpeg,jpg,png|max:2048|dimensions:width=100,height=100',

        ]);
        try {
            $user = User::findOrFail($id);
            $user->username = $r->username;
            $user->email = $r->email;
            $user->save();
            $data = $user->profile;
            $data->user_id = $id;
            $data->first_name = $r->first_name;
            $data->last_name = $r->last_name;
            $data->address = $r->address;
            $data->company_name = $r->company_name;
            $data->dob = date('Y-m-d', strtotime($r->date_of_birth));
            $data->date_of_joining = date('Y-m-d', strtotime($r->date_of_joining));
            $data->mobile = $r->mobile;
            $data->marital_status = $r->marital_status;
            // $data->image = $r->image;
            $data->save();

            if ($r->hasFile('image')) {
                $file = $r->file('image');
                $images = Image::make($file)->insert($file);
                $pathImage = 'public/uploads/admin/';
                if (!file_exists($pathImage)) {
                    mkdir($pathImage, 0777, true);
                    $name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $images->save('public/uploads/vendor/' . $name);
                    $imageName = 'public/uploads/vendor/' . $name;
                    $data->image =  $imageName;
                } else {
                    $name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    File::delete($data->image);
                    $images->save('public/uploads/vendor/' . $name);
                    $imageName = 'public/uploads/vendor/' . $name;
                    $data->image =  $imageName;
                }
                $data->save();
            }

            Toastr::success('Succsesfully author updated !', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function statusChange($id)
    {
        try {
            $data = User::findOrFail($id);
            $url = route('admin.status_changed', $id);
            $title = 'Are You Sure to Change The Status?';
            if ($data->status == 1) {
                $action = 'Inactive';
            } else {
                $action = 'Active';
            }
            return view('backend.delete_modal', compact('url', 'title', 'action'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function loginAccessPermission(Request $request)
    {
        try {
            if ($request->status == 'on') {
                $status = 1;
            } else {
                $status = 0;
            }


            $user = User::find($request->id);
            $user->access_status = $status;
            $user->save();

            return response()->json($request->id);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function userApprove(Request $request)
    {
        try {
            if ($request->status == 'on') {
                $status = 1;
            } else {
                $status = 0;
            }


            $user = User::find($request->id);
            $user->status = $status;
            $user->save();
            return response()->json($request->id);
        } catch (Exception $e) {
            return response()->json('Something went wrong ! try again');
        }
    }

    function statusChanged($id)
    {
        try {
            $data = User::findOrFail($id);
            if ($data->status == 1) {
                $data->status = 0;
            } else {
                $data->status = 1;
            }
            $data->save();
            return redirect()->back()->with('message-success', TRUE);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function vendorDelete($id)
    {

        try {
            $data = User::findOrFail($id);
            $url = route('admin.vendorDeleted', $id);
            $title = 'Are You Sure to Delete This Author?';
            $action = 'Delete';
            return view('backend.delete_modal', compact('url', 'title', 'action'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    // function vendorDeleted($id)
    // {
    //     try {
    //         $data = User::find($id);
    //         // $data->access_status = 0;
    //         // $data->save();
    //         $data->delete();
    //         Toastr::success('Succsesfully vendor deleted !', 'Success');
    //         return redirect()->back();
    //     } catch (Exception $e) {
    //         $msg=str_replace("'", " ", $e->getMessage()) ;
    //         Toastr::error($msg, 'Failed');
    //         return redirect()->back();
    //     }
    // }


    public function vendorDeleted(Request $request, $id)
    {
        // return $id;
        try {
            $tables = TableList::getTableFullName('user_id', $id);
            $tables1 = TableList::getTableFullName('vendor_id', $id);
            $tables_list = $tables . ',' . $tables1;
            $all_tables = str_replace(', ,', '', $tables_list);
            $table_array = explode(', ', $all_tables);
            // return  $table_array;
            try {

                // if (in_array('items',$table_array)) {
                //     return "vendor";
                // }else{
                //     return "deleted";

                // }
                if (in_array('items', $table_array)) {
                    $vendor = User::find($id);
                    $vendor->status = 0;
                    $vendor->access_status = 0;
                    $vendor->save();

                    Toastr::success('Succsesfully Disabled!', 'Success');
                } else {
                    DB::beginTransaction();



                    $balance = Balance::where('user_id', $id)->delete();
                    $profile = Profile::where('user_id', $id)->delete();
                    $vendor = Vendor::where('user_id', $id)->delete();
                    $user_log = Userlog::where('user_id', $id)->delete();

                    $user = User::find($id)->delete();
                    // $delete_query->delete();

                    DB::commit();
                    Toastr::success('Succsesfully Deleted!', 'Success');
                }


                return redirect('humanresource/user-list');
            } catch (\Illuminate\Database\QueryException $e) {
                // dd($e);
                $msg = 'This User already used in ' . $all_tables . ' tables, Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect('humanresource/user-list');
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect('humanresource/user-list');
        }
    }
    // End vendor
    // Start customer
    function customer()
    {
        try {
            $user = User::where('role_id', 5)->latest()->get();
            return view('backend.customer.customer_list', compact('user'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function customer_view($id)
    {
        try {
            $data = User::findOrFail($id);
            $affiliate = $data->referrals;
            return view('backend.customer.customer_View', compact('data', 'affiliate'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function customer_edit($id)
    {
        try {
            $data = User::findOrFail($id);
            return view('backend.customer.customerEdit', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function affiliateView($username)
    {
        try {
            $data = User::where('username', $username)->first();
            return view('backend.affiliate.affiliate_view', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function customer_update(Request $r, $id)
    {
        $this->validate($r, [
            'username' => 'required|string|unique:users,username,' . $id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'sometimes|nullable||string',
            // 'company_name' => 'sometimes|nullable|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'required|date',
            // 'mobile' => 'required|',
            // 'marital_status' => 'sometimes|nullable|string',
            // 'image' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2000|dimensions:width=100,height=100',

        ]);
        try {
            $user = User::findOrFail($id);
            $user->username = $r->username;
            $user->email = $r->email;
            $user->save();
            $data = $user->profile;
            $data->user_id = $id;
            $data->first_name = $r->first_name;
            $data->last_name = $r->last_name;
            $data->address = $r->address;
            $data->company_name = $r->company_name;
            $data->dob = date('Y-m-d', strtotime($r->date_of_birth));
            $data->date_of_joining = date('Y-m-d', strtotime($r->date_of_joining));
            $data->mobile = $r->mobile;
            $data->marital_status = $r->marital_status;
            $data->save();
            if ($r->hasFile('image')) {
                $file = $r->file('image');
                $images = Image::make($file)->insert($file);
                $pathImage = 'public/uploads/customer/';
                if (!file_exists($pathImage)) {
                    mkdir($pathImage, 0777, true);
                    $name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $images->save('public/uploads/customer/' . $name);
                    $imageName = 'public/uploads/customer/' . $name;
                    $data->image =  $imageName;
                } else {
                    $name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    File::delete($data->image);
                    $images->save('public/uploads/customer/' . $name);
                    $imageName = 'public/uploads/customer/' . $name;
                    $data->image =  $imageName;
                }
                $data->save();
            }

            Toastr::success('Succsesfully customer updated !', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function CustomerstatusChange($id)
    {
        try {
            $data = User::findOrFail($id);
            $url = route('admin.status_changed', $id);
            $title = 'Are You Sure to Change The Status?';
            if ($data->status == 1) {
                $action = 'Inactive';
            } else {
                $action = 'Active';
            }
            return view('backend.delete_modal', compact('url', 'title', 'action'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function CustomerstatusChanged($id)
    {
        try {
            $data = User::findOrFail($id);
            if ($data->status == 1) {
                $data->status = 0;
            } else {
                $data->status = 1;
            }
            $data->save();
            return redirect()->back()->with('message-success', TRUE);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function customerDelete($id)
    {
        try {
            $data = User::findOrFail($id);
            $url = route('admin.customerDeleted', $id);
            $title = 'Are You Sure to Delete This Customer?';
            $action = 'Delete';
            return view('backend.delete_modal', compact('url', 'title', 'action'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    // function customerDeleted($id)
    // {
    //     try {
    //         $data = User::find($id);
    //         // $data->access_status = 0;
    //         // $data->save();
    //         $data->delete();
    //         Toastr::success('Succsesfully customer deleted !', 'Success');
    //         return redirect()->back();
    //     } catch (Exception $e) {
    //         $msg=str_replace("'", " ", $e->getMessage()) ;
    //         Toastr::error($msg, 'Failed');
    //         return redirect()->back();
    //     }
    // }

    public function customerDeleted(Request $request, $id)
    {
        try {
            $tables = TableList::getTableList('user_id', $id);
            try {
                if ($tables == null) {

                    $delete_query = User::find($id);
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
    // End customer
    // Start Agent
    function agent()
    {
        try {
            $user = User::where('role_id', 2)->latest()->get();
            return view('backend.agent.agent_list', compact('user'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function agent_view($id)
    {


        try {
            $data = User::findOrFail($id);
            $affiliate = $data->referrals;
            return view('backend.agent.agent_View', compact('data', 'affiliate'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function agent_edit($id)
    {
        try {
            $data = User::findOrFail($id);
            return view('backend.agent.agentEdit', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function agent_update(Request $r, $id)
    {
        $this->validate($r, [
            'username' => 'required|string|unique:users,username,' . $id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'sometimes|nullable||string',
            'company_name' => 'sometimes|nullable|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'required|date',
            'mobile' => 'required|',
            'marital_status' => 'sometimes|nullable|string',
            'image' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048|dimensions:width=100,height=100',

        ]);
        try {
            $user = User::findOrFail($id);
            $user->username = $r->username;
            $user->email = $r->email;
            $user->full_name = $r->first_name . ' ' . $r->last_name;
            $user->save();
            $data = $user->profile;
            $data->user_id = $id;
            $data->first_name = $r->first_name;
            $data->last_name = $r->last_name;
            $data->address = $r->address;
            $data->company_name = $r->company_name;
            $data->dob = date('Y-m-d', strtotime($r->date_of_birth));
            $data->date_of_joining = date('Y-m-d', strtotime($r->date_of_joining));
            $data->mobile = $r->mobile;
            $data->marital_status = $r->marital_status;
            $image = "";
            if ($r->file('image') != "") {
                $file = $r->file('image');
                $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/customer/', $image);
                $image = 'public/uploads/customer/' . $image;
                $data->image = $image;
            }
            $data->save();
            // if ($r->hasFile('image')) {
            //     $file = $r->file('image');
            //     $images = Image::make($file)->insert($file);
            //     $pathImage = 'public/uploads/customer/';
            //     if (!file_exists($pathImage)) {
            //         mkdir($pathImage, 0777, true);
            //         $name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            //         $images->save('public/uploads/customer/' . $name);
            //         $imageName = 'public/uploads/customer/' . $name;
            //         $data->image =  $imageName;
            //     } else {
            //         $name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            //         File::delete($data->image);
            //         $images->save('public/uploads/customer/' . $name);
            //         $imageName = 'public/uploads/customer/' . $name;
            //         $data->image =  $imageName;
            //     }
            //     $data->save();
            // }

            Toastr::success('Succsesfully Agent updated !', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function agentstatusChange($id)
    {
        try {
            $data = User::findOrFail($id);
            $url = route('admin.status_changed', $id);
            $title = 'Are You Sure to Change The Status?';
            if ($data->status == 1) {
                $action = 'Inactive';
            } else {
                $action = 'Active';
            }
            return view('backend.delete_modal', compact('url', 'title', 'action'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function agentstatusChanged($id)
    {
        try {
            $data = User::findOrFail($id);
            if ($data->status == 1) {
                $data->status = 0;
            } else {
                $data->status = 1;
            }
            $data->save();
            return redirect()->back()->with('message-success', TRUE);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function agentDelete($id)
    {
        try {
            $data = User::findOrFail($id);
            $url = route('admin.agentDeleted', $id);
            $title = 'Are You Sure to Delete This Agent?';
            $action = 'Delete';
            return view('backend.delete_modal', compact('url', 'title', 'action'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    // function agentDeleted($id)
    // {
    //     try {
    //         $data = User::find($id);
    //         // $data->access_status = 0;
    //         // $data->save();
    //         $data->delete();
    //         Toastr::success('Succsesfully Agent deleted !', 'Success');
    //         return redirect()->back();
    //     } catch (Exception $e) {
    //         $msg=str_replace("'", " ", $e->getMessage()) ;
    //         Toastr::error($msg, 'Failed');
    //         return redirect()->back();
    //     }
    // }

    public function agentDeleted(Request $request, $id)
    {
        try {
            $tables = TableList::getTableList('user_id', $id);
            try {
                if ($tables == null) {

                    $delete_query = User::find($id);
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
    // End Agent

    // start admin

    function profile($id)
    {
        try {
            if (Auth::user()->id == $id) {
                $data = User::findOrFail($id);
                return view('backend.admin.profile', compact('data'));
            } else {
                Toastr::warning('Wrong URL', 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function profile_edit($id)
    {
        try {
            if (Auth::user()->id == $id) {
                $data = User::findOrFail($id);
                return view('backend.admin.profileEdit', compact('data'));
            } else {
                Toastr::warning('Wrong URL', 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function profile_update(Request $r, $id)
    {
        $this->validate($r, [
            'username' => 'required|string|unique:users,username,' . $id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'company_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'required|date',
            'mobile' => 'required|',
            'image' => 'sometimes|nullable||mimes:jpeg,jpg,png|max:2000|dimensions:width=100,height=100',

        ]);
        try {
            $user = User::findOrFail($id);
            $user->username = $r->username;
            $user->email = $r->email;
            $user->save();

            $data = $user->profile;
            $data->user_id = $id;
            $data->first_name = $r->first_name;
            $data->last_name = $r->last_name;
            $data->address = $r->address;
            $data->company_name = $r->company_name;
            $data->dob = date('Y-m-d', strtotime($r->date_of_birth));
            $data->date_of_joining = date('Y-m-d', strtotime($r->date_of_joining));
            $data->mobile = $r->mobile;
            $data->marital_status = $r->marital_status;
            $data->save();

            if ($r->hasFile('image')) {
                $file = $r->file('image');
                $images = Image::make($file)->insert($file);
                $pathImage = 'public/uploads/admin/';
                if (!file_exists($pathImage)) {
                    mkdir($pathImage, 0777, true);
                    $name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $images->resize(100, 100);
                    $images->save('public/uploads/admin/' . $name);
                    $imageName = 'public/uploads/admin/' . $name;
                    $data->image =  $imageName;
                } else {
                    $name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    if (file_exists($data->image)) {
                        File::delete($data->image);
                    }
                    $images->resize(100, 100);
                    $images->save('public/uploads/admin/' . $name);
                    $imageName = 'public/uploads/admin/' . $name;
                    $data->image =  $imageName;
                }
                $data->save();
            }
            Toastr::success('Succsesfully profile updated !', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    function userLog()
    {
        try {
            $data['log'] = Userlog::select('user_id')->distinct('user_id')->get();
            $data['userlog'] = [];
            foreach ($data['log'] as $userId) {
                $user = Userlog::where('user_id', $userId->user_id)->orderBy('id', 'desc')->first();
                array_push($data['userlog'], $user);
            }
            return view('backend.userlog.index', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function userLogDelete($id)
    {

        try {
            $data = Userlog::findOrFail($id)->delete();


            Toastr::success('User log delete!', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function logout()
    {
        auth()->logout();
        return  redirect('/login');
    }

    public function registrationBonus()
    {

        $data['bonus'] = RegistrationBonus::orderBy('id', 'desc')->get();
        return view('backend.registration_bonus.fee', compact('data'));
    }

    public function registrationBonusStore(Request $request)
    {
        $this->validate($request, [
            'bonus' => "required|",
            'type' => 'required|string|unique:registration_bonuses,type,',
            'active_status' => "required|",
        ]);

        try {
            $store = new RegistrationBonus();
            $store->bonus = $request->bonus;
            $store->type = $request->type;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully  bonus Added !', 'Success');
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

    public function editregistrationBonus($id)
    {
        try {
            $data['bonus'] = RegistrationBonus::all();
            $data['edit'] = RegistrationBonus::find($id);
            return view('backend.registration_bonus.fee', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function updateregistrationBonus(Request $request)
    {
        $request->validate([
            'bonus' => "required|",
            'type' => 'required|string|unique:registration_bonuses,type,' . $request->id,
        ]);

        try {
            $store = RegistrationBonus::find($request->id);
            $store->bonus = $request->bonus;
            $store->type = $request->type;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully bonus updated !', 'Success');
                return redirect()->route('admin.registrationBonus');
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
    function deleteregistrationBonus($id)
    {
        try {
            $data = RegistrationBonus::find($id);
            $data->delete();
            Toastr::success('Succsesfully bonus deleted !', 'Success');
            return redirect()->route('admin.registrationBonus');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function reCaptcha()
    {
        try {
            $data['re_captcha'] = ReCaptchaSetting::orderBy('id', 'desc')->get();
            return view('backend.re_captcha.index', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function reCaptchaStore(Request $request)
    {
        $this->validate($request, [
            'title' => "required|string",
            'type' => 'required|string|unique:re_captcha_settings,type,',
            'active_status' => "required|",
        ]);

        try {
            $store = new ReCaptchaSetting();
            $store->title = $request->title;
            $store->type = $request->type;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully  reCaptcha Added !', 'Success');
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

    public function editreCaptcha($id)
    {
        try {
            $data['re_captcha'] = ReCaptchaSetting::all();
            $data['edit'] = ReCaptchaSetting::find($id);
            return view('backend.re_captcha.index', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function updatereCaptcha(Request $request)
    {
        $request->validate([
            'sitekey' => "required|",
            'secretkey' => "required|",
            'title' => "required|",
            'type' => 'required|string|unique:re_captcha_settings,type,' . $request->id,
            'active_status' => "required|",
        ]);

        try {
            $path = base_path('.env');
            $key = 'NOCAPTCHA_SITEKEY';
            $value = $request->sitekey;
            if (file_exists($path)) {

                file_put_contents($path, str_replace(
                    $key . '=' . env($key),
                    $key . '=' . $value,
                    file_get_contents($path)
                ));
            }
            $key = 'NOCAPTCHA_SECRET';
            $value = $request->secretkey;
            if (file_exists($path)) {

                file_put_contents($path, str_replace(
                    $key . '=' . env($key),
                    $key . '=' . $value,
                    file_get_contents($path)
                ));
            }

            $store = ReCaptchaSetting::find($request->id);
            $store->title = $request->title;
            $store->sitekey = $request->sitekey;
            $store->secretkey = $request->secretkey;
            $store->type = $request->type;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully reCaptcha updated !', 'Success');
                return redirect()->route('admin.reCaptcha');
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
    function StatusreCaptcha(Request $request)
    {
        try {
            if ($request->status == 'on') {
                $status = 1;
            } else {
                $status = 2;
            }


            $user = ReCaptchaSetting::find($request->id);
            $user->status = $status;
            $user->save();
            return response()->json($request->all());
        } catch (Exception $e) {
            return response()->json('Something went wrong ! try again');
        }
    }

    function max_sell()
    {
        try {
            $label = array();
            $name = array();
            $amount = array();
            $years = date("Y") - 5;
            $sellers = BalanceSheet::where('balance_sheets.created_at', 'LIKE', '%' . date('Y') . '%')->distinct('author_id')->take(5)->get();
            foreach ($sellers as $val) {

                for ($i = $years; $i <= date("Y"); $i++) {
                    $SellerSum = DB::table('users')
                        ->leftjoin('balance_sheets', 'users.id', '=', 'balance_sheets.author_id')
                        ->where('balance_sheets.author_id', '=', $val->author_id)
                        ->where('balance_sheets.created_at', 'LIKE', '%' . $i . '%')
                        ->sum('balance_sheets.price');
                    $myUserName[] = $val->GetUser->username;
                    $myUsers[$val->GetUser->username][$i] = $SellerSum;
                    $nameList[$val->GetUser->username] = $val->GetUser->username;
                    $myYears[$i] = $i;
                }
            }
            $sum['myYears'] = $myYears;
            $sum['Amounts'] = $myUsers;
            $sum['UserName'] = $nameList;

            return response()->json($sum);
        } catch (Exception $e) {
            return response()->json($e);
            return response()->json('Something went wrong ! try again');
        }
    }


    public function updatePassowrd()
    {
        try {
            $user = User::find(Auth::id());
            return view('backend.admin.password_update', compact('user'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function updatePassowrdStore(Request $request)
    {

        $request->validate([
            'current_password' => "required",
            'new_password'  => "required|same:confirm_password|min:8|different:current_password",
            'confirm_password'  => 'required|min:8'
        ]);

        try {
            $user = Auth::user();
            if (Hash::check($request->current_password, $user->password)) {

                $user->password = Hash::make($request->new_password);
                $result = $user->save();

                if ($result) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            } else {
                Toastr::error('Current password not match!', 'Failed');
                \Session::flash('password-error', 'Current password not match');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
