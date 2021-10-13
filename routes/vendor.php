<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XSS']], function () {
        
    Route::group(['middleware' => ['auth','verified'],'namespace' => 'Frontend','prefix'=>'author', 'as' => 'author.'], function () {
        // Start payment gateway 
        Route::post('payment-add','PaymentController@AddPayment')->name('payment_add');
        // End payment gateway 
    });

    //   =====================================Start Vendor========================================================

    Route::get('login/{provider}', 'Auth\RegisterController@redirectToProvider');
    Route::get('login/{provider}/callback','Auth\LoginController@handleProviderCallback');

    route::get('registration','Auth\LoginController@Password_create');
    route::post('registration','Auth\LoginController@Password_store')->name('password.store');

    Route::post('ckeditor/image_upload', 'CkEditorController@featureUpload')->name('ckeditor_upload');

    Route::group(['middleware' => ['auth','verified','vendorCheck'],'namespace' => 'Frontend\Vendor','prefix'=>'author', 'as' => 'author.'], function () {
        Route::get('followers/{id}','VendorController@followers')->name('followers');
        Route::get('followings/{id}','VendorController@followings')->name('followings');
        Route::get('profile/{id}','VendorController@profile')->name('profile');
        Route::get('portfolio/{id}','VendorController@portfolio')->name('portfolio');
        Route::get('dashboard/{id}','VendorController@dashboard')->name('dashboard');
        Route::get('setting/{id}','VendorController@setting')->name('setting');
        Route::get('download/{id}','VendorController@download')->name('download');
        Route::get('statement/{id}','VendorController@statement')->name('statement');
        Route::get('payout/{id}','VendorController@payout')->name('payout');
        Route::get('earning/{id}','VendorController@earning')->name('earning');
        Route::get('hidden-item/{id}','VendorController@hiddenItem')->name('hiddenItem');
        Route::get('reviews/{id}','VendorController@reviews')->name('reviews');
        Route::get('refunds/{id}','VendorController@refunds')->name('refunds');
        //chart
        Route::get('chart/{data?}','VendorController@chart');
        Route::get('country-data','VendorController@countrydata');
        //end Chart
        //Start Satatement
        Route::get('statement-data/','VendorController@statementData');
        Route::get('statement-search/','VendorController@statementsearch');

        
        Route::POST('setup-payout','AuthorPayoutSetupController@setupPayout')->name('setup_payout');
        Route::get('set-payout-default/{method}','AuthorPayoutSetupController@defaultPayoutSetup')->name('defaultPayoutSetup');
        //end Satatement
        Route::get('item/download/file/{id}', 'VendorController@ProductDownload')->name('ProductDownload');
        
        // Start Product
        Route::get('content','ItemController@content')->name('content');
        Route::post('content/select','ItemController@contentSelect')->name('contentSelect');
        Route::get('file-view','ItemController@fileView')->name('fileView');
        Route::post('files','ItemController@files')->name('files');
        Route::post('files-delete','ItemController@filesDelete')->name('filesDelete');
        Route::post('item-store','ItemController@itemStore')->name('itemStore');
        Route::get('item-edit/{id}','ItemController@itemEdit')->name('itemEdit');
        Route::post('item-update','ItemController@itemUpdate')->name('itemUpdate');
        Route::get('item-delete/{id}','ItemController@itemDelete')->name('itemDelete');
        // end Product
        // start setting
        Route::post('personal-update/{id}','VendorController@personalUpdate')->name('personalUpdate');
        
        Route::get('state/{name}','VendorController@state');
        Route::get('city/{name}','VendorController@city');
        // end setting

        //Start Coupon
        Route::get('coupon/{username}','CouponController@index')->name('coupon_list');
        Route::get('coupon-add','CouponController@CouponAdd')->name('CouponAdd');
        Route::get('coupon-expire','CouponController@CouponExpire')->name('CouponExpire');
        Route::get('coupon-inactive','CouponController@CouponInactive')->name('CouponInactive');
        Route::get('/coupon-delete','CouponController@Coupon_Delete_view')->name('Coupon_Delete_view');
        Route::post('coupon-store','CouponController@couponStore')->name('couponStore');
        Route::get('coupon-edit/{id}','CouponController@couponEdit')->name('couponEdit');
        Route::post('coupon-update/{id}','CouponController@couponUpdate')->name('couponUpdate');
        Route::get('coupon-delete/{id}','CouponController@couponDelete')->name('couponDelete');
        Route::get('coupon-restore/{id}','CouponController@couponRestore')->name('couponRestore');
        //End Coupon

        // Refund 
        Route::get('refund-view/{id}', 'VendorController@refundView')->name('refundView');
        Route::post('refund-comment', 'VendorController@refundComment')->name('refundComment');
        Route::get('refund-decline/{id}', 'VendorController@refundDecline')->name('refundDecline');
        Route::get('refund-approve/{id}', 'VendorController@refundApprove')->name('refundApprove');
        //End Refund

         // password change
        Route::post('author-change-password', 'VendorController@password_update');


       
        
    });

    //   =====================================End Vendor=========================================================
});