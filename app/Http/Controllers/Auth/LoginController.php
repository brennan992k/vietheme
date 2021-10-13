<?php

namespace App\Http\Controllers\Auth;

use App\Models\SocialLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Balance;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Throwable;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';




    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm()
    {

        return view('auth.sign_in');
    }


    protected function authenticated(Request $request, $user)
    {
        if (Config::get('app.app_sync') == false) {
            $reCaptcha = DB::table('re_captcha_settings')->first();
            if ($reCaptcha->status == 1) {
                $recaptcha = $request->input('g-recaptcha-response');
                if ($recaptcha == '') {
                    Auth::logout();
                    Toastr::error('Recaptcha required');
                    return redirect()->back();
                }
            }
        }

        if ($user->access_status == 0) {
            Auth::logout();
            Toastr::error('You are suspended!');
            return redirect()->back();
        }
        if (!$user->hasVerifiedEmail()) {
            Toastr::error('You are not verified! Please verify first');
            return redirect($this->redirectTo);
        }
        userlog($user->id);
    }

    public function handleProviderCallback($provider)
    {

        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/login');
        }

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        if (Auth::check()) {
            if (!Auth::user()->password) {
                Session::put('get_id', Auth::user()->id);
                Auth::logout();
                return view('auth.social_register');
            } else {
                Auth::login($authUser, true);
                return redirect($this->redirectTo);
            }
        } else {

            return redirect()->back();
        }
    }


    public function findOrCreateUser($providerUser, $provider)
    {
        try {
            $account = SocialLogin::whereProviderName($provider)
                ->whereProviderId($providerUser->getId())
                ->first();

            if ($account) {
                return $account->user;
            } else {
                $user = User::whereEmail($providerUser->getEmail())->first();

                if (!$user) {
                    $user = User::create([
                        'email' => $providerUser->getEmail(),
                        'username'  => $providerUser->getName(),
                        'role_id'  => Session::get('role_id'),
                        'email_verified_at' => Carbon::now(),
                    ]);
                    $profile = new Profile();
                    $profile->user_id = $user->id;
                    $profile->save();
                    if ($user->role_id == 4) {
                        $profile = new Vendor();
                        $profile->user_id = $user->id;
                        $profile->save();
                    }
                    if ($user->role_id == 5) {
                        $profile = new Customer();
                        $profile->user_id = $user->id;
                        $profile->save();
                    }
                    $balance = new Balance();
                    $balance->user_id = $user->id;
                    $balance->type    = 1;
                    $balance->amount  = 25;
                    $balance->save();
                }

                $user->identities()->create([
                    'provider_id'   => $providerUser->getId(),
                    'provider_name' => $provider,
                ]);

                return $user;
            }
        } catch (Throwable $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function Password_create()
    {
        return view('auth.social_register');
    }
    function Password_store(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:8'
        ]);
        $user = User::find(Session::get('get_id'));
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::login($user, true);
        return redirect($this->redirectTo);
    }
}
