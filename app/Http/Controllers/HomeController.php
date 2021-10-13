<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'CheckDashboardMiddleware']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $next)
    {
        try {
            if (@Auth::user()->access_status == 0) {
                Auth::logout();
                Toastr::error('You are suspended!');
                return redirect()->back();
            }
            if (@Auth::user()->role_id == 1) {
                return redirect('admin/dashboard');
            }
            if (@Auth::user()->role_id == 2) {
                return redirect('admin/dashboard');
            }
            if (@Auth::user()->role_id == 5) {

                return redirect('/');
            }
            if (@Auth::user()->role_id == 4) {

                return redirect('/');
            }
            return $next($request);
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }



    function mailverify()
    {
        try {
            return convert_to_inr(10);
            return view('frontend.email.veriry_mail');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
