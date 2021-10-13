<?php

namespace Modules\InitApp\Repositories;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\ItemCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Systemsetting\Entities\InfixGeneralSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InitRepository
{

    public function init()
    {
        config([
            'app.item' => '29695967',
            'spondonit.module_manager_model' => \App\InfixModuleManager::class,
            'spondonit.module_manager_table' => 'infix_module_managers',

            'spondonit.settings_model' => \Modules\Systemsetting\Entities\InfixGeneralSetting::class,
            'spondonit.module_model' => \Nwidart\Modules\Facades\Module::class,

            'spondonit.user_model' => \App\User::class,
            'spondonit.settings_table' => 'infix_general_settings',
            'spondonit.database_file' => '',
        ]);
    }

    public function config()
    {
        // if (Schema::hasTable(config('spondonit.settings_table'))) {
            app()->singleton('infix_general_settings', function () {
                return DB::table('infix_general_settings')->first();
            });
            app()->singleton('infix_seo_settings', function () {
                return DB::table('infix_seo_settings')->where('active_status', 1)->first();
            });
            app()->singleton('infix_background_settings', function () {
                return DB::table('infix_background_settings')->get();
            });
            app()->singleton('infix_footer_settings', function () {
                return DB::table('infix_footer_settings')->first();
            });
            app()->singleton('infix_languages', function () {
                return DB::table('infix_languages')->get();
            });
            app()->singleton('sm_notifications', function () {
                return DB::table('sm_notifications')->where('received_id', Auth::user()->id)->where('is_read', 0)->latest()->get();
            });
            app()->singleton('item_categories', function () {
                return ItemCategory::where('active_status', 1)
                    //  ->with('ItemSubCategory')
                    ->where('show_menu', 1)
                    ->orderBy('position', 'asc')
                    ->get();
            });
        // }

        // try {
        //     VerifyEmail::toMailUsing(function ($notifiable, $url) {
        //         $mail = new MailMessage;
        //         $mail->from(GeneralSetting()->email, GeneralSetting()->system_name);
        //         $mail->subject('Email verification');
        //         $mail->markdown('mail.email_verify', ['url' => $url]);
        //         return $mail;
        //     });
        // } catch (\Throwable $th) {
        //     Log::info($th->getMessage());
        // }

        // if (Schema::hasTable(config('spondonit.settings_table'))) {
        //     View::composer('frontend.partials.header', function ($view) {
        //         $view->with('infix_general_settings', InfixGeneralSetting::first());
        //     });
        //     $infix_general_settings = InfixGeneralSetting::first();
        //     Session::put('infix_currency', $infix_general_settings->currency);
        //     Session::put('infix_currency_symbol', $infix_general_settings->currency_symbol);
        // }
    }
}
