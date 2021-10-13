<?php

use App\Models\Item;
use App\Models\User;
use App\Models\Userlog;
use App\Models\Attribute;
use App\Models\ItemOrder;
use Carbon\Carbon;
use App\Models\FooterMenu;
use App\Models\SubAttribute;
use App\Models\ItemAttribute;
use App\Models\ReCaptchaSetting;
use App\Models\AuthorPayoutSetup;
use App\Models\InfixModuleManager;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Modules\Systemsetting\Entities\InfixStyle;
use Modules\Systemsetting\Entities\InfixFooter;
use Modules\Systemsetting\Entities\InfixLanguage;
use Modules\Systemsetting\Entities\InfixDateFormat;
use Modules\Systemsetting\Entities\InfixAllLanguage;
use Modules\Systemsetting\Entities\InfixEmailSetting;
use Modules\Systemsetting\Entities\InfixGeneralSetting;
use Modules\Systemsetting\Entities\InfixBackgroundSetting;

function recaptchasetting()
{
  $data = ReCaptchaSetting::first();
  return $data;
}
if (!function_exists('starts_with')) {
  /**
   * Determine if a given string starts with a given substring.
   *
   * @param  string  $haystack
   * @param  string|array  $needles
   * @return bool
   *
   * @deprecated Str::startsWith() should be used directly instead. Will be removed in Laravel 6.0.
   */
  function starts_with($haystack, $needles)
  {
    return Str::startsWith($haystack, $needles);
  }
}
if (!function_exists('str_contains')) {
  /**
   * Determine if a given string contains a given substring.
   *
   * @param  string  $haystack
   * @param  string|array  $needles
   * @return bool
   *
   * @deprecated Str::contains() should be used directly instead. Will be removed in Laravel 6.0.
   */
  function str_contains($haystack, $needles)
  {
    return Str::contains($haystack, $needles);
  }
}
if (!function_exists('appMode')) {
  function appMode()
  {
    return Config::get('app.app_sync');
  }
}
function GeneralSetting()
{
  return app('infix_general_settings');
}
if (!function_exists('systemStyle')) {
  function systemStyle()
  {
    $style = InfixStyle::where('is_active', 1)->first();
    return $style;
  }
}
if (!function_exists('checkRTL')) {
  function checkRTL($lang)
  {
    $language = InfixAllLanguage::where('code', $lang)->first();
    if ($language->rtl == 1) {
      return "rtl";
    } else {
      return "ltl";
    }

    $style = InfixStyle::where('is_active', 1)->first();
    return $style;
  }
}
if (!function_exists('putEnvConfigration')) {
  function putEnvConfigration($key, $value)
  {
    $path = base_path('.env');
    if (file_exists($path)) {
      file_put_contents($path, str_replace(
        $key . '=' . env($key),
        $key . '=' . $value,
        file_get_contents($path)
      ));
    }
  }
}
function BackgroundSetting()
{

  // $data = DB::table('infix_background_settings')->get();

  return app('infix_background_settings');
}
function InfixFooterMenu()
{

  $data = DB::table('infix_footer_menus')->first();

  return $data;
}
function ItemCategory()
{

  $data = DB::table('item_categories')->get();

  return $data;
}
function CheckFollow($follower_id, $leader_id)
{

  $data = DB::table('followers')->where('follower_id', $follower_id)->where('leader_id', $leader_id)->first();

  return $data;
}
function InfixFooterSetting()
{

  $data = DB::table('infix_footer_settings')->first();

  return $data;
}
function PaymentMode($name)
{

  $data = DB::table('infix_payment_gateway_settings')->where('gateway_name', $name)->first()->mode;
  if ($data == 1) {
    return "true";
  } else {
    return "false";
  }

  // return $data;
}
function PaymentMethodStatus($name)
{

  $data = DB::table('infix_payment_gateway_settings')->where('gateway_name', $name)->first()->active_status;
  if ($data == 1) {
    return "true";
  } else {
    return "false";
  }

  // return $data;
}
function PaymentMethodSetup($name)
{

  $data = DB::table('infix_payment_gateway_settings')->where('gateway_name', $name)->first();
  if ($data) {
    return $data;
  } else {
    return false;
  }

  // return $data;
}
function FooterMenu()
{

  $data = FooterMenu::where('active_status', 1)->orderBy('position_no', 'ASC')->get();

  return $data;
}

