<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Item;
use App\Models\Review;
use App\Models\Comment;
use App\Models\ItemFee;
use App\Models\Profile;
use App\Models\BuyerFee;
use App\Models\ItemView;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class ItemController extends Controller
{
    function singleProduct(Request $r,$title,$id){
        

//        $s= Item::with('attribute')->find($id);
        try{
            $data['comment'] = Comment::where('item_id',$id)->orderBy('id','desc')->get();
            // return $data['comment'];
            $data['review'] = Review::where('item_id',$id)->orderBy('id','desc')->get();
            $data['item'] = Item::find($id);
            $data['attributes'] = $data['item']->attribute;
            $item_support=DB::table('item_supports')->first();
            $totalRate =DB::table('reviews')->where('item_id', $data['item']->id)->get();
            $rate5 =DB::table('reviews')->where('item_id', @$data['item']->id)->whereBetween('rating',[4.5,5])->get();
            $rate4 =DB::table('reviews')->where('item_id', $data['item']->id)->whereBetween('rating',[3.5,4])->get();
            $rate3 =DB::table('reviews')->where('item_id', $data['item']->id)->whereBetween('rating',[2.5,3])->get();
            $rate2 =DB::table('reviews')->where('item_id', @$data['item']->id)->whereBetween('rating',[1.5,2])->get();
            $rate1 =DB::table('reviews')->where('item_id', $data['item']->id)->whereBetween('rating',[.5,1])->get();
            
            if (isset($data['item']->user->balance->amount)) {
                $level=DB::table('labels')->where('amount','<=',@$data['item']->user->balance->amount)->orderBy('id','desc')->first();
            } else {
                $level='';
            }
            $date=Carbon::parse(Carbon::now())->diffInDays($data['item']->user->created_at);
            $comment = DB::table('comments')->where('status',1)->where('item_id',@$data['item']->id)->count();
            $badge=DB::table('badges')->where('day','<=',@$date)->orderBy('id','desc')->first();
            if ($data['item']->status == 0) {
                return redirect('/');
            }
            
            $lio = ItemView::where(['item_id' => $id,'user_ip' => $r->getClientIp()])->first();
            if (!empty($lio)) {        
                $now = Carbon::now();
                $diffHours =  $lio->updated_at->diffInHours($now);
                if ($diffHours >= 24) {

                    $viewIp=ItemView::find($lio->id);
                    $viewIp->updated_at = $now;
                    $viewIp->save();
                    $item=Item::find($id);
                    $item->views = $item->views+1;
                    $item->save();
                }
            }
            else {
                $view =new ItemView();
                $view->item_id = $id;
                $view->user_ip = $r->getClientIp();
                $view->save();
                $item=Item::find($id);
                $item->views = $item->views+1;
                $item->save();         
            
            }
            $data['fees']=ItemFee::where('category_id',$data['item']->category_id)->first();
            // return $data['item']->category_id;
            $data['BuyerFee'] = BuyerFee::where('status',1)->where('type',1)->first();

            if ($data['item']->C_total!=null) {
                return view('frontend.pages.singleitem', compact('data','totalRate','rate5','rate4','rate3','rate2','rate1','item_support','level','badge','comment'));
      
            } else {
                return view('frontend.pages.singleitem_2', compact('data','totalRate','rate5','rate4','rate3','rate2','rate1','item_support','level','badge','comment'));
      
            }
            
            // $order_checks = ItemOrder::where('item_id',$id)->where('user_id',Auth::user()->id)->get();
            // return view('frontend.pages.singleitem', compact('data','totalRate','rate5','rate4','rate3','rate2','rate1','item_support','level','badge','comment'));
        }catch (Exception $e) {
            dd($e);
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();  
        }
    }
    function AddCart(Request $request){
        // return $request;
        try { 
           /*  foreach (Cart::content() as $key => $value) {
                 if ($request->id == $value->id) {
                    Toastr::info('Already added this item');
                     return redirect()->back();
                 }
            } */

             $item=Item::find($request->id);

             if (Auth::check() && $item->user_id == Auth::user()->id) {
                Toastr::warning('You cannot buy your own product.','Warning');
                return redirect()->back();
             }
             if ($request->license_type == 2) {
                $buyer_fee = $item->E_buyer;
             }else {
                 $buyer_fee = $item->Re_buyer;
             }   
             if (Auth::user()) {
                $profile_data=Profile::join('taxes','taxes.country_id','=','profiles.country_id')
                ->where('user_id',Auth::user()->id)->first();
             $totalVal=$request->item_price+$request->BuyerFee;
             
                if ($profile_data) {
                    $tax=($totalVal*$profile_data->tax/100);
                    $tax_added=1;
                } else {
                    $tax=0.00;
                    $tax_added=0;
                }
             }else{
                $tax=0.00;
                $tax_added=0;
             }
             Cart::add(['id' => bin2hex(random_bytes(4)), 'name' => $request->item_name, 'qty' => 1, 'price' => $request->item_price+$tax, 'weight' => 0, 'options' => 
             ['support_charge' => $request->BuyerFee,'license_type'=>$request->license_type,'support_time'=>$request->support_time,'buyer_fee'=>$buyer_fee,'item_id'=>$request->id,
             'description'=>$request->description,'user_id'=>$request->user_id,'username'=>$request->username,'icon'=>$item->icon, 'image'=>$request->image,'Extd_percent'=>$request->Extd_percent,'tax_added'=>$tax_added,'tax'=>$tax]]);
             Toastr::success('Item added to your cart','Success');
            return redirect()->back();
            } catch (Exception $e) {
                $msg=str_replace("'", " ", $e->getMessage()) ;
                Toastr::error($msg, 'Failed');
                return redirect()->back(); 
            } 
    }
    function QuickAddCart(Request $request){
        // return $request;
        try { 
           /*  foreach (Cart::content() as $key => $value) {
                 if ($request->id == $value->id) {
                    Toastr::info('Already added this item');
                     return redirect()->back();
                 }
            } */
             $item=Item::find($request->id);
             if (Auth::check() && $item->user_id == Auth::user()->id) {
                Toastr::warning('You cannot buy your own product.','Warning');
                return redirect()->back();
             }
             if ($request->license_type == 2) {
                $buyer_fee = $item->E_buyer;
             }else {
                 $buyer_fee = $item->Re_buyer;
             }   
             if (Auth::user()) {
                $profile_data=Profile::join('taxes','taxes.country_id','=','profiles.country_id')
                ->where('user_id',Auth::user()->id)->first();
             $totalVal=$request->item_price+$request->BuyerFee;
             
                if ($profile_data) {
                    $tax=($totalVal*$profile_data->tax/100);
                    $tax_added=1;
                } else {
                    $tax=0.00;
                    $tax_added=0;
                }
             }else{
                $tax=0.00;
                $tax_added=0;
             }
             Cart::add(['id' => bin2hex(random_bytes(4)), 'name' => $request->item_name, 'qty' => 1, 'price' => $request->item_price+$tax, 'weight' => 0, 'options' => 
             ['support_charge' => $request->BuyerFee,'license_type'=>$request->license_type,'support_time'=>$request->support_time,'buyer_fee'=>$buyer_fee,'item_id'=>$request->id,
             'description'=>$item->description,'user_id'=>$request->user_id,'username'=>$request->username,'icon'=>$item->icon, 'image'=>$item->thumbnail,'Extd_percent'=>$request->Extd_percent,'tax_added'=>$tax_added,'tax'=>$tax]]);
             Toastr::success('Item added to your cart','Success');
            return redirect()->back();
            } catch (Exception $e) {
                // dd($e);
                $msg=str_replace("'", " ", $e->getMessage()) ;
                Toastr::error($msg, 'Failed');
                return redirect()->back(); 
            } 
    }

    function AddBuy(Request $request){
        try { 
            $totalVal= floatval(str_replace("$","",$request->totalVal));
                $item=Item::find($request->_item_id);
                if (Auth::check() && $item->user_id == Auth::user()->id) {
                    Toastr::warning('You cannot buy your own product.','Warning');
                    return redirect()->back();
                }
                if (@$request->support_Fee) {
                    $support_Fee=$request->support_Fee;
                    $license_type = 1;
                    $support_time = 2;
                }else {
                    $support_Fee = 0;
                    $license_type = 1;
                    $support_time = 1;
                }
                $buyer_fee = $item->Re_buyer;
               if (Auth::user()) {
                    $profile_data=Profile::join('taxes','taxes.country_id','=','profiles.country_id')
                    ->where('user_id',Auth::user()->id)->first();
                    if ($profile_data) {
                        $tax=($totalVal*$profile_data->tax/100);
                        $tax_added=1;
                    } else {
                        $tax=0.00;
                        $tax_added=0;
                    }
                 }else{
                    $tax=0.00;
                    $tax_added=0;
                 }
               
               
                
                // return  $tax;
               
            //    $cart= Cart::add(['id' =>  bin2hex(random_bytes(4)), 'name' => $item->title, 'qty' => 1, 'price' => $totalVal+$request->support_Fee, 'weight' => 0, 'options' => 
            //         ['support_charge' => $support_Fee,'license_type'=>$license_type,'support_time'=>$support_time,'buyer_fee'=>$buyer_fee,'item_id'=>$request->_item_id,
            //         'description'=>$item->description,'user_id'=>$item->user_id,'username'=>$item->user->username,'icon'=>$item->icon,'image'=>$item->thumbnail,'Extd_percent'=>$request->_item_percent]]);
               Cart::add(['id' =>  bin2hex(random_bytes(4)), 'name' => $item->title, 'qty' => 1, 'price' => $totalVal+$tax, 'weight' => 0, 'options' => 
                    ['support_charge' => $support_Fee,'license_type'=>$license_type,'support_time'=>$support_time,'buyer_fee'=>$buyer_fee,'item_id'=>$request->_item_id,
                    'description'=>$item->description,'user_id'=>$item->user_id,'username'=>$item->user->username,'icon'=>$item->icon,'image'=>$item->thumbnail,'Extd_percent'=>$request->_item_percent,'tax_added'=>$tax_added,'tax'=>$tax]]);
               
                    return redirect()->route('Cart');
            } catch (Exception $e) {
                
                $msg=str_replace("'", " ", $e->getMessage()) ;
                Toastr::error($msg, 'Failed');
                return redirect()->back(); 
            }
       
    }
    
    function Cart(){
        try { 
            return view('frontend.cart.cart');
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back(); 
        } 
    }
    function CartDelete($rowId){
        try { 
              Cart::remove($rowId); 
              Toastr::success('Cart item delete','Deleted');
               return redirect()->back();
            } catch (Exception $e) {
                $msg=str_replace("'", " ", $e->getMessage()) ;
                Toastr::error($msg, 'Failed');
                return redirect()->back(); 
            } 
    }
    function CartUpdate(Request $request,$rowId){
        try { 
            $data = Cart::get($rowId);            
            $item = Cart::update($rowId,['id' => bin2hex(random_bytes(4)), 'name' => $data->name, 'qty' => 1, 'price' => $request->total, 'weight' => 0, 'options' => 
             ['support_charge' => $request->support_charge,'license_type'=>$data->options['license_type'],'support_time'=>$request->support_time,'buyer_fee'=>$data->options['buyer_fee'],'item_id'=>$data->options['item_id'],
             'description'=>$data->options['description'],'user_id'=>$data->options['user_id'],'username'=>$data->options['username'],'image'=>$data->options['image'],'Extd_percent'=>$request->Extd_percent]]);
             $all_item = Cart::content();
            return response()->json(['item' => $item,'all_item' => $all_item],200);
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back(); 
        } 
    }

    function CartDeleteAll(){
        try { 
            Cart::destroy();
            Toastr::success('Cart item Empty now');
            return redirect('/');
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back(); 
        } 
    }

}