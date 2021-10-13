<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Refund;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Support;
use App\Models\Follower;
use App\Models\SocialIcon;
use App\Models\SpnCountry;
use App\Models\BankDeposit;
use App\Models\PaymentMethod;
use App\Models\SmNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Pages\Entities\InfixProfileSetting;
use Modules\Systemsetting\Entities\InfixEmailSetting;
use Throwable;

class CustomerController extends Controller
{

    function profile($username)
    {
        try {
            $data['user'] = User::where('username', $username)->first();

            $data['profile'] = route('customer.profile', $data['user']->username);
            $data['socila_icons'] = SocialIcon::where('user_id', Auth::user()->id)->first();
            return $this->vendor($data);
        } catch (Exception $e) {

            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function downloads($username)
    {
        try {
            $data['user'] = User::where('username', $username)->first();

            @$data['download'] = route('customer.downloads', $data['user']->username);
            $data['socila_icons'] = SocialIcon::where('user_id', Auth::user()->id)->first();
            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function affiliate()
    {
        try {
            if (Auth::check()) {
                $data['user'] = User::where('id', Auth::user()->id)->first();
                $data['affiliate'] = $data['user']->referrals()->paginate(8);
            }
            return view('frontend.user.affiliate_list', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function setting()
    {
        try {

            $data['user'] = User::find(Auth::user()->id);
            $data['setting'] = route('customer.setting', @Auth::user()->username);
            $data['socila_icons'] = SocialIcon::where('user_id', Auth::user()->id)->first();

            return $this->vendor($data);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public  function socialStore(request $request)
    {
        // return "New";
        try {
            $social = new SocialIcon();
            $social->user_id = Auth::user()->id;
            $social->behance = $request->behance;
            $social->deviantart = $request->deviantart;
            $social->digg = $request->digg;
            $social->dribbble = $request->dribbble;
            $social->facebook = $request->facebook;
            $social->flickr = $request->flickr;
            $social->github = $request->github;
            $social->google_plus = $request->google_plus;
            $social->lastfm = $request->lastfm;
            $social->linkedin = $request->linkedin;
            $social->reddit = $request->reddit;
            $social->soundcloud = $request->soundcloud;
            $social->thumblr = $request->thumblr;
            $social->twitter = $request->twitter;
            $social->vimeo = $request->vimeo;
            $social->youtube = $request->youtube;
            $result = $social->save();

            if ($result) {
                Toastr::success('Social Media Information Changed Successfully', 'Success');
                if (Auth::user()->role_id == 4) {
                    return redirect()->route('author.setting', Auth::user()->id . '?social_updated');
                } else {
                    return redirect()->route('customer.setting', Auth::user()->username . '?social_updated');
                }
            } else {
                Toastr::error('Something went wrong ! try again ', 'Error');
                if (Auth::user()->role_id == 4) {
                    return redirect()->route('author.setting', Auth::user()->id . '?social_updated');
                } else {
                    return redirect()->route('customer.setting', Auth::user()->username . '?social_updated');
                }
            }
        } catch (Throwable $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            if (Auth::user()->role_id == 4) {
                return redirect()->route('author.setting', Auth::user()->id . '?social_updated');
            } else {
                return redirect()->route('customer.setting', Auth::user()->username . '?social_updated');
            }
        }
    }
    public  function socialUpdate(request $request)
    {
        try {
            $social = SocialIcon::where('user_id', Auth::user()->id)->first();
            $social->behance = $request->behance;
            $social->deviantart = $request->deviantart;
            $social->digg = $request->digg;
            $social->dribbble = $request->dribbble;
            $social->facebook = $request->facebook;
            $social->flickr = $request->flickr;
            $social->github = $request->github;
            $social->google_plus = $request->google_plus;
            $social->lastfm = $request->lastfm;
            $social->linkedin = $request->linkedin;
            $social->reddit = $request->reddit;
            $social->soundcloud = $request->soundcloud;
            $social->thumblr = $request->thumblr;
            $social->twitter = $request->twitter;
            $social->vimeo = $request->vimeo;
            $social->youtube = $request->youtube;
            $result = $social->save();

            if ($result) {
                Toastr::success('Social Media Information Changed Successfully', 'Success');
                if (Auth::user()->role_id == 4) {
                    return redirect()->route('author.setting', Auth::user()->id . '?social_updated');
                } else {
                    return redirect()->route('customer.setting', Auth::user()->username . '?social_updated');
                }
            } else {
                Toastr::error('Something went wrong ! try again ', 'Error');
                if (Auth::user()->role_id == 4) {
                    return redirect()->route('author.setting', Auth::user()->id . '?social_updated');
                } else {
                    return redirect()->route('customer.setting', Auth::user()->username . '?social_updated');
                }
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            if (Auth::user()->role_id == 4) {
                return redirect()->route('author.setting', Auth::user()->id . '?social_updated');
            } else {
                return redirect()->route('customer.setting', Auth::user()->username . '?social_updated');
            }
        }
    }
    function vendor($data = null)
    {
        try {
            $refunds = [];
            $refund_order = Refund::where('user_id', Auth::user()->id)->where('status', 1)->get();
            foreach ($refund_order as $key => $refund) {
                $refunds[] = $refund->item_id;
            }
            $data['country'] = SpnCountry::all();
            $data['order'] = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(6);
            $data['refund_order'] = Refund::where('user_id', Auth::user()->id)->where('status', 1)->get();
            $data['refunds'] = $refunds;
            $data['profile_setting'] = InfixProfileSetting::where('active_status', 1)->first();
            return view('frontend.vendor.dashboard', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function personalUpdate(Request $r, $id)
    {
        $this->validate($r, [
            'first_name' => 'sometimes|nullable|string',
            'last_name' => 'sometimes|nullable|string',
            'email' => 'required|unique:users,email,' . $r->id,
            'company_name' => 'sometimes|nullable|string',
            'address' => 'sometimes|nullable|string',
            'country_id' => 'sometimes|nullable|integer',
            // 'state_id' => 'sometimes|nullable|integer',
            // 'city_id' => 'sometimes|nullable|integer',
            'mobile' => 'sometimes|nullable|string',
            'zipcode' => 'sometimes|nullable|integer',
            'image' => 'sometimes|nullable|mimes:jpeg,jpg,png|max:80000',

        ]);
        try {
            $user = User::findOrFail($id);
            $user->email = $r->email;
            $user->save();

            $data = $user->profile;
            $data->user_id = $id;
            $data->first_name = $r->first_name;
            $data->last_name = $r->last_name;
            $data->mobile = $r->mobile;
            if ($r->company_name != "") {
                $data->company_name = $r->company_name;
            }
            if ($r->zipcode != "") {
                $data->zipcode = $r->zipcode;
            }
            if ($r->address != "") {
                $data->address = $r->address;
            }
            if ($r->country_id != "") {
                $data->country_id = $r->country_id;
            }
            if ($r->state_id != "") {
                $data->state_id = $r->state_id;
            }
            if ($r->city_id != "") {
                $data->city_id = $r->city_id;
            }
            $data->save();

            Toastr::success('Succsesfully profile updated yes!', 'Success');
            return redirect()->route('customer.setting', Auth::user()->username);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->route('customer.setting', Auth::user()->username);
        }
    }

    function commentStore(Request $r)
    {
        $this->validate($r, [
            'body' => 'required|string'
        ]);
        DB::beginTransaction();
        try {
            $data = new Comment();
            $data->user_id = Auth::user()->id;
            $data->body = $r->body;
            $data->item_id = $r->item_id;
            $data->save();
            $author = Item::find($r->item_id);
            $body = DB::table('email_templates')->select('product_comment')->first();
            $to_name = @$author->user->username;
            $to_email = @$author->user->email;
            if (@Adminmailsetting(@$author->user->id)->item_comment == 1) {
                $data_info['message'] = @$body->product_comment;
                $email_sms_title = 'Product comment';
                MailNotification($data_info, $to_name, $to_email, $email_sms_title);
            }
            DB::commit();
            $comment = 1;
            Toastr::success('Comment sent!', 'Success');
            return redirect('item/' . $author->title . '/' . $author->id . '?comment');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function replyStore(Request $r)
    {
        $this->validate($r, [
            'body' => 'required|string'
        ]);
        DB::beginTransaction();
        try {
            $data = new Comment();
            $data->user_id = Auth::user()->id;
            $data->body = $r->body;
            $data->item_id = $r->item_id;
            $data->parent_id = $r->parent_id;
            $data->save();
            $author = Comment::find($r->parent_id);
            $body = DB::table('email_templates')->select('product_comment')->first();
            $to_name = @$author->user->username;
            $to_email = @$author->user->email;
            if (@Adminmailsetting(@$author->user->id)->item_comment == 1) {
                $data_info['message'] = @$body->product_comment;
                $email_sms_title = 'Product comment reply';
                MailNotification($data_info, $to_name, $to_email, $email_sms_title);
            }
            DB::commit();
            Toastr::success('Reply sent!', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function ReviewStore(Request $r)
    {
        $this->validate($r, [
            'comment' => 'required|string|max:1000',
            'rating' => 'required|',
            'review_type' => 'required|',
        ]);
        DB::beginTransaction();
        try {
            // $order_id=ItemOrder::where('item_id',$r->item_id)->where('user_id',Auth::user()->id)->first();
            $vendor = Item::find($r->item_id);
            $data = new Review();
            $data->user_id = Auth::user()->id;
            $data->vendor_id = $vendor->user_id;
            $data->body = $r->comment;
            $data->item_id = $r->item_id;
            $data->order_id = $r->order_id;
            $data->review_type = $r->review_type;
            $data->rating = $r->rating;
            $data->save();

            $total_star = 0;
            foreach ($vendor->reviews as $key => $value) {
                $total_star = $total_star + $value->rating;
            }
            $rate = $total_star / count($vendor->reviews);
            $vendor->rate = $rate;
            $vendor->save();
            $body = DB::table('email_templates')->select('rating', 'product_review_by_buyer')->first();
            $author = DB::table('users')->where('id', $vendor->user_id)->select('username', 'email')->first();
            $to_name = @$author->username;
            $to_email = @$author->email;
            if (@mailsetting()->rating == 1) {
                $data_info['message'] = @$body->rating;
                $email_sms_title = 'Product rating';
                MailNotification($data_info, $to_name, $to_email, $email_sms_title);
            }
            if (@mailsetting()->buyer_review == 1) {
                $data_info['message'] = $r->comment;
                $email_sms_title = 'Buyer product review';
                MailNotification($data_info, $to_name, $to_email, $email_sms_title);
            }
            DB::commit();
            Toastr::success('Thank you for review!', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function UserSupport(Request $r)
    {
        $this->validate($r, [
            'message' => 'required|string|max:5000'
        ]);
        try {
            $item = Item::find($r->item_id);
            $vendor_id = $item->user->id;
            $vendor_email = $item->user->email;
            $data = new Support();
            $data->user_id = Auth::user()->id;
            $data->message = $r->message;
            $data->item_id = $r->item_id;
            $data->save();

            $receiver_email = $item->user->email;
            $receiver_name = $item->user->full_name;
            $sender_email = Auth::user()->email;
            $title = 'User Support Mail';

            // $message='Mail From: ';
            // \Mail::to($receiver_info->email)->send(new FundMail($fund_info,$receiver_info));

            // Mail::send('frontend.email.support_mail', ['title' => $title, 'content' => $r->message,
            //  'item_id' => $item->id, 'item_title' =>  strtolower(str_replace(' ', '_', $item->title))], 
            //  function ($message) use ($receiver_email, $receiver_name) {
            //     $message->to($receiver_email,$receiver_name);
            //     $message->from(Auth::user()->email, Auth::user()->username);

            // });

            $settings = InfixEmailSetting::first();
            $reciver_email = $item->user->email;
            $receiver_name =  $item->user->full_name;
            $subject = 'User Support Mail';
            $view = "frontend.email.support_mail";
            $compact['data'] =  array(
                'title' => $title, 'content' => $r->message,
                'item_id' => $item->id, 'item_title' =>  strtolower(str_replace(' ', '_', $item->title))
            );
            // return $compact;
            @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);

            Toastr::success('Mail Sent Successfully', 'Success');
            return redirect('item/' . $item->title . '/' . $item->id . '?mail-sent');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function UserFollow($profileId)
    {
        $user = User::where('username', $profileId)->first();
        if (CheckFollow(Auth::user()->id, $user->id)) {
            return response()->json(['error' => 'Already followed this user']);
        }
        if (!$user) {
            return response()->json(['error' => 'User does not exist.']);
        }
        $data = new Follower();
        $data->leader_id = $user->id;
        $data->follower_id = Auth::user()->id;
        $data->save();
        return response()->json(['success' => 'Successfully followed the user.']);
    }
    public function UserUnfollow($profileId)
    {
        $user = User::where('username', $profileId)->first();
        if (!$user) {
            return response()->json(['error' => 'User does not exist.']);
        }
        $user->followers()->detach(auth()->user()->id);
        return response()->json(['success' => 'Successfully Unfollowed the user.']);
    }


    function AddPayment(Request $r)
    {
        $r->validate([
            'name' => 'required',
            'card_number' => 'required|max:16',
            'cvc' => 'required',
            'exp_mm' => 'required|min:2|max:2',
            'exp_yy' => 'required|min:4|max:4' . (date('Y') + 1),
        ]);
        DB::beginTransaction();
        try {

            $store = PaymentMethod::updateOrCreate(['user_id' => Auth::id()]);
            $store->user_id = Auth::user()->id;
            $store->card_number = $r->card_number;
            $store->name = $r->name;
            $store->role = Auth::user()->role_id;
            $store->cvc = $r->cvc;
            $store->exp_mm = $r->exp_mm;
            $store->exp_yy = $r->exp_yy;

            $result = $store->save();
            DB::commit();
            if ($result) {
                Toastr::success('Card is waiting for admin approval', 'Success');
                return redirect()->route('customer.setting', Auth::user()->username . '?card_updated');
            } else {
                Toastr::error('Something went wrong ! try again ', 'Success');
                return redirect()->route('customer.setting', Auth::user()->username . '?card_updated');
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->route('customer.setting', Auth::user()->username . '?card_updated');
        }
    }

    function DeletePayment()
    {
        try {
            $data = PaymentMethod::where(['user_id' => Auth::id(), 'role' => Auth::user()->role_id])->first();
            if (@$data->count() > 0) {
                $data->delete();
                Toastr::success('Operation succses', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Something went wrong ! try again ', 'Error');
                return redirect()->back();
            }
            Toastr::success('Operation succses', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function password_update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password|min:6|different:current_password',
            'confirm_password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {

            $user = Auth::user();
            if (Hash::check($request->current_password, $user->password)) {

                $user->password = Hash::make($request->new_password);
                $result = $user->save();

                if ($result) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->route('customer.setting', Auth::user()->username);
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->route('customer.setting', Auth::user()->username);
                }
            } else {
                Toastr::error('Current password not match!', 'Failed');
                return redirect()->route('customer.setting', Auth::user()->username);
            }
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('customer.setting', Auth::user()->username);
        }
    }

    public function bank_payment(Request $request)
    {

        $bank_validator = Validator::make($request->all(), [
            'bank_name' => 'required',
            'owner_name' => 'required',
            'account_number' => 'required',
            'amount' => 'required|numeric|min:0',
        ]);
        if ($bank_validator->fails()) {
            return redirect()->back()
                ->withErrors($bank_validator)
                ->withInput();
        }
        try {
            $diposit = new BankDeposit();
            $diposit->bank_name = $request->bank_name;
            $diposit->owner_name = $request->owner_name;
            $diposit->account_number = $request->account_number;
            $diposit->amount = $request->amount;
            $diposit->depositor_id = Auth::user()->id;
            $diposit->save();

            $notification = new SmNotification();
            $notification->user_id = Auth::user()->id;
            $notification->message = Auth::user()->username . ' Request a Bank Deposit';
            $notification->link = url('admin/deposit-request-noti', @$diposit->id);
            $notification->ticket_id = $diposit->id;
            $notification->received_id = 1;
            $notification->save();

            Toastr::success('Deposite added, Waiting for admin approval', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