function DateFormat($input_date)
{
  $generalSetting = InfixGeneralSetting::find(1);
  $system_date_foramt = InfixDateFormat::find($generalSetting->date_format_id);
  $DATE_FORMAT =  $system_date_foramt->format;
  return date_format(date_create($input_date), $DATE_FORMAT);
}
function MailNotification($data, $to_name, $to_email, $email_sms_title)
{
  $systemSetting = DB::table('infix_general_settings')->select('system_name')->find(1);
  $systemEmail = DB::table('infix_email_settings')->find(1);
  $system_email = $systemEmail->from_email;
  $site_name = $systemSetting->system_name;
  if (!empty($system_email)) {
    $data['email_sms_title'] = $email_sms_title;
    $data['system_email'] = $system_email;
    $data['site_name'] = $site_name;
    $data['to_name'] = $to_name;
    dispatch(new \App\Jobs\SendEmailJob($data, $to_email));
    $error_data =  [];
    return true;
  } else {
    $error_data[0] = 'success';
    $error_data[1] = 'Operation Failed, Please Updated System Mail';
    return $error_data;
  }
}

function mailsetting()
{
  $email_setting = DB::table('email_notification_settings')->where('user_id', Auth::user()->id)->first();
  return $email_setting;
}
function Adminmailsetting($id)
{
  $email_setting = DB::table('email_notification_settings')->where('user_id', $id)->first();
  return $email_setting;
}

function Itemreviews($item_id, $order_id)
{
  $review = DB::table('reviews')->where(['user_id' => Auth::id(), 'item_id' => $item_id, 'order_id' => $order_id])->first();
  return $review;
}


function convertCurrency($from_currency, $to_currency, $amount)
{
  return $amount;

  $from = urlencode($from_currency);
  $to = urlencode($to_currency);
  $apikey = (env('access_key') != null) ? env('access_key') : '4535c2be6b86684dee72cecc75ad8591';
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "http://data.fixer.io/api/latest?access_key=" . $apikey,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "accept: application/json",
      "content-type: application/json"
    ),
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);

  if ($err) {

    return number_format($amount, 2, '.', '');
  } else {

    $info = json_decode($response);
    $cur = (array)@$info->rates;
    $from_ = null;
    $to_ = null;
    foreach ($cur as $key => $value) {
      if ($key == $from) {
        $from_ = $value;
      }
      if ($key == $to) {
        $to_ = $value;
      }
    }
    if ($to_ > 0) {
      $total = ($to_ / $from_) * $amount;
    } else {
      $total = 0;
    }
    return number_format($total, 2, '.', '');
  }
}


function convert_to_usd($amount)
{
  $from_currency = GeneralSetting()->currency;
  $data = convertCurrency($from_currency, 'USD', $amount);
  return number_format($data, 2, '.', '');
}
function convert_to_inr($amount)
{
  $from_currency = GeneralSetting()->currency;
  $data = convertCurrency($from_currency, 'INR', $amount);
  return number_format($data, 2, '.', '');
}
function userlog($user_id)
{

  /*     $curl = curl_init();
    curl_setopt_array($curl, array(
    //   CURLOPT_URL => "https://freegeoip.app/json/",
      CURLOPT_URL => "http://www.geoplugin.net/php.gp?ip=".$_SERVER['REMOTE_ADDR'],
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "accept: application/json",
        "content-type: application/json"
      ),
    ));    
    $response = curl_exec($curl);
    $err = curl_error($curl);    
    curl_close($curl);    
    if ($err) {
     
    } else {
      $info = json_decode($response);
    } */
  $ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $_SERVER['REMOTE_ADDR']
  ));

  $agent = new Agent();
  $browser = $agent->browser();
  $platform = $agent->platform();
  $version = $agent->version($platform);

  $user_log = new Userlog();
  $user_log->user_id = $user_id;
  $user_log->last_login_at = Carbon::now();
  $user_log->last_login_ip = $_SERVER['REMOTE_ADDR'];
  $user_log->device = $agent->device();
  $user_log->browser = $browser . '/' . $version . '(' . $platform . ')';
  $user_log->country_name = @$ipdat->geoplugin_countryName;
  // $user_log->region_name =$info->region_name;
  $user_log->city = @$ipdat->geoplugin_city;
  // $user_log->zip_code =$info->zip_code;
  $user_log->save();
}

