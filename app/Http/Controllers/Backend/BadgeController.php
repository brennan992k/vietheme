<?php

namespace App\Http\Controllers\Backend;

use App\Models\Badge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class BadgeController extends Controller
{
    function Badge(){
        try {
            $data['badge'] = Badge::where('status',1)->orderBy('id', 'ASC')->get();
            return view('backend.badge.index',compact('data'));
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function badgeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:badges,name,',
            'time' => 'required|string|unique:badges,time,',
            'day' => 'required|string|unique:badges,day,',
            'active_status' => "required|",
            "icon"  => "required|mimes:jpeg,png,jpg|max:2048|dimensions:width=80,height=80",
        ]);
      try {       
       
        $icon = "";
        if ($request->file('icon') != "") {
            $file = $request->file('icon');
            $icon = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

            if (!file_exists('public/uploads/badge')) {
                mkdir('public/uploads/badge', 0777, true);
            }
            $file->move('public/uploads/badge/', $icon);
            $icon = 'public/uploads/badge/' . $icon;
        }
        $store = new Badge();
        $store->name = $request->name;
        $store->day = $request->day;
        $store->time = $request->time;
        $store->icon = $icon;
        $store->status = $request->active_status;
        $result = $store->save();

        if ($result) {
            Toastr::success('Succsesfully Badge Added !','Success');
            return redirect()->back();
        } else {
            Toastr::error('Something went wrong ! try again ','Error');
            return redirect()->back();
        }
      } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
      }
    }

    public function editBadge($id)
    {
        try {
            $data['badge'] = Badge::all();
            $data['edit'] = Badge::find($id);
            return view('backend.badge.index', compact('data'));
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function updatebadge(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:badges,name,' . $request->id,
            'time' => 'required|string|unique:badges,time,' . $request->id,
            'day' => 'required|string|unique:badges,day,' . $request->id,
            'active_status' => "required|",
            "icon"  => "sometimes|required|mimes:jpeg,png,jpg|max:2048|dimensions:width=80,height=80",
        ]);
        try {
            $store = Badge::find($request->id);

            $icon = "";
            if ($request->file('icon') != "") {
                $file = $request->file('icon');
                $icon = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
    
                if (!file_exists('public/uploads/badge')) {
                    mkdir('public/uploads/badge', 0777, true);
                }
                $file->move('public/uploads/badge/', $icon);
                $icon = 'public/uploads/badge/' . $icon;
                // File::delete($store->icon);
            }


            $store->name = $request->name;
            $store->day = $request->day;
            $store->time = $request->time;
            $store->status = $request->active_status;
            if($icon != ""){
                $store->icon = $icon;
            }
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Badge updated !','Success');
                return redirect()->route('admin.badge');
            } else {
                Toastr::error('Something went wrong ! try again ','Error');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }


    }
    function deletebadge($id){
        try {
            $data=Badge::find($id); 
            $data->delete();
            Toastr::success('Succsesfully Badge deleted !','Success');
            return redirect()->route('admin.badge');
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}