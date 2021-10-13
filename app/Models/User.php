<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Ticket\Entities\InfixTicket;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role_id', 'email_verified_at', 'referrer_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['referral_link'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function identities()
    {
        return $this->hasMany(SocialLogin::class);
    }

    public function item()
    {
        return $this->hasMany(Item::class);
    }

    public function coupon()
    {
        return $this->hasMany(Coupon::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function CountItem($category = null, $sub = null)
    {
        if (isset($sub) && isset($category)) {
            $data = Item::where('category_id', $category)->where('sub_category_id', $sub)->where('active_status', 1)->where('status', 1)->count();
            return $data;
        }
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'leader_id', 'follower_id')->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'leader_id')->withTimestamps();
    }

    function followfind()
    {
        return $this->hasOne(Follower::class, 'follower_id');
    }
    
    function buyPackage()
    {
        return $this->hasMany(BuyPackage::class, 'user_id', 'id');
    }

    function itemOrder()
    {
        return $this->hasMany(ItemOrder::class, 'user_id', 'id')->orderBy('id', 'desc');
    }

    function AuthorOrder()
    {
        return $this->hasMany(ItemOrder::class, 'author_id', 'id')->orderBy('id', 'desc');
    }

    function itemRefund()
    {
        return $this->hasMany(Refund::class, 'author_id', 'id');
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }
    
    public function payment_method()
    {
        return $this->hasOne(PaymentMethod::class, 'user_id', 'id')->where('status', 1);
    }

    public function credit_card()
    {
        return $this->hasOne(PaymentMethod::class, 'user_id', 'id');
    }

    public function payment_methods()
    {
        return $this->hasMany(PaymentMethod::class, 'user_id', 'id');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }

    public function getReferralLinkAttribute()
    {
        return $this->referral_link = route('customer.registration', ['ref' => $this->username]);
    }

    public function paid_payment()
    {
        return $this->hasOne(PaidPayment::class, 'user_id', 'id');
    }

    public function payoutSetup()
    {
        return $this->hasOne(AuthorPayoutSetup::class, 'user_id', 'id');
    }

    public function paid_vendor()
    {
        return $this->hasMany(PaidVendor::class, 'user_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'vendor_id', 'id');
    }

    public function agent_ticket()
    {
        return $this->hasMany(InfixTicket::class, 'user_agent');
    }

    function CheckPaymnent($id)
    {
        $d = PaidVendor::where('user_id', $id)->whereMonth('created_at', Carbon::now()->month)->orderBy('created_at', 'desc')->first();
        return $d;
    }

    public function sendPasswordResetNotification($token)
    {
        $data = [
            $this->email
        ];
        if (!$token) {
            return redirect()->route('password.request');
        }

        $reciver_email = $data[0];
        $receiver_name =  $this->username;
        $subject = 'Reset Password';
        $view = "mail.password_mail";
        $compact['data'] =  array('username' => $this->username, 'reset_url' => route('password.reset', $token));
        // return $compact;
        @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);
    }
}
