<?php

namespace Modules\HumanResource\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Balance;
use App\Models\Profile;
use Carbon\Carbon;
use App\RegistrationBonus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HumanResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    function index()
    {
        try {
            $roles = Role::where('id', '!=', Auth::user()->role_id)->where('id', '!=', 3)->where('id', '!=', 1)->get();
            $users = User::where('role_id', '!=', 1)->where('access_status', 1)->get();
            // return $users;
            return view('humanresource::index', compact('users', 'roles'));
        } catch (Exception $e) {
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->back();
        }
    }
    public function add_user()
    {
        try {
            $roles = Role::where('id', '!=', Auth::user()->role_id)->where('id', '!=', 3)->where('id', '!=', 1)->get();
            return view('humanresource::add_user', compact('roles'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        try {
            return view('humanresource::create');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function add_user_store(Request $request)
    {
        $request->validate([
            'role_id' => "required",
            'first_name' => "required",
            'last_name' => "required",
            'username' => "required|unique:users,username",
            'email' => "required|unique:users,email",
            'date_of_joining' => "required",
            'date_of_birth' => "sometimes|nullable",
            'mobile' => "sometimes|nullable",
            'current_address' => "sometimes|nullable",
            'image' => "sometimes|nullable|mimes:jpeg,png,jpg|max:2048|dimensions:width=100,height=100",
        ]);
        // return $request;
        DB::beginTransaction();
        try {
            $Regbonus = RegistrationBonus::where('type', 2)->first();

            $user = new User();
            $user->role_id = $request->role_id;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->password = Hash::make(12345678);
            $user->status = 1;
            $user->access_status = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->first_name = $request->first_name;
            $profile->last_name = $request->last_name;
            $profile->date_of_joining =  date('Y-m-d', strtotime($request->date_of_joining));
            $profile->dob =  date('Y-m-d', strtotime($request->date_of_birth));
            $profile->address = $request->current_address;
            $profile->mobile = $request->mobile;
            $profile->email = $request->email;
            $image = "";
            if ($request->file('image') != "") {
                $file = $request->file('image');
                $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/user/profile/', $image);
                $image = 'public/uploads/user/profile/' . $image;
                $profile->image = $image;
            }
            $profile->save();
            if ($request->role_id == 4 || $request->role_id == 5) {

                $balance = new Balance();
                $balance->user_id = $user->id;
                $balance->type    = 1;
                $balance->amount  = 0;
                $balance->save();
            }

            // if ($request->hasFile('image')) {
            //     $file = $request->file('image');
            //     $images = Image::make($file)->resize(100, 100)->insert($file,'center');

            //     $pathImage = 'public/uploads/user/profile/';
            //     if (!file_exists($pathImage)) {
            //         mkdir($pathImage, 0777, true);
            //         $name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            //         $images->save('public/uploads/user/profile/' . $name);
            //         $imageName = 'public/uploads/user/profile/' . $name;
            //         $profile->image =  $imageName;
            //     } else {
            //         $name =md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            //         $images->save('public/uploads/user/profile/' . $name);
            //         $imageName = 'public/uploads/user/profile/' . $name;
            //         $profile->image =  $imageName;
            //     }
            //     $profile->save();
            // }

            DB::commit();

            Toastr::success('Succsesfully User Created!');
            return redirect()->route('admin.user_list');
        } catch (Exception $e) {
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->back();
        }
    }
    public function add_user_update(Request $request)
    {
        $request->validate([
            'role_id' => "required",
            'first_name' => "required",
            'last_name' => "required",
            'username' => "required|unique:users,username," . $request->id,
            'email' => "required",
            'date_of_joining' => "required",
            'date_of_birth' => "sometimes|nullable",
            'mobile' => "sometimes|nullable",
            'current_address' => "sometimes|nullable",
            'image' => "sometimes|nullable|mimes:jpeg,png,jpg|max:2048|dimensions:width=100,height=100",
        ]);

        DB::beginTransaction();
        try {
            $Regbonus = RegistrationBonus::where('type', 2)->first();

            $user = User::find($request->id);
            $user->role_id = $request->role_id;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->status = 1;
            $user->access_status = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();
            $profile = $user->profile;
            $profile->user_id = $user->id;
            $profile->first_name = $request->first_name;
            $profile->last_name = $request->last_name;
            $profile->date_of_joining =  date('Y-m-d', strtotime($request->date_of_joining));
            $profile->dob =  date('Y-m-d', strtotime($request->date_of_birth));
            $profile->address = $request->current_address;
            $profile->mobile = $request->mobile;
            $profile->email = $request->email;

            $image = "";
            if ($request->file('image') != "") {
                $file = $request->file('image');
                $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/user/profile/', $image);
                $image = 'public/uploads/user/profile/' . $image;
                $profile->image = $image;
            }

            $profile->save();


            // if ($request->hasFile('image')) {
            //     $file = $request->file('image');
            //     $images = Image::make($file)->resize(100, 100)->insert($file,'center');

            //     $pathImage = 'public/uploads/user/profile/';
            //     if (!file_exists($pathImage)) {
            //         mkdir($pathImage, 0777, true);
            //         $name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            //         $images->save('public/uploads/user/profile/' . $name);
            //         $imageName = 'public/uploads/user/profile/' . $name;
            //         $profile->image =  $imageName;
            //     } else {
            //         $name =md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            //         File::delete($profile->image);
            //         $images->save('public/uploads/user/profile/' . $name);

            //         $imageName = 'public/uploads/user/profile/' . $name;
            //         $profile->image =  $imageName;
            //     }
            //     $profile->save();
            // }

            DB::commit();

            Toastr::success('Succsesfully User update!');
            return redirect()->route('admin.user_list');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function user_edit($id)
    {
        try {
            $roles = Role::where('id', '!=', Auth::user()->role_id)->where('id', '!=', 1)->where('id', '!=', 3)->get();
            $edit = User::find($id);
            return view('humanresource::add_user', compact('roles', 'edit'));
        } catch (Exception $e) {
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->back();
        }
    }
    function user_search(Request $request)
    {
        try {
            $data = User::where('access_status', 1);

            if (isset($request->role_id)) {
                $data = $data->where('role_id', $request->role_id);
            }
            if (isset($request->email)) {
                $data = $data->where('role_id', $request->email);
            }
            if (isset($request->username)) {
                $data = $data->where('role_id', $request->username);
            }
            $users = $data->get();
            $roles = Role::where('id', '!=', Auth::user()->role_id)->where('id', '!=', 3)->where('id', '!=', 1)->get();
            return view('humanresource::index', compact('users', 'roles'));
        } catch (Exception $e) {
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->back();
        }
    }
}
