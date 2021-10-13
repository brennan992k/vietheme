<?php

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

use Illuminate\Routing\Route;

Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'pages'], function () {


    // privacy-policy
    
    Route::get('privacy-policy', 	'PagesController@privacyPolicy')->name('privacy-policy')->middleware('userRolePermission:21');
    Route::post('privacy-policy-update', 	'PagesController@privacyPolicyUpdate')->name('privacy-policy-update')->middleware('userRolePermission:21');


    // terms-conditions
    Route::get('terms-conditions', 	'PagesController@termsConditions')->name('terms-conditions')->middleware('userRolePermission:21');
    Route::post('terms-conditions-update', 	'PagesController@termsConditionsUpdate')->name('terms-conditions-update')->middleware('userRolePermission:21');


    // about-company
    Route::get('about-company', 	'PagesController@aboutCompany')->name('about-company')->middleware('userRolePermission:21');
    Route::post('about-company-update', 	'PagesController@aboutCompanyUpdate')->name('about-company-update')->middleware('userRolePermission:21');




    // about-company
    Route::get('faqs', 	'PagesController@faqs')->name('faqs')->middleware('userRolePermission:21');
    Route::post('faqs-store', 	'PagesController@faqs_store')->name('faqs-store')->middleware('userRolePermission:21');
    Route::get('faqs-edit/{id}', 	'PagesController@faqs_edit')->name('faqs-edit')->middleware('userRolePermission:21');
    Route::post('faqs-update', 	'PagesController@faqs_update')->name('faqs-update')->middleware('userRolePermission:21');
    Route::get('faqs-delete/{id}', 	'PagesController@faqs_delete')->name('faqs-delete')->middleware('userRolePermission:21');


    Route::get('home-page','PagesController@HomePage')->name('HomePage')->middleware('userRolePermission:21');
    Route::post('home-page-update','PagesController@home_page_update')->name('home-page-update')->middleware('userRolePermission:21');

    Route::get('coupon-text','PagesController@coupon_text')->name('couponText')->middleware('userRolePermission:21');
    Route::post('coupon-text-update','PagesController@coupon_text_update')->name('coupon-text-update')->middleware('userRolePermission:21');



    //Market Apis 
    Route::get('market-apis', 	'PagesController@marketApis')->name('market-apis')->middleware('userRolePermission:21');
    Route::post('market-apis-update', 	'PagesController@marketApisUpdate')->name('market-apis-update')->middleware('userRolePermission:21');

    
    //Market Apis 
    Route::get('become-author', 	'PagesController@becomeAuthor')->name('become-author')->middleware('userRolePermission:21');
    Route::post('become-author', 	'PagesController@becomeAuthorUpdate')->name('become-author-store')->middleware('userRolePermission:21');

    


    //Item Support
    Route::get('item-support', 	'PagesController@itemSupport')->name('item-support')->middleware('userRolePermission:21');
    Route::post('item-support-update', 	'PagesController@itemSupportUpdate')->name('item-support-update')->middleware('userRolePermission:21');

    // License
    Route::get('license','PagesController@LicensePage')->name('LicensePage')->middleware('userRolePermission:21');
    Route::post('license-page-update','PagesController@LicensePageUpdate')->name('LicensePageUpdate')->middleware('userRolePermission:21');
    // Ticket
    Route::get('ticket','PagesController@TicketPage')->name('TicketPage')->middleware('userRolePermission:21');
    Route::post('ticket-page-update','PagesController@TicketPageUpdate')->name('TicketPageUpdate')->middleware('userRolePermission:21');
    
    // Profile Settings
    Route::get('profile-setting','PagesController@ProfileSetting')->name('ProfileSetting')->middleware('userRolePermission:21');
    Route::post('profile-setting-update','PagesController@ProfileSettingUpdate')->name('ProfileSettingUpdate')->middleware('userRolePermission:21');

});