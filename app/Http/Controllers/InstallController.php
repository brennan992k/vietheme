<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Balance;
use App\Models\Profile;
use App\Envato\Envato;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Modules\Systemsetting\Entities\InfixGeneralSetting;

class InstallController extends Controller
{

    //step1
    public function index()
    {
        if (Schema::hasTable('users')) {
            $testInstalled = DB::table('users')->get();
            if (count($testInstalled) < 1) {
                Session::put('step1', 1);
                return view('install.welcome_to_infix');
            } else {
                return redirect('login');
            }
        } else {
            Session::put('step1', 1);
            return view('install.welcome_to_infix');
        }
    }

    public function confirmation()
    {
        return view('install.confirmation');
    }

    public function CheckPurchaseVerificationPage()
    {
        if (Session::get('step1') != 1) {
            return redirect('install');
        }

        if (Schema::hasTable('sm_general_settings')) {
            $GetData = DB::table('sm_general_settings')->find(1);
            if (empty($GetData)) {
                return view('install.check_purchase_page');
            } else {
                $envatouser = $GetData->envato_user;
                $purchasecode = $GetData->system_purchase_code;
                $domain = $GetData->system_domain;

                $UserData = Envato::verifyPurchase($purchasecode);
                if (!empty($UserData['verify-purchase']['item_id'])) {

                    $setting                        = new InfixGeneralSetting();
                    $setting->system_domain         = $domain;
                    $setting->envato_user           = $envatouser;
                    $setting->system_purchase_code  = $purchasecode;
                    $setting->envato_item_id        = $UserData['verify-purchase']['item_id'];
                    $setting->system_activated_date = date('Y-m-d');
                    $setting->save();

                    Session::put('envatouser', $envatouser);
                    Session::put('purchasecode', $purchasecode);
                    Session::put('domain', $domain);
                    Session::put('item_id', $UserData['verify-purchase']['item_id']);
                    Session::flash("message-success", "Congratulations! Your Purchase code already verified.");
                    return redirect()->back();
                } else {
                    Session::flash("message-danger", "Ops! Purchase Code is not valid. Please try again.");
                    return view('install.check_purchase_page');
                }
            }
        } else {
            return view('install.check_purchase_page');
        }
    }

    public function is_valid_domain_name($domain_name)
    {
        if (filter_var(gethostbyname($domain_name), FILTER_VALIDATE_IP)) {
            return TRUE;
        } else return FALSE;
    }
    public function CheckVerifiedInput(Request $request)
    {

        $request->validate([
            'envatouser' => 'required',
            'purchasecode' => 'required',
            'installationdomain' => 'required',
        ]);

        if ($this->is_valid_domain_name($request->installationdomain)) {

            $envatouser = htmlspecialchars($request->input('envatouser'));
            $purchasecode = htmlspecialchars($request->input('purchasecode'));
            $domain = htmlspecialchars($request->input('installationdomain'));

            $UserData = Envato::verifyPurchase($purchasecode);

            // if (!empty($UserData['verify-purchase']['item_id']) && (User::$item == $UserData['verify-purchase']['item_id'])) { 
            if (!empty($UserData['verify-purchase']['item_id'])) {

                Session::put('envatouser', $envatouser);
                Session::put('purchasecode', $purchasecode);
                Session::put('domain', $domain);
                Session::put('item_id', $UserData['verify-purchase']['item_id']);

                $client = new Client();
                $product_info = $client->request('GET', 'http://sp.uxseven.com/api/installation/' . $purchasecode . '/' . $domain . '/' . $envatouser);
                $product_info = $product_info->getBody()->getContents();
                $product_info = json_decode($product_info);
                if ($product_info->flag == false) {
                    return redirect()->back()->with("message-danger", $product_info->message);
                } else {
                    Session::put('CheckVerifiedInput', 'success');
                    Session::flash("message-success", "Congratulations! Purchase code is verified." . $product_info->message);
                    return redirect('check-environment');
                }
            } else {
                Session::flash("message-danger", "Ops! Purchase Code is not valid. Please try again.");
                return redirect()->back()->with("message-danger", "Ops! Purchase Code is not valid. Please try again.");
            }
            return redirect()->back()->with("message-danger", "Ops! Purchase Code is not valid. Please try again.");
        } else {
            return redirect()->back()->with("message-danger", "Ops! Invalid Domain. Please try again.");
        }
    }



