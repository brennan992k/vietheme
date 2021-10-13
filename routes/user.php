<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

Route::group(['middleware' => ['XSS']], function () {
    
  //customer

  Route::get('author/profile/{username}', 'Frontend\HomeController@vendor');

  Route::group(['namespace' => 'Frontend', 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('followers/{username}', 'HomeController@followers')->name('followers');
    Route::get('followings/{username}', 'HomeController@followings')->name('followings');
    Route::get('profile/{username}', 'HomeController@profile')->name('profile');
    Route::get('portfolio/{username}', 'HomeController@portfolio')->name('portfolio');

    Route::post('vendor_api_update', 'HomeController@ApiTokenUpdate')->name('ApiTokenUpdate');
  });

  

  Route::get('customer/login/{provider}', 'Frontend\Customer\RegistrationController@redirectToProvider');

  Route::post('customer/registration', 'Frontend\Customer\RegistrationController@register');


  Route::group(['middleware' => ['auth', 'verified'], 'namespace' => 'Frontend\Customer', 'as' => 'user.'], function () {

    /*Social Media Setting */
    Route::post('profile/social-store', 'CustomerController@socialStore')->name('socialStore');
    Route::post('profile/social-update', 'CustomerController@socialUpdate')->name('socialUpdate');

    

    /* ******************** START COMMENT ROUTES ********************* */
    Route::post('user/comment', 'CustomerController@commentStore')->name('comment');
    Route::post('user/reply', 'CustomerController@replyStore')->name('reply');
    Route::post('user/review', 'CustomerController@ReviewStore')->name('review');
    /* ******************** END COMMENT ROUTES ********************* */

    /* ******************** START SUPPORT ROUTES ********************* */
    Route::post('user/support', 'CustomerController@UserSupport')->name('UserSupport');
    /* ******************** END SUPPORT ROUTES ********************* */

    /* ******************** START SUPPORT ROUTES ********************* */
    Route::post('user/support', 'CustomerController@UserSupport')->name('UserSupport');
    /* ******************** END SUPPORT ROUTES ********************* */

    /* ******************** START FOLLOW ROUTES ********************* */
    Route::get('user/follow/{id}', 'CustomerController@UserFollow')->name('UserFollow');
    Route::get('user/unfollow/{id}', 'CustomerController@UserUnfollow')->name('User');
    /* ******************** END FOLOOW ROUTES ********************* */
    //affiliate
    Route::get('affiliate/', 'CustomerController@affiliate')->name('affiliate');
  });


  Route::group(['middleware' => ['auth', 'verified', 'CheckUser'], 'namespace' => 'Frontend\Customer', 'as' => 'customer.'], function () {

    // Start Save credit card
    Route::post('customer/payment-add','CustomerController@AddPayment')->name('payment_add');
    Route::get('customer/payment-delete','CustomerController@DeletePayment')->name('payment_delete');
    // End Save credit card

    /* ******************** START CUSTOMER ROUTES ********************* */
    Route::get('profile/{username}', 'CustomerController@profile')->name('profile');
    Route::get('downloads/{username}', 'CustomerController@downloads')->name('downloads');
  
    Route::get('setting/{username}', 'CustomerController@setting')->name('setting');
    Route::post('profile/update/{username}', 'CustomerController@personalUpdate')->name('personalUpdate');

    // password  change
    Route::post('customer-change-password', 'CustomerController@password_update');
    /* ******************** END CUSTOMER ROUTES ********************* */

    // Route::POST('bank_payment','CustomerController@bank_payment')->name('bank_payment');
  });
  // ticket 
  Route::group(['middleware' => ['auth', 'verified'], 'namespace' => 'Frontend\Ticket', 'as' => 'user.'], function () {
    route::get('ticket-view/{id}', 'UserController@ticket_view')->name('ticket_view');
    route::get('add-ticket', 'UserController@add_ticket')->name('add_ticket');
    route::post('ticket-store', 'UserController@ticket_store')->name('ticket_store');
    route::get('ticket-edit/{id}', 'UserController@ticket_edit')->name('ticket_edit');
    route::post('ticket-update/{id}', 'UserController@ticket_update')->name('ticket_update');
    route::get('ticket-delete-view/{id}', 'UserController@ticket_delete_view')->name('ticket_delete_view');
    route::get('ticket-delete/{id}', 'UserController@ticket_delete')->name('ticket_delete');
    route::get('ticket-reopen/{id}', 'UserController@reopen_ticket')->name('reopen_ticket');
    route::get('ticket-active', 'UserController@active_ticket')->name('active_ticket');
    route::get('ticket-complete', 'UserController@complete_ticket')->name('completed_ticket');

    //comment
    Route::post('comment-store', 'UserController@comment_store')->name('comment_store');
    Route::post('comment-reply', 'UserController@comment_reply')->name('comment_reply');
  });
  Route::get('download-comment-document/{file_name}', function ($file_name = null) {
    $file = public_path() . '/uploads/comment/' . $file_name;
    if (file_exists($file)) {
      return Response::download($file);
    }
  });

  Route::post('resend-verification-email','Auth\ResendVerificationController@resendVerificationEmail')->name('verification_resend');
  Route::get('verify_user/{token}','Auth\ResendVerificationController@userVerify')->name('verify_new_user');

});