if (!function_exists('activeLanguage')) {
  function activeLanguage()
  {
    $session = session()->get('locale');
    try {

      if (!empty($session)) {
        return $session;
      } else {
        $updateLang = InfixLanguage::where('active_status', 1)->first();
        session()->put('locale', $updateLang->language_universal);
        return session()->get('locale');
      }
    } catch (Exception $e) {
      return InfixLanguage::where('active_status', 1)->first();
    }
  }
}
if (!function_exists('userActiveLanguage')) {
  function userActiveLanguage()
  {
    $session = session()->get('locale');
    try {

      if (!empty($session)) {
        return $session;
      } else {
        session()->put('locale', Auth::user()->lang_id);
        return session()->get('locale');
      }
    } catch (Exception $e) {
      return InfixLanguage::where('active_status', 1)->first();
    }
  }
}
if (!function_exists('isAuthor')) {
  function isAuthor($user_id, $item_id)
  {
    $item = Item::where('user_id', $user_id)->where('id', $item_id)->first();
    return $item;
  }
}

if (!function_exists('purchaseCheck')) {
  function purchaseCheck($user_id = null, $item_id = null)
  {
    $item_order = ItemOrder::where('item_id', $item_id)->where('user_id', $user_id)->first();
    if ($item_order) {
      return true;
    } else {
      return false;
    }
  }
}

if (!function_exists('GetPurchaseStatus')) {
  function GetPurchaseStatus($user_id = null, $item_id = null)
  {
    try {
      $user = User::find($user_id);
      if ($user->role->id == 5) {
        $itemOrdered = ItemOrder::where([['user_id', $user_id], ['item_id', $item_id]])->first();
        if ($itemOrdered) {
          $license_type = json_decode($itemOrdered->item, true);
          if (@$license_type['support_time'] == 1) {
            $expire_date = \Carbon\Carbon::parse($itemOrdered->created_at)->addMonths(6);
          } else {
            $expire_date = \Carbon\Carbon::parse($itemOrdered->created_at)->addMonths(12);
          }
          $created = new \Carbon\Carbon($expire_date);
          $now = \Carbon\Carbon::now();
          $difference = ($created->diff($now)->days < 1)
            ? 'today'
            : $created->diffForHumans($now);
          if ($difference > 0) {
            return '<span class="author-tag">Purchased</span> <span class="author-tag">Support</span>';
          } else {
            return '<span class="author-tag">Purchased</span>';
          }
        } else {
          return '';
        }
      } else {
        if (isAuthor($user_id, $item_id)) {
          return '<span class="author-tag">Author</span>';
        } else {
          return '';
        }
      }
    } catch (Exception $e) {
      return '';
      // return InfixLanguage::where('active_status', 1)->first();
    }
  }
}



// get Attribute Values
if (!function_exists('defaultPayout')) {
  function defaultPayout()
  {
    $default_setup = AuthorPayoutSetup::where('user_id', Auth::user()->id)->where('is_default', 1)->first();
    return $default_setup;
  }
}
// get Attribute Values
if (!function_exists('getAttributeValues')) {
  function getAttributeValues($ids)
  {
    $values = json_decode($ids);
    foreach ($values as $key => $id) {
      $data = SubAttribute::select('name')->find($id);
      $input[] = $data->name;
    }
    return implode(",", $input);
  }
}

