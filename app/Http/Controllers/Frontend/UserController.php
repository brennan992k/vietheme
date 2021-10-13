<?php

namespace App\Http\Controllers\Frontend;

use File;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function profilePic(Request $r, $id)
    {
        $r->validate([
            'profile_pic' => "sometimes|nullable|max:2048",
            'backgroud_pic' => "sometimes|nullable",
            'about' => 'sometimes|nullable|string',
        ]);
        try {
            $user = User::findOrFail($id);
            $data = $user->profile;
            $data->about = $r->about;

            $profile_pic = "";
            if ($r->file('profile_pic') != "") {
                $file = $r->file('profile_pic');
                $profile_pic = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/user/profile/', $profile_pic);
                $profile_pic = 'public/uploads/user/profile/' . $profile_pic;
                $data->image = $profile_pic;
            }
            $backgroud_pic = "";
            if ($r->file('backgroud_pic') != "") {
                $file = $r->file('backgroud_pic');
                $backgroud_pic = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/user/logo/', $backgroud_pic);
                $backgroud_pic = 'public/uploads/user/logo/' . $backgroud_pic;
                $data->logo_pic = $backgroud_pic;
            }

            $data->save();

            Toastr::success('Succsesfully profile updated !');
            if (Auth::user()->role_id == 4) {
                return redirect()->route('author.setting', $id . '?profile_updated');
            } else {
                return redirect()->route('customer.setting', Auth::user()->username . '?profile_updated');
            }
            // return redirect()->route('author.setting', $id.'?profile_updated');
            // return redirect()->route('author.setting', $id);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            if (Auth::user()->role_id == 4) {
                return redirect()->route('author.setting', $id . '?profile_updated');
            } else {
                return redirect()->route('customer.setting', Auth::user()->username . '?profile_updated');
            }
        }
    }
}
