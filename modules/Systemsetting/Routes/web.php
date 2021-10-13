<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'systemsetting'], function () {


    //General Setting
    Route::get('general-setting', 'SystemsettingController@general_setting')->name('general_setting')->middleware('userRolePermission:20');
    Route::get('edit-general-settings', 'SystemsettingController@edit_general_setting')->name('edit_general_settings')->middleware('userRolePermission:20');
    Route::post('update-general-settings', 'SystemsettingController@update_general_setting')->name('update_general_setting')->middleware('userRolePermission:20');


    Route::GET('/language-change', 'SystemsettingController@ajaxLanguageChangeMenu');
     Route::get('locale/{locale}', 'SystemsettingController@changeLocale');
     Route::get('change-language/{id}', 'SystemsettingController@changeLanguage');
    //Email Setting
    Route::get('email-setting', 'SystemsettingController@email_setting')->name('email-setting')->middleware('userRolePermission:20');
    Route::post('update-email-settings-data', 'SystemsettingController@updateEmailSettingsData')->name('update_email_setting')->middleware('userRolePermission:20');
    // Route::post('update-email-settings-data', 'SystemsettingController@update_email_setting')->name('update_email_setting')->middleware('userRolePermission:20');
    Route::post('test-mail', 'SystemsettingController@TestMail')->name('test_mail')->middleware('userRolePermission:20');


    //payment-method-setting
    Route::get('payment-method-setting', 'SystemsettingController@payment_method_setting')->name('payment-method-setting')->middleware('userRolePermission:20');

    
    Route::get('payment-method-disable/{id}', 'SystemsettingController@payment_method_disable')->name('payment_method_disable')->middleware('userRolePermission:20');
    Route::get('payment-method-enable/{id}', 'SystemsettingController@payment_method_enable')->name('payment_method_enable')->middleware('userRolePermission:20');


    Route::post('payment-method-store', 'SystemsettingController@payment_method_store')->name('payment_method_store')->middleware('userRolePermission:20');
    Route::post('payment-method-edit', 'SystemsettingController@payment_method_setting')->name('payment_method_edit')->middleware('userRolePermission:20');
    Route::get('payment-method-delete/{id}', 'SystemsettingController@payment_method_delete')->name('payment_method_delete')->middleware('userRolePermission:20');
    Route::get('payment-method-config/{id}', 'SystemsettingController@payment_method_config')->name('payment_method_config')->middleware('userRolePermission:20');
    Route::post('payment-method-update', 'SystemsettingController@payment_method_update')->name('payment_method_update')->middleware('userRolePermission:20');

    //Language
    Route::get('language-setting', 'SystemsettingController@language_setting')->name('language-setting')->middleware('userRolePermission:20');
    Route::get('language-setup/{id}', 'SystemsettingController@languageSetup')->name('languageSetup')->middleware('userRolePermission:20');
    Route::post('language-add', 'SystemsettingController@languageAdd')->name('languageAdd')->middleware('userRolePermission:20');
    Route::post('language-delete', 'SystemsettingController@languageDelete')->middleware('userRolePermission:20');
    Route::post('/language-change', 'SystemsettingController@ajaxLanguageChange')->middleware('userRolePermission:20');
    Route::post('translation-term-update', 'SystemsettingController@translationTermUpdate')->name('translationTermUpdate')->middleware('userRolePermission:20');
    //for localization
    Route::get('locale/{locale}', 'SystemsettingController@changeLocale');
    Route::get('change-language/{id}', 'SystemsettingController@changeLanguage');

    Route::get('ajaxSelectCurrency', 'SystemsettingController@ajaxSelectCurrency');

    //seo-setting
    Route::get('seo-setting', 'SystemsettingController@seo_setting')->name('seo-setting')->middleware('userRolePermission:20');
    Route::post('seo-setting-update', 'SystemsettingController@seo_setting_update')->name('seo-setting-update')->middleware('userRolePermission:20');


    //ajax theme change
    Route::get('theme-style-active', 'SystemsettingController@themeStyleActive');
    Route::get('theme-style-rtl', 'SystemsettingController@themeStyleRTL');

    Route::get('make-default-theme/{id}', 'SystemsettingController@colorThemeSet')->name('default_color_theme');

    //about system
    Route::get('about-system', 'SystemsettingController@aboutSystem')->name('aboutSystem')->middleware('userRolePermission:20');
    Route::post('updateSystem', 'UpdateController@updateSystemSubmit')->name('updateSystem')->middleware('userRolePermission:20');
    Route::get('third-party-api', 'SystemsettingController@googleAnalytics')->name('googleAnalytics')->middleware('userRolePermission:20');
    Route::post('google-analytics', 'SystemsettingController@google_analytics_setup')->name('google_analytics_setup')->middleware('userRolePermission:20');
    Route::post('fixer-setup', 'SystemsettingController@fixer_setup')->name('fixer_setup')->middleware('userRolePermission:20');

    Route::get('footer-setting', 'SystemsettingController@footer_setting')->name('footer-setting');
    Route::get('edit-footer-setting', 'SystemsettingController@edit_footer_setting')->name('edit-footer-setting');
    Route::post('update-footer-setting', 'SystemsettingController@update_footer_setting')->name('footer_setting_update');
    Route::get('purchase-key-setting', 'SystemsettingController@purchase_key_setting')->name('purchase-key-setting');
    Route::get('rtl-ltl-setting', 'SystemsettingController@rtl_ltl_setting')->name('rtl-ltl-setting');
    Route::get('theme-setting', 'SystemsettingController@theme_setting')->name('theme-setting')->middleware('userRolePermission:20');
    Route::get('site-image-setting', 'SystemsettingController@site_image_setting')->name('site-image-setting')->middleware('userRolePermission:22');
    Route::post('site-image-change', 'SystemsettingController@sitePic')->name('site_image_change')->middleware('userRolePermission:22');

    //Image
    Route::match(['get', 'post'], 'ajax-image-upload', 'SystemsettingController@ajaxImage');
    Route::delete('ajax-remove-image/{filename}', 'SystemsettingController@deleteImage');

    //Backup Setting
    Route::post('backup-store', 'SystemsettingController@BackupStore')->name('backup-store')->middleware('userRolePermission:20');
    Route::get('backup-settings', 'SystemsettingController@backupSettings')->name('backup-settings')->middleware('userRolePermission:20');
    Route::get('get-backup-files/{id}', 'SystemsettingController@getfilesBackup')->middleware('userRolePermission:20');
    Route::get('get-backup-db', 'SystemsettingController@getDatabaseBackup')->middleware('userRolePermission:20');
    Route::get('download-database/{id}', 'SystemsettingController@downloadDatabase')->middleware('userRolePermission:20');
    Route::get('download-files/{id}', 'SystemsettingController@downloadFiles')->middleware('userRolePermission:20');
    Route::get('restore-database/{id}', 'SystemsettingController@restoreDatabase')->middleware('userRolePermission:20');
    Route::get('delete-database/{id}', 'SystemsettingController@deleteDatabase')->name('delete_database')->middleware('userRolePermission:20');



    Route::get('footer-custom-link','SystemsettingController@FooterCustomLink')->name('FooterCustomLink')->middleware('userRolePermission:22');
    Route::post('footer-custom-link/update','SystemsettingController@customLinksUpdate')->name('customLinksUpdate')->middleware('userRolePermission:22');

    // role permission 
      Route::get('role-permission', 'RolePermissionController@role')->name('role-permission')->middleware('userRolePermission:20');
      Route::get('assign-permission', 'RolePermissionController@AssignRolePermission')->name('assign-permission')->middleware('userRolePermission:20');
      Route::post('assign-permission', 'RolePermissionController@AssignRolePermissionUpdate')->name('assign_permission_update')->middleware('userRolePermission:20');

      Route::post('update_error_msg','SystemsettingController@updateErrorMsg');
      Route::post('update_login_msg','SystemsettingController@updateLoginMsg');
      
});

 //Module Manage
 Route::group(['middleware' => ['auth', 'verified', 'admin']], function () {      
    Route::get('manage-adons', 'InfixAddOnsController@ManageAddOns')->name('manage-adons');
    Route::get('manage-adons-delete/{name}', 'InfixAddOnsController@ManageAddOns')->name('deleteModule');
    Route::get('manage-adons-enable/{name}', 'InfixAddOnsController@moduleAddOnsEnable')->name('moduleAddOnsEnable');
    Route::get('manage-adons-disable/{name}', 'InfixAddOnsController@moduleAddOnsDisable')->name('moduleAddOnsDisable');

    Route::post('manage-adons-validation', 'InfixAddOnsController@ManageAddOnsValidation')->name('ManageAddOnsValidation');
    Route::get('ModuleRefresh', 'InfixAddOnsController@ModuleRefresh')->name('ModuleRefresh');
});