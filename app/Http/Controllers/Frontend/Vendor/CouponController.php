<?php

namespace App\Http\Controllers\Frontend\Vendor;
use App\Models\Coupon;
use App\Models\BuyerFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
class CouponController extends Controller
{
    function index(){
      try {
      //   if (Auth::user()->status == 0) {
      //     Toastr::error('You are not approved yet!', 'Error');
      //     return redirect('/');
      // }
          $data['all'] = route('author.coupon_list',Auth::user()->username);
          return $this->common($data);     
      } catch (Exception $e) {
          $msg=str_replace("'", " ", $e->getMessage()) ;
          Toastr::error($msg, 'Failed');
          return redirect()->back();
    }
    }
    function CouponAdd(){
        try {
          $data['add'] = route('author.CouponAdd');
          return $this->common($data);     
      } catch (Exception $e) {
          $msg=str_replace("'", " ", $e->getMessage()) ;
          Toastr::error($msg, 'Failed');
          return redirect()->back();
      }
    }
    function CouponExpire(){
        try {
          $data['expire'] = route('author.CouponExpire');
          return $this->common($data);     
      } catch (Exception $e) {
          $msg=str_replace("'", " ", $e->getMessage()) ;
          Toastr::error($msg, 'Failed');
          return redirect()->back();
    }
    }
    function CouponInactive(){
        try {
          $data['inactive'] = route('author.CouponInactive');
          return $this->common($data);     
      } catch (Exception $e) {
          $msg=str_replace("'", " ", $e->getMessage()) ;
          Toastr::error($msg, 'Failed');
          return redirect()->back();
    }

    }
    function Coupon_Delete_view(){
        try {
          $data['delete'] = route('author.Coupon_Delete_view');
          return $this->common($data);     
      } catch (Exception $e) {
          $msg=str_replace("'", " ", $e->getMessage()) ;
          Toastr::error($msg, 'Failed');
          return redirect()->back();
      }
    }
   public  function couponStore(Request $r){
      // return $r;
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
    function couponEdit($id){
      try {
          $data['edit'] = Coupon::find($id);
          $data['add'] = route('author.couponEdit',$id);
          return $this->common($data);         
        } catch (Exception $e) {
          $msg=str_replace("'", " ", $e->getMessage()) ;
          Toastr::error($msg, 'Failed');
          return redirect()->back();
      }
    }

    function couponUpdate(Request $r, $id){
          $this->validate($r,[
            // 'min_price' =>'required|',
            'coupon_code' =>'required|string|unique:coupons,coupon_code,'.$id,
            'coupon_type' =>'required|',
            'discount_type' =>'required|',
            'discount' =>'required|integer',
            // 'min_price' =>'required|',
            'active_status' =>'required|',
            'from' =>'required|before:to',
            'to' =>'required|after:from'
        ]);
      try {        
          $data =Coupon::find($id);
          // $data ->min_price   = $r->min_price;
          $data ->discount_type    = $r->discount_type;
          $data ->discount    = $r->discount;
          $data ->coupon_type        = $r->coupon_type;
          $data ->coupon_code        = $r->coupon_code;
          $data ->from  = date('y-m-d',strtotime($r->from));
          $data ->to  = date('y-m-d',strtotime($r->to));
          $data ->status  = $r->active_status;
          $data->save();
          Toastr::success('Succsesfully coupon Updated !','Success');
          return redirect()->route('author.coupon_list',Auth::user()->username);
        } catch (Exception $e) {
          $msg=str_replace("'", " ", $e->getMessage()) ;
          Toastr::error($msg, 'Failed');
          return redirect()->back();
      }

    }
    function couponDelete($id){
      try {
          Coupon::find($id)->update(['status'=>0]);
          Toastr::success('Succsesfully coupon deleted !','Success');
          return redirect()->back();
        } catch (Exception $e) {
          $msg=str_replace("'", " ", $e->getMessage()) ;
          Toastr::error($msg, 'Failed');
          return redirect()->back();
      }
    }
    function couponRestore($id){
      try {
          Coupon::find($id)->update(['status'=>1]);
          Toastr::success('Succsesfully coupon restored !','Success');
          return redirect()->route('author.coupon_list',Auth::user()->username);
        } catch (Exception $e) {
          $msg=str_replace("'", " ", $e->getMessage()) ;
          Toastr::error($msg, 'Failed');
          return redirect()->back();
      }
    }
    function common($data=null){
      try {
        $data['coupon_fee'] = BuyerFee::where('type', 2)->where('user_id',Auth::user()->id)->get();
        $data['coupon'] = Coupon::where('vendor_id', Auth::user()->id)->whereDate('to', '>=', date('y-m-d'))->where('status', 1)->orderBy('id','desc')->paginate(5);
        $data['delete_coupon'] = Coupon::where('vendor_id', Auth::user()->id)->where('status', 0)->paginate(6);
        $data['expired_coupon'] = Coupon::where('vendor_id', Auth::user()->id)->whereDate('to', '<=', date('y-m-d'))->where('status', 1)->paginate(6);
        $data['inactive_coupon'] = Coupon::where('vendor_id', Auth::user()->id)->where('status', 2)->paginate(6);
        return view('frontend.vendor.coupon_list', compact('data'));
      } catch (Exception $e) {
        $msg=str_replace("'", " ", $e->getMessage()) ;
        Toastr::error($msg, 'Failed');
        return redirect()->back();
      }
     
    }
}