<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Systemsetting\Entities\InfixLanguage;

class FrontendLanguageChange extends Controller
{
    public function ajaxLanguageChangeMenu(Request $request)
    {
        try {
            $uni = $request->id;
            if (Auth::check()) {
                $user = User::find(Auth::user()->id);
                $user->lang_id = $request->id;
                $user->save();
            }

            $updateLang = InfixLanguage::where('language_universal', $uni)->first();
            if (Auth::check() && $updateLang->language_universal == 'ar') {
                $user->rtl = 1;
                $user->save();
                session()->put('locale', $updateLang->language_universal);
            } else {
                session()->put('guest_locale', $updateLang->language_universal);
            }



            return response()->json([$updateLang]);
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function changeLocale($locale)
    {
        try {
            // session()->put('locale', $locale);
            if (Auth::check()) {
                session()->put('locale', $locale);
            } else {
                session()->put('guest_locale', $locale);
            }
            // return session()->get('locale');
            App::setLocale($locale);
            //    return  App::getLocale();
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
