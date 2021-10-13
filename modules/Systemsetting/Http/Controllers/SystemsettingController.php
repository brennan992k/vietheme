<?php

namespace Modules\Systemsetting\Http\Controllers;

use App\Models\User;
use Exception;
use App\Models\SpnCountry;
use App\Models\FrontSetting;
use App\Models\SmLanguagePhrase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\Systemsetting\Entities\InfixStyle;
use Modules\Systemsetting\Entities\InfixBackup;
use Modules\Systemsetting\Entities\InfixFooter;
use Modules\Systemsetting\Entities\InfixCurrency;
use Modules\Systemsetting\Entities\InfixLanguage;
use Modules\Systemsetting\Entities\InfixTimeZone;
use Modules\Systemsetting\Entities\InfixDateFormat;
use Modules\Systemsetting\Entities\InfixFooterMenu;
use Modules\Systemsetting\Entities\InfixSeoSetting;
use Modules\Systemsetting\Entities\InfixAllLanguage;
use Modules\Systemsetting\Entities\InfixEmailSetting;
use Modules\Systemsetting\Entities\InfixGeneralSetting;
use Modules\Systemsetting\Entities\InfixBackgroundSetting;
use Modules\Systemsetting\Entities\InfixPaymentGatewaySetting;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;



class SystemsettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function ajaxSelectCurrency(Request $request)
    {

        $select_currency_symbol = InfixCurrency::select('symbol')->where('code', '=', $request->id)->first();

        $currency_symbol['symbol'] = $select_currency_symbol->symbol;
        return response()->json([$currency_symbol]);
    }
    public function general_setting()
    {

        try {
            $data = FrontSetting::where('active_status', 1)->first();
            $infix_general_setting = InfixGeneralSetting::where('infix_general_settings.id', 1)
                ->leftjoin('infix_time_zones', 'infix_time_zones.id', '=', 'infix_general_settings.time_zone_id')
                ->leftjoin('infix_all_languages', 'infix_all_languages.id', '=', 'infix_general_settings.language_id')
                ->first();
            // return  $infix_general_setting;
            return view('systemsetting::general_setting', compact('infix_general_setting', 'data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function edit_general_setting()
    {

        try {
            $editData1 = FrontSetting::where('active_status', 1)->first();
            $infix_general_setting = InfixGeneralSetting::where('infix_general_settings.id', 1)->first();
            $dateFormats = InfixDateFormat::where('active_status', 1)->get();
            $languages   = InfixAllLanguage::all();
            $countries   = SpnCountry::select('currency')->groupBy('currency')->get();
            $currencies  = InfixCurrency::all();
            $time_zones = InfixTimeZone::all();
            $editData = '';
            $footer_setting = InfixFooter::first();
            $edit = '';
            // return $currencies;
            // return view('systemsetting::updateGeneralSettings', compact('infix_general_setting', 'dateFormats', 'editData', 'languages', 'currencies', 'countries', 'languages', 'time_zones','footer_setting', 'edit'));
            return view('systemsetting::updateGeneralSettings', compact('editData1', 'infix_general_setting', 'dateFormats', 'editData', 'languages', 'currencies', 'countries', 'languages', 'time_zones'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function update_general_setting(Request $request)
    {
        // return $request;
        $request->validate([

            // 'category_limit' => 'required',
            'color1' => 'required',
            'color2' => 'required',
            'color3' => 'required',

            'system_name'    => 'required|max:50',
            'system_title'   => 'required|max:50',
            'phone'          => 'required|min:3|max:30',
            'email'          => 'required|min:3|max:100'

        ]);
        try {
            $s = FrontSetting::find($request->id);
            // $s->category_limit = $request->category_limit;
            $s->color1 = $request->color1;
            $s->color2 = $request->color2;
            $s->color3 = $request->color3;
            $s->save();

            $settings = InfixGeneralSetting::find($request->id);
            $settings->system_name = $request->system_name;
            $settings->system_title = $request->system_title;
            $settings->phone = $request->phone;
            $settings->email = $request->email;
            $settings->language_id = $request->language_id;
            $settings->date_format_id = $request->date_format_id;
            $settings->time_zone_id = $request->time_zone;
            $settings->currency = $request->currency;
            $settings->auto_approve = $request->auto_approve;
            $settings->auto_update = $request->auto_update;
            $settings->google_an = $request->google_an;
            $settings->public_vendor = $request->public_vendor;
            $settings->currency_symbol = $request->currency_symbol;
            $settings->address = $request->address;
            $settings->copyright_text = $request->copyright_text;
            $settings->is_s3_host = $request->is_s3_host;
            // return $settings;
            $settings->save();


            $path = base_path() . "/.env";

            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            $envKey = 'APP_NAME';
            $envValue = str_replace(' ', '_', $settings->system_name);
            $str .= "\n";
            $keyPosition = strpos($str, "{$envKey}=");
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
            $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);

            $str = substr($str, 0, -1);
            if (!file_put_contents($envFile, $str)) {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('general_setting');
            // return view('systemsetting::general_setting', compact('infix_general_setting'));

        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function email_setting()
    {
        try {
            $editData = InfixEmailSetting::first();
            $active_mail_driver = InfixGeneralSetting::first('email_driver')->email_driver;
            return view('systemsetting::email_setting_view', compact('editData', 'active_mail_driver'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function updateEmailSettingsData(Request $request)
    {

        if ($request->engine_type == "php") {
            $request->validate([
                'from_name'         => "required",
                'from_email'        => "required|email",
            ]);
        }
        if ($request->engine_type == "smtp") {

            $request->validate([
                'from_name'         => "required",
                'from_email'        => "required|email",
                'mail_password'     => "required",
                'mail_encryption'    => "required",
            ]);

            if (
                $request->mail_username == ''
                || $request->mail_password == ''
                || $request->mail_encryption == ''
                || $request->mail_port == ''
                || $request->mail_host == '' || $request->mail_driver == ''
            ) {
                Toastr::error('All Field in Smtp Details Must Be filled Up', 'Failed');
                return redirect()->back();
            }
        }






        try {
            if ($request->engine_type == "smtp") {


                $key1 = 'MAIL_USERNAME';
                $key2 = 'MAIL_PASSWORD';
                $key3 = 'MAIL_ENCRYPTION';
                $key4 = 'MAIL_PORT';
                $key5 = 'MAIL_HOST';
                $key6 = 'MAIL_MAILER';
                $key7 = 'MAIL_FROM_ADDRESS';

                $value1 = str_replace(" ", "", $request->mail_username);
                $value2 = str_replace(" ", "", $request->mail_password);
                $value3 = str_replace(" ", "", $request->mail_encryption);
                $value4 = str_replace(" ", "", $request->mail_port);
                $value5 = str_replace(" ", "", $request->mail_host);
                $value6 = str_replace(" ", "", $request->mail_driver);
                $value7 = str_replace(" ", "", $request->from_email);

                $path                   = base_path() . "/.env";
                $MAIL_USERNAME          = env($key1);
                $MAIL_PASSWORD          = env($key2);
                $MAIL_ENCRYPTION        = env($key3);
                $MAIL_PORT              = env($key4);
                $MAIL_HOST              = env($key5);
                $MAIL_DRIVER            = env($key6);
                $FROM_MAIL              = env($key7);

                if (file_exists($path)) {
                    file_put_contents($path, str_replace(
                        "$key1=" . $MAIL_USERNAME,
                        "$key1=" . $value1,
                        file_get_contents($path)
                    ));
                    file_put_contents($path, str_replace(
                        "$key2=" . $MAIL_PASSWORD,
                        "$key2=" . $value2,
                        file_get_contents($path)
                    ));
                    file_put_contents($path, str_replace(
                        "$key3=" . $MAIL_ENCRYPTION,
                        "$key3=" . $value3,
                        file_get_contents($path)
                    ));
                    file_put_contents($path, str_replace(
                        "$key4=" . $MAIL_PORT,
                        "$key4=" . $value4,
                        file_get_contents($path)
                    ));
                    file_put_contents($path, str_replace(
                        "$key5=" . $MAIL_HOST,
                        "$key5=" . $value5,
                        file_get_contents($path)
                    ));
                    file_put_contents($path, str_replace(
                        "$key6=" . $MAIL_DRIVER,
                        "$key6=" . $value6,
                        file_get_contents($path)
                    ));
                    file_put_contents($path, str_replace(
                        "$key7=" . $FROM_MAIL,
                        "$key7=" . $value7,
                        file_get_contents($path)
                    ));
                }


                $e = InfixEmailSetting::where('email_engine_type', 'smtp')->first();
                // return $e;
                if (empty($e)) {
                    $e = new InfixEmailSetting();
                }
                $e->from_name         = $request->from_name;
                $e->from_email        = $request->from_email;
                $e->mail_driver     = $request->mail_driver;
                $e->mail_host     = $request->mail_host;
                $e->mail_port       = $request->mail_port;
                $e->mail_username         = $request->mail_username;
                $e->mail_password     = $request->mail_password;
                $e->mail_encryption     = $request->mail_encryption;
                $e->active_status = $request->active_status;
                $results = $e->save();

                if ($request->active_status == 1) {

                    $gs = InfixGeneralSetting::first();

                    $gs->email_driver = "smtp";
                    $gs->save();
                    $phpp = InfixEmailSetting::where('email_engine_type', 'php')->first();

                    $phpp->active_status = 0;
                    $phpp->save();
                }
            }

            if ($request->engine_type == "php") {

                $php = InfixEmailSetting::where('email_engine_type', 'php')->first();

                if (empty($php)) {
                    $php = new InfixEmailSetting();
                }
                $php->from_name         = $request->from_name;
                $php->from_email        = $request->from_email;
                $php->active_status = $request->active_status;
                $results = $php->save();

                if ($request->active_status == 1) {
                    $gs = InfixGeneralSetting::first();
                    $gs->email_driver = "php";
                    $gs->save();
                    $smtp = InfixEmailSetting::where('email_engine_type', 'smtp')->first();
                    $smtp->active_status = 0;
                    $smtp->save();
                }
            }


            //========================

            try {

                $settings = InfixEmailSetting::first();
                $reciver_email = $settings->from_email;
                $receiver_name =  Auth::user()->full_name;
                $subject = 'Email Setup Testing';
                $view = "test_mail";
                $compact['data'] =  array('email' => $settings->from_email, 'name' => Auth::user()->full_name);
                @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);
            } catch (Exception $e) {
                Toastr::error('Email credentials maybe wrong !', 'Failed');
                return redirect()->back();
            }


            //========================
            if ($results) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            // dd($e);
            Toastr::error('Operation Failed,' . $e->getMessage(), 'Failed');
            return redirect()->back();
        }
    }
    public function TestMail(Request $request)
    {
        $request->validate([
            'to_mail'    => 'required',
        ]);
        try {
            $title = 'This is Test Mail';
            // \Mail::to($request->to_mail)->send(new TestMail($title));

            $settings = InfixEmailSetting::first();
            $reciver_email = $settings->from_email;
            $receiver_name =  Auth::user()->full_name;
            $subject = 'Email Setup Testing';
            $view = "test_mail";
            $compact['data'] =  array('email' => $settings->from_email, 'name' => Auth::user()->full_name);
            @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);

            Toastr::success('Mail Send Successfully', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            // dd($e);
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function update_email_setting(Request $request)
    {

        // return $request;

        $request->validate([
            'from_name'    => 'required|max:100',
            // 'from_email'   => 'required|max:100',
            'MAIL_DRIVER'  => 'required|max:100',
            'MAIL_HOST'          => 'required|max:100',
            'MAIL_PORT'    => 'required|max:10',
            'MAIL_USERNAME' => 'required|max:100',
            'MAIL_PASSWORD'   => 'required|max:100',
            'MAIL_ENCRYPTION'       => 'required|max:100'

        ]);
        $data = $request->except('_token', 'url', 'engine_type', 'from_name', 'from_email', 'email_settings_url');


        $formeted_env_key_value = '';
        foreach ($data as $key => $value) {
            $envterms[] = $key;
            $envvalues[] = $value;
            $formeted_env_key_value .= $key . ":" . $value . ',';
            $values[$key] = $value;
        }
        // return  $formeted_env_key_value;
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n";
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) {
            Toastr::error('Operation Failed', 'Failed');
        } else {
            Toastr::success('Operation successful', 'Success');
        }


        $path = base_path() . "/.env";

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $envKey = 'MAIL_FROM_ADDRESS';
        $envValue = $request->MAIL_USERNAME;
        $str .= "\n";
        $keyPosition = strpos($str, "{$envKey}=");
        $endOfLinePosition = strpos($str, "\n", $keyPosition);
        $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) {
            Toastr::error('Operation Failed', 'Failed');
            // return redirect()->back();
        }
        // return $formeted_env_key_value;

        try {
            $email_setting = InfixEmailSetting::find(1);
            $email_setting->from_name = $request->from_name;
            $email_setting->from_email = $request->from_email;
            $email_setting->mail_driver = $request->MAIL_DRIVER;
            $email_setting->mail_host = $request->MAIL_HOST;
            $email_setting->mail_port = $request->MAIL_PORT;
            $email_setting->mail_username = $request->MAIL_USERNAME;
            $email_setting->mail_password = $request->MAIL_PASSWORD;
            $email_setting->mail_encryption = $request->MAIL_ENCRYPTION;
            $result = $email_setting->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                $editData = InfixEmailSetting::find(1);
                return redirect()->route('email-setting');
            } else {
                Toastr::failed('All Filed is required', 'Failed');
                $editData = InfixEmailSetting::find(1);
                return redirect()->route('email-setting');
            }
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    //payment_method_setting

    public function payment_method_setting(Request $request)
    {
        try {
            $payment_methods = InfixPaymentGatewaySetting::all();
            return view('systemsetting::payment_method_setting', compact('payment_methods'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function payment_method_enable($id)
    {
        try {
            $result = InfixPaymentGatewaySetting::find($id)->update(['active_status' => 1]);
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::failed('Sorry ! Someting went wrong', 'Failed');
                return redirect()->route('email-setting');
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function payment_method_disable($id)
    {
        try {
            $result = InfixPaymentGatewaySetting::find($id)->update(['active_status' => 0]);
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::failed('Sorry ! Someting went wrong', 'Failed');
                return redirect()->route('email-setting');
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function payment_method_store(Request $request)
    {

        try {
            $field_name = str_replace(' ', '_', $request->field_name);
            $field_value = str_replace(' ', '_', $request->field_value);
            $env_key_value = array_combine($field_name, $field_value);
            $env_value = json_encode($env_key_value);
            $formeted_env_key_value = "";
            $path = base_path() . "/.env";
            foreach ($env_key_value as $key => $value) {
                $envterms[] = $key;
                $envvalues[] = $value;
                $formeted_env_key_value .= $key . ":" . $value . ',';
                $values[$key] = $value;
            }
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            if (count($values) > 0) {
                foreach ($values as $envKey => $envValue) {
                    $str .= "\n";
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                    $env_value_format = '"' . $envValue . '"';
                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$env_value_format}\n";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$env_value_format}", $str);
                    }
                }
            }
            $str = substr($str, 0, -1);
            if (!file_put_contents($envFile, $str)) {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->route('payment-method-setting');
            }
            $new_payment_method = new InfixPaymentGatewaySetting;
            $new_payment_method->gateway_name = $request->method_name;
            $new_payment_method->is_config_required = $request->is_config_require;
            $new_payment_method->env_terms = $formeted_env_key_value;
            $result = $new_payment_method->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                $payment_methods = InfixPaymentGatewaySetting::all();
                return redirect()->route('payment-method-setting');
                // return view('systemsetting::payment_method_setting', compact('payment_methods'));
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->route('payment-method-setting');
            }
        } catch (Throwable $th) {
            Toastr::error('Operation Failed with Throwable', 'Failed');
            return redirect()->route('payment-method-setting');
        } catch (Exception $e) {
            Toastr::error('Operation Failed with Exception', 'Failed');
            return redirect()->route('payment-method-setting');
        }

        $payment_methods = InfixPaymentGatewaySetting::all();
        return view('systemsetting::payment_method_setting', compact('payment_methods'));
    }
    public function payment_method_delete($id)
    {
        try {
            $payment_method = InfixPaymentGatewaySetting::find($id);
            $payment_method->delete();
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('payment-method-setting');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function payment_method_config(Request $request, $id)
    {

        try {
            $payment_method = InfixPaymentGatewaySetting::find($id);
            $env_terms = $payment_method->env_terms;
            $single_config = explode(",", $env_terms, -1);
            $formeted_env_key_value = "";
            foreach ($single_config as $key => $value) {
                $envterms[] = $key;
                $envvalues[] = $value;
                $formeted_env_key_value .= "" . $key . "=>" . $value . "<br>";
            }
            return view('systemsetting::update_payment_method', compact('payment_method', 'envvalues'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function payment_method_update(Request $request)
    {
        $request->validate([
            'method_name'    => 'required|max:100',
            'field_name'    => 'required|max:100',
            'field_value'   => 'required|max:100',
        ]);

        try {
            $field_name = $request->field_name;
            $field_value = $request->field_value;
            $env_key_value = array_combine($field_name, $field_value);
            $env_value = json_encode($env_key_value);
            $formeted_env_key_value = "";
            $path = base_path() . "/.env";
            foreach ($env_key_value as $key => $value) {
                $envterms[] = $key;
                $envvalues[] = $value;
                $formeted_env_key_value .= $key . ":" . $value . ',';
                $values[$key] = $value;
            }
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            if (count($values) > 0) {
                foreach ($values as $envKey => $envValue) {
                    $str .= "\n";
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                    $env_value_format = '"' . $envValue . '"';
                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$env_value_format}\n";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$env_value_format}", $str);
                    }
                }
            }
            $str = substr($str, 0, -1);
            if (!file_put_contents($envFile, $str)) {
                Toastr::error('Operation Failed', 'Failed');
            } else {
                Toastr::success('Operation successful', 'Success');
            }
            $new_payment_method = InfixPaymentGatewaySetting::find($request->id);
            $new_payment_method->gateway_name = $request->method_name;
            if ($request->mode) {
                $new_payment_method->mode = $request->mode;
            }
            $new_payment_method->is_config_required = $request->is_config_require;
            $new_payment_method->env_terms = $formeted_env_key_value;
            if (empty($request->logo)) {
                $result = $new_payment_method->save();
            } else {
                $logo = "";
                if ($request->file('logo') != "") {
                    $file = $request->file('logo');
                    $logo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

                    if (!file_exists('public/uploads/paymentMethod')) {
                        mkdir('public/uploads/paymentMethod', 0777, true);
                    }
                    $file->move('public/uploads/paymentMethod/', $logo);
                    $logo = 'public/uploads/paymentMethod/' . $logo;
                }
                $new_payment_method->logo = $logo;
                $result = $new_payment_method->save();
            }
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->route('payment-method-setting');
                // $payment_methods = InfixPaymentGatewaySetting::all();
                // return view('systemsetting::payment_method_setting', compact('payment_methods'));
                // return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
            $payment_methods = InfixPaymentGatewaySetting::all();
            return view('systemsetting::payment_method_setting', compact('payment_methods'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function payment_method_edit(Request $request, $id)
    {

        try {
            $payment_methods = InfixPaymentGatewaySetting::all();
            return $payment_methods;
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function language_setting()
    {
        try {
            $sms_languages = InfixLanguage::all();
            $all_languages = InfixAllLanguage::orderBy('code', 'ASC')->get();
            return view('systemsetting::language_setting', compact('all_languages', 'sms_languages'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /* ************ Start seo_setting ******************** */
    public function seo_setting()
    {

        try {
            $editData = InfixSeoSetting::find(1);
            return view('systemsetting::seo_setting', compact('editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function seo_setting_update(Request $request)
    {
        $request->validate([
            'site_name'    => 'required|min:3|max:100',
            'site_title'   => 'required|min:3|max:100',
            'site_author'          => 'required|min:3|max:100',
            'keyword'          => 'required|min:3|max:1000',
            'description'    => 'required|max:1000',
        ]);
        try {

            $editData = InfixSeoSetting::find(1);
            $editData->site_name = $request->site_name;
            $editData->site_title = $request->site_title;
            $editData->site_author = $request->site_author;
            $editData->keyword = $request->keyword;
            $editData->description = $request->description;
            $result = $editData->save();
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('seo-setting');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
        // return view('systemsetting::seo_setting', compact('editData'));
    }

    public function seo_setting_delete($id)
    {

        try {
            return view('systemsetting::seo_setting');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    /* ************ end seo_setting ******************** */


    public function footer_setting()
    {
        try {
            $footer_setting = InfixFooter::first();
            return view('systemsetting::footer_setting', compact('footer_setting'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function edit_footer_setting()
    {

        try {
            $footer_setting = InfixFooter::first();
            $edit = '';
            return view('systemsetting::footer_setting', compact('footer_setting', 'edit'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function update_footer_setting(Request $request)
    {
        $request->validate([
            'copyright_text'    => 'required|min:3|max:100',
            'facebook_link'   => 'required|min:3|max:100',
            'twitter_link'          => 'required|min:3|max:100',
            'youtube_link'          => 'required|min:3|max:100',
            'pinterest_link'          => 'required|min:3|max:100',
            'instagram_link'          => 'required|min:3|max:100',
            'phone'          => 'required|min:3|max:100',
            'email'    => 'required|max:1000',
            'address'    => 'required|max:1000'
        ]);
        try {

            $editeFooter = InfixFooter::find($request->id);
            $editeFooter->copyright_text = $request->copyright_text;
            $editeFooter->facebook_link = $request->facebook_link;
            $editeFooter->twitter_link = $request->twitter_link;
            $editeFooter->pinterest_link = $request->pinterest_link;
            $editeFooter->youtube_link = $request->youtube_link;
            $editeFooter->instagram_link = $request->instagram_link;
            $editeFooter->phone = $request->phone;
            $editeFooter->email = $request->email;
            $editeFooter->address = $request->address;
            $result = $editeFooter->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->route('footer-setting');
            }
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function purchase_key_setting()
    {

        try {
            return view('systemsetting::purchase_key_setting');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function rtl_ltl_setting()
    {

        try {
            return view('systemsetting::rtl_ltl_setting');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function theme_setting()
    {

        try {
            $color_styles = InfixStyle::all();
            return view('systemsetting::theme_setting', compact('color_styles'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function site_image_setting()
    {

        try {
            $editDatas = InfixBackgroundSetting::where('active_status', 1)->get();
            // return $editDatas;
            return view('systemsetting::site_image_setting', compact('editDatas'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function sitePic(Request $request)
    {
    }
    public function index()
    {

        try {
            return view('systemsetting::index');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        try {
            return view('systemsetting::create');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            return view('systemsetting::show');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

        try {
            return view('systemsetting::edit');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    //ajax theme Style Active
    public function themeStyleActive(Request $request)
    {

        try {

            if ($request->id) {
                if (Auth::user()->role_id == 1) {
                    $modified = InfixStyle::where('is_active', 1)->update(array('is_active' => 0));
                    $selected = InfixStyle::findOrFail($request->id);
                    $selected->is_active = 1;
                    $selected->save();

                    $user = User::find(Auth::user()->id);
                    $user->style_id = $request->id;
                    $user->save();
                } else {
                    $user = User::find(Auth::user()->id);
                    $user->style_id = $request->id;
                    $user->save();
                }


                return response()->json([$user]);
            } else {
                return '';
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    //ajax theme Style Active
    public function themeStyleRTL(Request $request)
    {

        try {
            if ($request->id) {
                $selected = InfixGeneralSetting::find(1);
                $selected->ttl_rtl = $request->id;
                $selected->save();
                return response()->json([$selected]);
            } else {
                return '';
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function colorThemeSet($id)
    {

        try {

            $background = InfixStyle::find($id);
            InfixStyle::where('is_active', 1)->update(['is_active' => 0]);
            $result = InfixStyle::where('id', $id)->update(['is_active' => 1]);
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    //Add new language
    public function languageAdd(Request $request)
    {

        $request->validate([
            'lang_id' => 'required|unique:infix_languages|max:255',
        ]);

        try {

            $lang_id          = $request->lang_id;
            $language_details = DB::table('infix_all_languages')->where('id', $lang_id)->first();

            if (!empty($language_details)) {
                $sms_languages                     = new InfixLanguage();
                $sms_languages->language_name      = $language_details->name;
                $sms_languages->language_universal = $language_details->code;
                $sms_languages->native             = $language_details->native;
                $sms_languages->lang_id            = $language_details->id;
                $sms_languages->active_status      = '0';
                $results = $sms_languages->save();
                if ($results) {
                    if (DB::statement('ALTER TABLE sm_language_phrases ADD ' . $language_details->code . ' text')) {
                        $column = $language_details->code;
                        $all_translation_terms = SmLanguagePhrase::all();
                        $jsonArr = [];
                        foreach ($all_translation_terms as $row) {
                            $lid          = $row->id;
                            $english_term = $row->en;
                            if (!empty($english_term)) {
                                $update_translation_term                = SmLanguagePhrase::find($lid);
                                $update_translation_term->$column       = $english_term;
                                $update_translation_term->active_status = 1;
                                $update_translation_term->save();
                            }
                        }
                        $path = base_path() . '/resources/lang/' . $language_details->code;
                        if (!file_exists($path)) {
                            File::makeDirectory($path, $mode = 0777, true, true);

                            $getData = SmLanguagePhrase::where('active_status', 1)->pluck($language_details->code, 'default_phrases');
                            $jsonContent = json_encode($getData);
                            $file = base_path() . '/resources/lang/' . $language_details->code . '/' . $language_details->code . ".json";
                            File::put($file, $jsonContent);

                            $name =  '/resources/lang/' . $language_details->code . '/' . $language_details->code . ".json";
                            $nameStr = '"' . $name . '"';
                            $newPath      = $path . 'lang.php';
                            $page_content = "<?php
                                                \$jsonFile =  base_path() ." . $nameStr . ";
                                                \$array =  json_decode(file_get_contents(\$jsonFile), true);
                                                return \$array;";
                            if (!file_exists($newPath)) {
                                File::put($path . '/lang.php', $page_content);
                            }
                        }
                        Toastr::success('Operation successful', 'Success');
                        return redirect()->route('language-setting');
                    } else {
                        Toastr::error('Operation Failed', 'Failed');
                        return redirect()->back();
                    }
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            } //not empty language
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    //Language
    public function translationTermUpdate(Request $request)
    {

        try {
            $InputId            = $request->InputId;
            $language_universal = $request->language_universal;
            $LU                 = $request->LU;
            foreach ($InputId as $id) {
                $data                      = SmLanguagePhrase::find($id);
                $data->$language_universal = $LU[$id];
                $data->save();
            }

            $getData = SmLanguagePhrase::where('active_status', 1)->pluck($language_universal, 'default_phrases');
            $jsonContent = json_encode($getData);
            $file = base_path() . '/resources/lang/' . $language_universal . '/' . $language_universal . ".json";
            File::put($file, $jsonContent);

            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function languageSetup($language_universal)
    {

        try {
            $sms_languages = SmLanguagePhrase::where('active_status', 1)->get();
            // $modules       = SmModule::all();
            return view('systemsetting::language_setup', compact('language_universal', 'sms_languages'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function languageDelete(Request $request)
    {
        $delete_directory = InfixLanguage::find($request->id);
        // return $delete_directory;
        DB::beginTransaction();
        try {
            if (DB::statement('ALTER TABLE sm_language_phrases DROP COLUMN ' . $delete_directory->language_universal)) {
                if ($delete_directory) {
                    $path = base_path() . '/resources/lang/' . $delete_directory->language_universal;
                    if (file_exists($path)) {
                        File::delete($path . '/lang.php');
                        rmdir($path);
                    }
                    $result = InfixLanguage::destroy($request->id);
                    if ($result) {
                        Toastr::success('Operation successful', 'Success');
                        return redirect()->back();
                    }
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            } //end drop table column

            DB::commit();
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            DB::rollBack();
        }
    }
    public function changeLocale($locale)
    {
        try {
            Session::put('locale', $locale);
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function changeLanguage($id)
    {
        try {
            // return $id;
            InfixLanguage::where('active_status', '=', 1)->update(['active_status' => 0]);
            $language                = InfixLanguage::find($id);
            $language->active_status = 1;
            $language->save();
            Session::flash('langChange', 'Successfully Language Changed');
            return redirect()->to('/systemsetting/locale/' . $language->language_universal);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function ajaxLanguageChange(Request $request)
    {
        $uni = $request->id;
        InfixLanguage::where('active_status', 1)->update(['active_status' => 0]);

        $updateLang = InfixLanguage::where('language_universal', $uni)->first();
        $updateLang->active_status = 1;
        $updateLang->update();

        return response()->json([$updateLang]);
    }

    public function ajaxImage(Request $request)
    {

        if ($request->isMethod('get')) {

            $editDatas = InfixBackgroundSetting::all();

            return view('systemsetting::ajax_image_upload', compact('editDatas'));
        } else {


            $validator = Validator::make(
                $request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]
            );
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'public/uploads/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $request->file('file')->move($dir, $filename);
            $site_image = InfixBackgroundSetting::find($request->get('editId'));
            $site_image->image = 'public/uploads/' . $filename;
            $site_image->save();
            return $filename;
        }
    }

    public function deleteImage($filename)
    {
        File::delete('public/uploads/' . $filename);
    }


    //Backup Settings

    //backupSettings
    public function backupSettings()
    {

        try {
            $sms_dbs = InfixBackup::orderBy('id', 'DESC')->get();
            return view('systemsetting::backupSettings', compact('sms_dbs'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function BackupStore(Request $request)
    {
        $request->validate([
            'content_file' => 'required|file',
        ]);


        try {
            if ($request->file('content_file') != "") {
                $file = $request->file('content_file');
                if ($file->getClientOriginalExtension() == 'sql') {
                    $file_name = 'Restore_' . date('d_m_Y_') . $file->getClientOriginalName();
                    $file->move('public/databaseBackup/', $file_name);
                    $content_file = 'public/databaseBackup/' . $file_name;
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }

            if (isset($content_file)) {
                $store                = new InfixBackup();
                $store->file_name     = $file_name;
                $store->source_link   = $content_file;
                $store->active_status = 1;
                $store->created_by    = Auth::user()->id;
                $store->updated_by    = Auth::user()->id;
                $result               = $store->save();
            }
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }

            $sms_dbs = InfixBackup::orderBy('id', 'DESC')->get();
            return redirect()->route('backup-settings');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    //get files Backup #file

    public function getfilesBackup($id)
    {
        set_time_limit(1600);

        try {

            if ($id == 1) {
                $path             = base_path() . '/public/uploads';
                $zip_file = 'Backup_' . date('d_m_Y') . '_' . time() . '_Images.zip';
            } else if ($id == 2) {
                $path = base_path() . '';
                $zip_file = 'Backup_' . date('d_m_Y') . '_' . time() . '_Projects.zip';
            }

            if ($id == 1) {
                $folder = public_path() . '/Backup/ImageBackup/';
                if (!file_exists($folder)) {
                    File::makeDirectory($folder, $mode = 0777, true, true);
                }
                $temp = $folder . $zip_file;
            } else {
                $folder = public_path() . '/Backup/ProjectBackup/';
                if (!file_exists($folder)) {
                    File::makeDirectory($folder, $mode = 0777, true, true);
                }
                $temp = $folder . $zip_file;
            }

            // $zip_file = 'Backup_' . date('d_m_Y').'_'.time() . '_Images.zip';
            $zip = new \ZipArchive();
            $zip->open($temp, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            // $path = public_path('uploads');
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));


            foreach ($files as $name => $file) {
                // We're skipping all subfolders
                if (!$file->isDir()) {
                    $filePath     = $file->getRealPath();
                    // extracting filename with substr/strlen
                    // $relativePath = $zip_file . substr($filePath, strlen($path) + 1);
                    $relativePath = substr($filePath, strlen($path) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
            $store                = new InfixBackup();
            $store->file_name     = $zip_file;
            $store->source_link   = $temp;
            $store->active_status = 1;
            $store->file_type     = $id;
            $store->created_by    = Auth::user()->id;
            $store->updated_by    = Auth::user()->id;
            $result               = $store->save();

            if ($id == 2) {
                return response()->download($zip_file);
            }
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function getDatabaseBackup()
    {

        try {
            $DB_HOST     = env("DB_HOST", "");
            $DB_DATABASE = env("DB_DATABASE", "");
            $DB_USERNAME = env("DB_USERNAME", "");
            $DB_PASSWORD = env("DB_PASSWORD", "");
            $connection  = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

            $tables = array();
            $result = mysqli_query($connection, "SHOW TABLES");
            while ($row = mysqli_fetch_row($result)) {
                $tables[] = $row[0];
            }
            $return = '';

            foreach ($tables as $table) {
                $result     = mysqli_query($connection, "SELECT * FROM " . $table);
                $num_fields = mysqli_num_fields($result);

                $return .= 'DROP TABLE ' . $table . ';';
                $row2 = mysqli_fetch_row(mysqli_query($connection, "SHOW CREATE TABLE " . $table));
                $return .= "\n\n" . $row2[1] . ";\n\n";

                for ($i = 0; $i < $num_fields; $i++) {
                    while ($row = mysqli_fetch_row($result)) {
                        $return .= "INSERT INTO " . $table . " VALUES(";
                        for ($j = 0; $j < $num_fields; $j++) {
                            $row[$j] = addslashes($row[$j]);
                            if (isset($row[$j])) {
                                $return .= '"' . $row[$j] . '"';
                            } else {
                                $return .= '""';
                            }
                            if ($j < $num_fields - 1) {
                                $return .= ',';
                            }
                        }
                        $return .= ");\n";
                    }
                }
                $return .= "\n\n\n";
            }

            $folder = public_path() . '/Backup/DatabaseBackup/';
            if (!file_exists($folder)) {
                File::makeDirectory($folder, $mode = 0777, true, true);
            }
            //save file
            $name   = 'database_backup_' . date('d_m_Y') . '_' . time() . '.sql';
            $path   = $folder . $name;
            $handle = fopen($path, "w+");
            fwrite($handle, $return);
            fclose($handle);

            $get_backup                = new InfixBackup();
            $get_backup->file_name     = $name;
            $get_backup->source_link   = $path;
            $get_backup->active_status = 1;
            $get_backup->file_type     = 0;
            $results                   = $get_backup->save();


            // $sms_dbs = SmBackup::orderBy('id', 'DESC')->get();
            // return view('backEnd.systemSettings.backupSettings', compact('sms_dbs'));

            if ($results) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {

            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function deleteDatabase($id)
    {

        try {
            $source_link = "";
            $data        = InfixBackup::find($id);
            if (!empty($data)) {
                $source_link = $data->source_link;
                if (file_exists($source_link)) {
                    unlink($source_link);
                }
            }
            $result = InfixBackup::where('id', $id)->delete();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    //restore database from public/databaseBackup
    public function restoreDatabase($id)
    {
        try {
            $sm_db = InfixBackup::where('id', $id)->first();
            if (!empty($sm_db)) {
                $source_link = $sm_db->source_link;
            }

            $DB_HOST     = env("DB_HOST", "");
            $DB_DATABASE = env("DB_DATABASE", "");
            $DB_USERNAME = env("DB_USERNAME", "");
            $DB_PASSWORD = env("DB_PASSWORD", "");

            $connection = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

            if (!file_exists($source_link)) {
                Toastr::error('File not found', 'Failed');
                return redirect()->back();
            }
            $handle   = fopen($source_link, "r+");
            $contents = fread($handle, filesize($source_link));
            $sql      = explode(';', $contents);
            $flag     = 0;
            foreach ($sql as $query) {
                $result = mysqli_query($connection, $query);
                if ($result) {
                    $flag = 1;
                }
            }
            fclose($handle);

            if ($flag) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function downloadFiles($id)
    {

        try {
            $sm_db       = InfixBackup::where('id', $id)->first();
            $source_link = $sm_db->source_link;
            if (@file_exists(@$source_link)) {
                return response()->download($source_link);
            } else {
                Toastr::error('File not found', 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function FooterCustomLink()
    {


        try {
            $footer_setting = InfixFooter::first();
            $edit = '';
            $links = InfixFooterMenu::find(1);
            return view('systemsetting::custom_link', compact('links', 'footer_setting', 'edit'));
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function customLinksUpdate(Request $request)
    {
        // return $request;

        try {
            $links = InfixFooterMenu::find(1);
            $links->title1 = $request->title1;
            $links->link_label1 = $request->link_label1;
            $links->link_href1 = $request->link_href1;
            $links->link_label2 = $request->link_label2;
            $links->link_href2 = $request->link_href2;
            $links->link_label3 = $request->link_label3;
            $links->link_href3 = $request->link_href3;
            $links->title2 = $request->title2;
            $links->link_label5 = $request->link_label5;
            $links->link_href5 = $request->link_href5;
            $links->link_label6 = $request->link_label6;
            $links->link_label7 = $request->link_label7;
            $links->link_href7 = $request->link_href7;
            $links->title3 = $request->title3;
            $links->link_label9 = $request->link_label9;
            $links->link_href9 = $request->link_href9;
            $links->link_label10 = $request->link_label10;
            $links->link_href10 = $request->link_href10;
            $links->link_label11 = $request->link_label11;
            $links->link_href11 = $request->link_href11;
            $links->link_label13 = $request->link_label13;
            $links->link_href13 = $request->link_href13;
            $links->link_label14 = $request->link_label14;
            $links->link_href14 = $request->link_href14;
            $links->link_label15 = $request->link_label15;
            $links->link_href15 = $request->link_href15;
            $result = $links->save();

            $editeFooter = InfixFooter::find(1);
            $editeFooter->copyright_text = $request->copyright_text;
            $editeFooter->icon1 = $request->icon1;
            $editeFooter->url1 = $request->url1;
            $editeFooter->icon2 = $request->icon2;
            $editeFooter->url2 = $request->url2;
            $editeFooter->icon3 = $request->icon3;
            $editeFooter->url3 = $request->url3;
            $editeFooter->icon4 = $request->icon4;
            $editeFooter->url4 = $request->url4;
            $editeFooter->icon5 = $request->icon5;
            $editeFooter->url5 = $request->url5;
            $result1 = $editeFooter->save();

            if ($result && $result1) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function aboutSystem(Request $request)
    {
        try {
            $data = InfixGeneralSetting::first();
            return view('systemsetting::aboutSystem', compact('data'));
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function googleAnalytics(Request $request)
    {

        try {
            $view_id = env('ANALYTICS_VIEW_ID');
            $access_key = env('access_key');
            return view('systemsetting::google_analytics', compact('view_id', 'access_key'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function google_analytics_setup(Request $request)
    {


        if ($request->view_id == '') {
            Toastr::error('View ID is required', 'Failed');
            return redirect()->back();
        }
        try {

            $path = base_path() . "/.env";

            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            $envKey = 'ANALYTICS_VIEW_ID';
            $envValue = $request->view_id;
            $str .= "\n";
            $keyPosition = strpos($str, "{$envKey}=");
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
            if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                $str .= "{$envKey}={$envValue}\n";
            } else {
                $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
            }
            $str = substr($str, 0, -1);
            if (!file_put_contents($envFile, $str)) {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
            //ANALYTICS_VIEW_ID=214610223
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (Throwable $th) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function fixer_setup(Request $request)
    {


        if ($request->access_key == '') {
            Toastr::error('Fixer Access Key is required', 'Failed');
            return redirect()->back();
        }
        try {

            $path = base_path() . "/.env";

            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            $envKey = 'access_key';
            $envValue = $request->access_key;
            $str .= "\n";
            $keyPosition = strpos($str, "{$envKey}=");
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
            if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                $str .= "{$envKey}={$envValue}\n";
            } else {
                $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
            }
            $str = substr($str, 0, -1);
            if (!file_put_contents($envFile, $str)) {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
            //ANALYTICS_VIEW_ID=214610223
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (Throwable $th) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function updateLoginMsg(Request $request)
    {
        $request->validate([
            'signin_message' => 'required',
        ]);
        try {
            $images_setting = InfixBackgroundSetting::find(4);
            $images_setting->additional_text = $request->signin_message;
            $images_setting->save();
            Toastr::success('Sigin Message Updated Successfully', 'Success');
            return redirect()->back();
        } catch (Throwable $th) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function updateErrorMsg(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);
        try {
            $images_setting = InfixBackgroundSetting::find(5);
            $images_setting->additional_text = $request->message;
            $images_setting->save();
            Toastr::success('Error Message Updated Successfully', 'Success');
            return redirect()->back();
        } catch (Throwable $th) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function ajaxLanguageChangeMenu(Request $request)
    {
        try {

            if (Auth::user()->role_id == 1) {
                $uni = $request->id;
                InfixLanguage::where('active_status', 1)->update(['active_status' => 0]);

                $user = User::find(Auth::user()->id);
                $user->lang_id = $uni;
                if (checkRTL($uni) == 'rtl') {
                    $user->rtl = 1;
                    $user->save();
                } else {
                    $user->rtl = 0;
                    $user->save();
                }

                $updateLang = InfixLanguage::where('language_universal', $uni)->first();
                $updateLang->active_status = 1;
                $updateLang->update();
                session()->put('locale', $updateLang->language_universal);

                $values['APP_LOCALE'] = $updateLang->language_universal;

                $envFile = app()->environmentFilePath();
                $str = file_get_contents($envFile);
                if (count($values) > 0) {
                    foreach ($values as $envKey => $envValue) {
                        $str .= "\n";
                        $keyPosition = strpos($str, "{$envKey}=");
                        $endOfLinePosition = strpos($str, "\n", $keyPosition);
                        $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                        if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                            $str .= "{$envKey}={$envValue}\n";
                        } else {
                            $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                        }
                    }
                }
                $str = substr($str, 0, -1);
                $res = file_put_contents($envFile, $str);
            } else {
                $uni = $request->id;

                $user = User::find(Auth::user()->id);
                $user->lang_id = $uni;
                if (checkRTL($uni) == 'rtl') {
                    $user->rtl = 1;
                    $user->save();
                } else {
                    $user->rtl = 0;
                    $user->save();
                }

                $updateLang = InfixLanguage::where('language_universal', $uni)->first();
                session()->put('locale', $updateLang->language_universal);
            }



            return response()->json([$updateLang]);
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
