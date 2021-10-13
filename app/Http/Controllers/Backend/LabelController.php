<?php

namespace App\Http\Controllers\Backend;

use App\Models\Label;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;

class LabelController extends Controller
{
    function label(){

        
        try {
            //code...
            $data['label'] = Label::latest()->get();
            return view('backend.label.index',compact('data'));
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function labelStore(Request $request)
    {
        $request->validate([
            'rate' => 'required|string|unique:labels,rate,',
            'amount' => 'required|string|unique:labels,amount,',
            'active_status' => "required|",
            "icon"  => "required|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=80,max_height=80",
        ]);

      try {  

        $icon = "";
        if ($request->file('icon') != "") {
            $file = $request->file('icon');
            $icon = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

            if (!file_exists('public/uploads/label')) {
                mkdir('public/uploads/label', 0777, true);
            }
            $file->move('public/uploads/label/', $icon);
            $icon = 'public/uploads/label/' . $icon;
        }
            $store = new Label();
            $store->user_id = Auth::user()->id;
            $store->rate = $request->rate;
            $store->icon = $icon;
            $store->amount = $request->amount;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Lebel Added !','Success');
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

    public function editlabel($id)
    {
        try {
            $data['label'] = Label::all();
            $data['edit'] = Label::find($id);
            return view('backend.label.index', compact('data'));
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function updatelabel(Request $request)
    {
        $request->validate([
            'rate' => 'required|string|unique:labels,rate,'. $request->id,
            'amount' => 'required|string|unique:labels,amount,'. $request->id,
            'active_status' => "required|",
            "icon"  => "sometimes|required|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=80,max_height=80",
        ]);
        try {
            $store = Label::find($request->id);           
            $icon = "";
            if ($request->file('icon') != "") {
                $file = $request->file('icon');
                $icon = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
    
                if (!file_exists('public/uploads/label')) {
                    mkdir('public/uploads/label', 0777, true);
                }
   
                $file->move('public/uploads/label/', $icon);
                $icon = 'public/uploads/label/' . $icon;
                // if (file_exists($store->icon)) {
                //     File::delete($store->icon);
                // }
            }

            $store->rate = $request->rate;
            $store->amount = $request->amount;
            $store->status = $request->active_status;
            if($icon != ""){
                $store->icon = $icon;
            }
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Lebel updated !');
                return redirect()->route('admin.label');
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
    function deletelabel($id){
        try {
            $data=Label::find($id);
            // if ($data->icon != 'public/uploads/label/icon/icon-0.png') {
            //     File::delete($data->icon);
            // }
            $data->delete();
            Toastr::success('Succsesfully Lebel deleted !');
            return redirect()->route('admin.label');
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}