<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function CustomerForgetPasswordForm()
    {

        return view('auth.customer_forget_password');
    }

    public function showLinkRequestForm()
    {
        return view('auth.forget_password');
    }


    public function CustomerForgetPassword(Request $request)
    {
        $request->validate([
            'email' => "email|required|string|",
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        Session::put('email', $request->email);
        set_time_limit(300);
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)->with('message-success', 'Please check your e-mail')
            : $this->sendResetLinkFailedResponse($request, $response);
    }
}
