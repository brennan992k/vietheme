<?php

namespace App\Http\Controllers\Backend;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
  function couponFee(){
    try {
      //code...
    } catch (Throwable $th) {
      //throw $th;
    }
  }

  public function couponList(){
    try {
      $data['coupon'] = Coupon::where('vendor_id', Auth::user()->id)->where('status',1)->get();
      return view('backend.coupon.coupon_list', compact('data'));

    } catch (Exception $e) {
      $msg=str_replace("'", " ", $e->getMessage()) ;
      Toastr::error($msg, 'Failed');
      return redirect()->back();
  }
  }
    function index(){
        try {
            $data['coupon'] = Coupon::where('status', 1)->get();
            return view('backend.coupon.index', compact('data'));
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
      }

      function couponStore(Request $r){
                $this->validate($r,[
                  // 'min_price' =>'required|',
                  'coupon_code' =>'required|string|unique:coupons,coupon_code',
                  'coupon_type' =>'required|',
                  'discount_type' =>'required|',
                  'discount' =>'required',
                  // 'min_price' =>'required|',
                  'active_status' =>'required|',
                  'from' =>'required|before:to',
                  'to' =>'required|after:from'
              ]);
              try {           
              $data =new Coupon();
              $data ->vendor_id   = Auth::user()->id;
              // $data ->min_price   = $r->min_price;
              $data ->discount_type    = $r->discount_type;
              $data ->discount    = $r->discount;
              $data ->coupon_type        = $r->coupon_type;
              $data ->coupon_code        = $r->coupon_code;
              $data ->from  = date('y-m-d',strtotime($r->from));
              $data ->to  = date('y-m-d',strtotime($r->to));
              $data ->status  = $r->active_status;
              $data->save();
              Toastr::success('Succsesfully coupon added !','Success');
              return redirect()->back();
            } catch (Exception $e) {
              $msg=str_replace("'", " ", $e->getMessage()) ;
              Toastr::error($msg, 'Failed');
              return redirect()->back();
          }
  
      }
      function couponUpdate(Request $r){
                $this->validate($r,[
                  // 'min_price' =>'required|',
                  'coupon_code' =>'required|string',
                  'coupon_type' =>'required|',
                  'discount_type' =>'required|',
                  'discount' =>'required',
                  // 'min_price' =>'required|',
                  'active_status' =>'required|',
                  'from' =>'required|before:to',
                  'to' =>'required|after:from'
              ]);

              $check_coupon=Coupon::where('coupon_code',$r->coupon_code)->where('id','!=',$r->id)->first();
              if ($check_coupon) {
                Toastr::error('This code already exist', 'Failed');
                return redirect()->route('admin.coupon-list');
              }
              try {           
              $data =Coupon::find($r->id);
              $data ->vendor_id   = Auth::user()->id;
              // $data ->min_price   = $r->min_price;
              $data ->discount_type    = $r->discount_type;
              $data ->discount    = $r->discount;
              $data ->coupon_type        = $r->coupon_type;
              $data ->coupon_code        = $r->coupon_code;
              $data ->from  = date('y-m-d',strtotime($r->from));
              $data ->to  = date('y-m-d',strtotime($r->to));
              $data ->status  = $r->active_status;
              $data->save();
              Toastr::success('Succsesfully coupon added !','Success');
              return redirect()->route('admin.coupon-list');
            } catch (Exception $e) {
              $msg=str_replace("'", " ", $e->getMessage()) ;
              Toastr::error($msg, 'Failed');
              return redirect()->back();
          }
  
      }
      public function couponEdit($id){
        try {
          $data['edit'] = Coupon::find($id);
          $data['coupon'] = Coupon::where('vendor_id', Auth::user()->id)->where('status',1)->get();

          return view('backend.coupon.coupon_list', compact('data'));
    
        }catch (Exception $e) {
          $msg=str_replace("'", " ", $e->getMessage()) ;
          Toastr::error($msg, 'Failed');
          return redirect()->back();
      }
    }
    function deletecoupon($id){
        try {
          $data['coupon'] = Coupon::find($id)->update(['status'=>0]);
          Toastr::success('Coupon deleted successfully','Success');
          return redirect()->back();
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
      }
}