// get Attribute Name
if (!function_exists('getAttributeName')) {
  function getAttributeName($field_name)
  {
    $data = Attribute::select('name')->where('field_name', $field_name)->first();
    return $data->name;
  }
}




// get Attribute SelecedStatus
if (!function_exists('getAttributeSelecedStatus')) {
  function getAttributeSelecedStatus($item_id, $field_name, $id)
  {
    $data = ItemAttribute::select('item_id')->where('item_id', $item_id)->where('field_name', $field_name)->where('values', 'LIKE', '%"' . $id . '"%')->first();
    if ($data) {
      return 'selected';
    } else {
      return '';
    }
  }
}


if (!function_exists('re_captcha_settings')) {
  function re_captcha_settings($column = null)
  {
    $reCaptcha = ReCaptchaSetting::first();
    if ($reCaptcha) {
      return $reCaptcha->$column;
    }
    return '';
  }
}

if (!function_exists('dashboard_background')) {
  function dashboard_background($conditions = null)
  {
    if (!empty($conditions)) {
      return InfixBackgroundSetting::where($conditions)->first();
    } else {
      return InfixBackgroundSetting::first();
    }
    return [];
  }
}
if (!function_exists('moduleStatusCheck')) {
  function moduleStatusCheck($module)
  {

    try {
      // get all module from session;
      $all_module = session()->get('all_module');
      //check module status
      $modulestatus = Module::find($module)->isDisabled();

      //if session exist and non empty
      if (!empty($all_module)) {
        if ((in_array($module, $all_module)) && $modulestatus == false) {

          return True;
        } else {
          return False;
        }
      } //if session failed or empty data then hit database
      else {
        // is available Modules / FeesCollection1 / Providers / FeesCollectionServiceProvider . php
        $is_module_available = 'Modules/' . $module . '/Providers/' . $module . 'ServiceProvider.php';

        if (file_exists($is_module_available)) {
          $modulestatus = Module::find($module)->isDisabled();

          if ($modulestatus == FALSE) {
            $is_verify = InfixModuleManager::where('name', $module)->first();

            if (!empty($is_verify->purchase_code)) {
              return TRUE;
            }
          }
        }
      }
    } catch (Throwable $th) {
      return FALSE;
    }
  }
}
if (!function_exists('send_mail')) {
  function send_mail($reciver_email, $receiver_name, $subject, $view, $compact = [])
  {
    $setting = InfixEmailSetting::first();
    $sender_email = $setting->from_email;
    $sender_name = $setting->from_name;
    $email_driver = InfixGeneralSetting::first('email_driver')->email_driver;
    try {
      if ($email_driver == "smtp") {
        Mail::send($view, $compact, function ($message) use ($reciver_email, $receiver_name, $sender_name, $sender_email, $subject) {
          $message->to($reciver_email, $receiver_name)->subject($subject);
          $message->from($sender_email, $sender_name);
        });
      }
      if ($email_driver == "php") {
        // dd($email_driver);
        $message = (string)view($view, $compact);
        $headers = "From: <$sender_email> \r\n";
        $headers .= "Reply-To: $receiver_name <$reciver_email> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        @mail($reciver_email, $subject, $message, $headers);
      }
    } catch (Exception $e) {
      Log::info($e->getMessage());
    }
  }
}



// get Social Icons Dynamic
if (!function_exists('getSocialIconsDynamic')) {
  function getSocialIconsDynamic($conditions = null)
  {
    $social_string = "";
    $urls = [
      'icon1' => 'url1',
      'icon2' => 'url2',
      'icon3' => 'url3',
      'icon4' => 'url4',
      'icon5' => 'url5'
    ];

    if (!empty($conditions)) {
      $data = InfixFooter::where($conditions)->first();
    } else {
      $data = InfixFooter::first();
    }
    foreach ($urls as $icon => $url) {
      if ($data->$icon != "" && $data->$url != "") {
        $social_string .= '<li> <a href="' . @$data->$url . '" target="_blank"><i class="fa ' . @$data->$icon . '"></i> </a></li>';
      }
    }
    return $social_string;
  }
}