    public function installStep2(Request $request)
    {

        $database_Name = $request->input('database_name');
        $database_user = $request->input('database_user');
        $database_password = $request->input('database_password');

        //$servername = 'localhost';
        // $connect = mysqli_connect($servername, $database_user, $database_password, $database_Name);
        // $connect = new mysqli($servername, $database_user, $database_password, $database_Name);


        $key1 = 'DB_DATABASE';
        $key2 = 'DB_USERNAME';
        $key3 = 'DB_PASSWORD';
        $value = $database_Name;
        $value2 = $database_user;
        $value3 = $database_password;

        $path = base_path() . "/.env";
        $DB_DATABASE = env($key1);
        $DB_USERNAME = env($key2);
        $DB_PASSWORD = env($key3);


        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key1=" . $DB_DATABASE,
                "$key1=" . $value,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key2=" . $DB_USERNAME,
                "$key2=" . $value2,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key3=" . $DB_PASSWORD,
                "$key3=" . $value3,
                file_get_contents($path)
            ));
        } else {
            Session::flash("message-danger", "Ops! .env file is not found ! Please check your project.");
            return redirect('/install2');
        }

        try {
            DB::connection()->getPdo();
        } catch (Exception $e) {
            Session::flash("message-danger", "Ops! Could not connect to the database.  Please check your configuration.");
            return redirect('/install2');
        }

        Session::put('install2', 'success');
        return redirect('/install3');
    }

    public function checkEnvironmentPage()
    {

        $path = '';
        $folders = array(
            $path . "/route",
            $path . "/resources",
            $path . "/public",
            $path . "/storage",
        );
        return view('install.checkEnvironmentPage')->with('folders', $folders);
    }

    public function checkEnvironment(Request $request)
    {
        $path = '';
        $folders = array(
            $path . "/route",
            $path . "/resources",
            $path . "/public",
            $path . "/storage",
        );


        if (phpversion() >= '7.1' && OPENSSL_VERSION_NUMBER > 0x009080bf && extension_loaded('mbstring') && extension_loaded('tokenizer') && extension_loaded('xml') && extension_loaded('ctype')  && extension_loaded('json')) {
            Session::put('install3', 'success');
            return redirect('system-setup-page');
        } else {
            Session::flash("message-danger", "Ops! Extension are disabled.  Please check requirements!");
            return redirect()->back()->with("message-danger", "Ops! Extension are disabled.  Please check requirements!");
        }
    }

    public function systemSetupPage()
    {
        return view('install.systemSetupPage');
    }

    public function confirmInstalling(Request $request)
    {
        set_time_limit(900);

        $this->validate($request, [
            'institution_name' => 'required',
            'system_admin_email' => 'required',
            'system_admin_password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ]);


        Session::put('institution_name', $request->institution_name);
        Session::put('system_admin_email', $request->system_admin_email);
        Session::put('system_admin_password', $request->system_admin_password);




        Artisan::call('migrate:refresh');
        if (Config::get('app.app_sync')) {
            Artisan::call('db:seed');
        }




        if (Schema::hasTable('migrations')) {
            $migration = DB::table('migrations')->get();
            if (count($migration) > 0) {
                $id = 1;
                $is_existing_settings = InfixGeneralSetting::find($id);
                if ($is_existing_settings != "") {
                    $is_existing_settings->system_name = $request->input('institution_name');
                    $is_existing_settings->system_purchase_code = Session::get('purchasecode');
                    $is_existing_settings->save();
                } else {
                    $setting = new InfixGeneralSetting();
                    $is_existing_settings->system_name = $request->input('institution_name');
                    $setting->language_id = $request->input('language_select');
                    $setting->system_purchase_code = Session::get('purchasecode');
                    $setting->save();
                }

                $user = User::find(1);
                if (empty($user)) {
                    $user = new User();
                }
                $user->role_id = 1;
                $user->email = $request->input('system_admin_email');
                $user->password  = Hash::make($request->input('system_admin_password'));
                $user->full_name = 'System Adminstratior';
                $user->status = 1;
                $user->access_status = 1;
                $user->username = $request->input('system_admin_email');
                $user->email_verified_at = Carbon::now();
                $user->save();

                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->country_id = 19;
                $profile->state_id = 290;
                $profile->city_id = 1374;
                $profile->save();


                $balance = new Balance();
                $balance->user_id = $user->id;
                $balance->type    = 1;
                $balance->amount  = 0;
                $balance->save();

                if (!empty($user)) {
                    return redirect('confirmation');
                } else {
                    Artisan::call('migrate:reset');
                    return redirect()->back();
                }
            }
        }
    }


    public function verifiedCode()
    {
        if (Schema::hasTable('sm_general_settings')) {
            $GetData = DB::table('sm_general_settings')->find(1);
            if (!empty($GetData)) {
                $UserData = Envato::verifyPurchase($GetData->system_purchase_code);
                if (!empty($UserData['verify-purchase']['item_id'])) {
                    return redirect('/login');
                }
            } else {
                return view('install.verified_code');
            }
        } else {
            return redirect('install');
        }
    }

    public function verifiedCodeStore(Request $request)
    {
        $envatouser = htmlspecialchars($request->input('envatouser'));
        $purchasecode = htmlspecialchars($request->input('purchasecode'));
        $domain = htmlspecialchars($request->input('installationdomain'));

        $obj = Envato::verifyPurchase($purchasecode);


        if (!empty($obj)) {
            foreach ($obj as $data) {
                if (!empty($data['item_id'])) {

                    $setting = InfixGeneralSetting::first();
                    $setting->system_domain = $domain;
                    $setting->envato_user = $envatouser;
                    $setting->system_purchase_code = $purchasecode;
                    $setting->envato_item_id = $data['item_id'];
                    $setting->system_activated_date = date('Y-m-d');
                    $setting->save();

                    $url = Session::get('url');

                    return redirect($url);
                }
            }
        } else {
            Session::flash("message-danger", "Ops! Purchase Code is not vaild. Please try again.");
            return redirect()->back();
        }
        Session::flash("message-danger", "Ops! Purchase Code is not vaild. Please try again.");
        return redirect()->back();
    }
}
