<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XSS']], function () {


   Route::get('/', 'Frontend\HomeController@index');
   Route::get('logout', 'Frontend\HomeController@logout');
   Route::get('/package-plan', 'Frontend\HomeController@packagePlan')->name('packagePlan');
   Route::get('/help/faq', 'Frontend\HomeController@faqPage')->name('faqPage');
   Route::get('/help/knowledge-base', 'Frontend\HomeController@knowledgeBase')->name('knowledgeBase');
   Route::get('/privacy-policy', 'Frontend\HomeController@privacyPolicy')->name('privacyPolicy');
   Route::get('/terms-conditions', 'Frontend\HomeController@termsConditions')->name('termsConditions');
   Route::get('/about_company', 'Frontend\HomeController@aboutCompany')->name('about_company');
   Route::get('/support-ticket', 'Frontend\HomeController@SupportTicket')->name('SupportTicket');
   Route::get('/license', 'Frontend\HomeController@License')->name('License');

   Route::GET('frontend/language-change', 'FrontendLanguageChange@ajaxLanguageChangeMenu');
   Route::get('frontend/locale/{locale}', 'FrontendLanguageChange@changeLocale');

   Route::GET('/search-menu', 'SearchController@search')->name('search');

   Route::group(['middleware' => ['auth', 'verified'], 'namespace' => 'Frontend', 'as' => 'user.'], function () {

      /* ******************** START PROFILE PIC ROUTES ********************* */
      Route::post('profile-pic/{id}', 'UserController@profilePic')->name('profilePic');
      /* ******************** END PROFILE PIC ROUTES ********************* */

      /* ******************** START PACKAGE BUY ROUTES ********************* */
      Route::get('/package-plan/{plan}', 'HomeController@packageOption')->name('packageOption');
      Route::get('/package/{plan}', 'HomeController@packagePrice');
      Route::post('/package/buy/', 'HomeController@packageBuy')->name('packageBuy');
      Route::post('/package-payment', 'HomeController@packagePayment')->name('packagePayment');
      Route::post('/package-paid', 'HomeController@packagePaid')->name('packagePaid');
      Route::get('/payment-main-balance/{price}', 'HomeController@payment_main_balance');
      Route::get('/payment-package', 'HomeController@payment')->name('payment');
      /* ******************** END PACKAGE BUY ROUTES ********************* */

      // start item buy payment
      Route::post('/item/payment', 'PaymentController@ItemPayment')->name('ItemPayment');
      // paypal
      Route::post('/item/payment-paypal', 'PaymentController@ItemPaymentPaypal')->name('ItemPaymentPaypal');
      //Paypal START
      Route::get('/paypal/payment/done', 'PaypalController@getDone')->name('payment.done');
      Route::get('/paypal/payment/cancel', 'PaypalController@getCancel')->name('payment.cancel');
      //Paypal END
      //Razor START
      Route::get('razor-payment', 'RazorpayController@Razorpayment')->name('payment_razor');
      Route::post('razor/payment/pay-success', 'RazorpayController@payment')->name('payment.razer');
      //RAZOR END
      Route::post('/item/package-payment', 'PaymentController@ItempackagePayment')->name('ItempackagePayment');
      Route::post('/item/payment/main-balance', 'PaymentController@payment_main_balance')->name('payment_main_balance');

      //=====================START PRODUCT DOWNLOAD ========================
      Route::get('item/download/file_lic/{id}', 'Customer\ProductDownloadController@ProductLicence')->name('ItemDownloadAll');
      Route::get('item/download/file/{id}', 'Customer\ProductDownloadController@ProductDownload')->name('ProductDownload');
      Route::get('item/download/licence/{id}', 'Customer\ProductDownloadController@LicenceDownload')->name('LicenceDownload');
      // download item notify

      // start free download   
      Route::get('free-item/download/file_lic/{id}', 'Customer\ProductDownloadController@FreeProductLicence')->name('FreeItemDownloadAll');
      /*    Route::get('free-item/download/file/{id}', 'Customer\ProductDownloadController@FreeProductDownload')->name('FreeProductDownload');
      Route::get('free-item/download/licence/{id}', 'Customer\ProductDownloadController@FreeLicenceDownload')->name('FreeLicenceDownload'); */
      // end free download

      //=====================END PRODUCT DOWNLOAD ========================

      // start become an aurhor 
      Route::get('/become/author', 'HomeController@BecomeAuthor')->name('BecomeAuthor');
      Route::post('/become/author', 'HomeController@BecomeAuthorconfirm')->name('BecomeAuthorconfirm');
      // end become an aurhor 
   });
   //country state
   Route::get('user/state/{name}', 'Frontend\HomeController@state');
   Route::get('user/city/{name}', 'Frontend\HomeController@city');
   //end countrty
   /* ::::::::::::::::::::::::: START LOGIN/REGISTRATION ROUTES :::::::::::::::::::::::::: */
   Route::group(['middleware' => ['CheckUser']], function () {
      Route::get('admin/login', function () {
         // return view('auth.login_two');
         return view('auth.sign_in');
      });
      Route::get('customer/register', 'Auth\RegisterController@CustomerRegistrationForm')->name('customer.registration');
      Route::post('customer/register', 'Auth\RegisterController@customerRegistration')->name('customer_registration');

      Route::get('customer/login', function () {
         return view('auth.sign_in');
         return view('auth.customer_login');
      });
      Route::get('customer/forget-password', 'Auth\ForgotPasswordController@CustomerForgetPasswordForm')->name('customer.forget.password');
      Route::post('customer/forget-password', 'Auth\ForgotPasswordController@CustomerForgetPassword')->name('customer.forget.password.submit');
   });

   /* ::::::::::::::::::::::::: END LOGIN/REGISTRATION ROUTES :::::::::::::::::::::::::: */




   /* ::::::::::::::::::::::::: START FEATURE ITEM ROUTES :::::::::::::::::::::::::: */
   Route::get('featureitem/', 'Frontend\HomeController@featureitem');
   Route::get('featureitem/image/{id}', 'Frontend\HomeController@featureitemImage');
   /* ::::::::::::::::::::::::: START FEATURE ITEM ROUTES :::::::::::::::::::::::::: */

   /* ::::::::::::::::::::::::: START FREE ITEM ROUTES :::::::::::::::::::::::::: */
   Route::get('free-item/', 'Frontend\HomeController@free_item');
   Route::get('free-items/', 'Frontend\HomeController@free_items')->name('free_items');
   Route::get('search/free-item/', 'Frontend\HomeController@FreeWiseItem');


   /* ::::::::::::::::::::::::: START FREE ITEM ROUTES :::::::::::::::::::::::::: */



   /* ::::::::::::::::::::::::: START SEARCH ROUTES :::::::::::::::::::::::::: */
   Route::get('homesearch/', 'Frontend\HomeController@homefilter');
   Route::get('by_search/{item?}', 'Frontend\HomeController@searchItem');
   Route::get('by_search/{date}/{date_time}', 'Frontend\HomeController@dateItem')->name('dateItem');
   Route::any('by_search/', 'Frontend\HomeController@formSearch')->name('_by_search');
   Route::get('feature-item/', 'Frontend\HomeController@feature_item')->name('feature_item');
   Route::get('search/category/{categoryname}/{subcategoryname?}', 'Frontend\HomeController@searchCategoryItem')->name('searchCategoryItem');
   Route::get('itemsearch/', 'Frontend\HomeController@itemsearch');
   Route::get('search/item/', 'Frontend\HomeController@SearchWiseItem');


   /* ::::::::::::::::::::::::: START SEARCH ROUTES :::::::::::::::::::::::::: */


   Auth::routes(['verify' => true]);
   Route::get('/home', 'HomeController@index')->name('home');
   Route::get('/license-details', 'Frontend\HomeController@license_details')->name('license_details');

   Route::group(['prefix' => 'paypal'], function () {

      Route::get('payment', 'Frontend\PayPalPaymentController@index');
      Route::post('charge', 'Frontend\PayPalPaymentController@charge')->name('paypal_payment');
      Route::get('paymentsuccess', 'Frontend\PayPalPaymentController@payment_success');
      Route::get('paymenterror', 'Frontend\PayPalPaymentController@payment_error');

      Route::post('deposit', 'Frontend\PayPalDepositController@deposit')->name('paypal_deposit');
      Route::get('depositsuccess', 'Frontend\PayPalDepositController@payment_success');
      Route::get('depositerror', 'Frontend\PayPalDepositController@payment_error');
   });

   // item 

   Route::group(['namespace' => 'Frontend'], function () {
      // Route::group(['middleware' => ['auth'], 'namespace' => 'Frontend'], function () {

      Route::get('item/{title}/{id}', 'ItemController@singleProduct')->name('singleProduct');

      /* ********************* START CART ROUTES ********************* */
      Route::post('item/cart', 'ItemController@AddCart')->name('AddCartItem');
      Route::post('item/cart/quick', 'ItemController@QuickAddCart')->name('QuickAddCart');
      Route::post('item/buy', 'ItemController@AddBuy')->name('AddBuy');
      Route::post('item/cart/checkout', 'ItemController@AddCartBuy')->name('AddCartBuy');
      Route::get('cart', 'ItemController@Cart')->name('Cart');
      Route::get('cart/delete/{id}', 'ItemController@CartDelete')->name('CartDelete');
      Route::post('cart/update/{id}', 'ItemController@CartUpdate')->name('CartUpdate');
      Route::get('cart/delete-all', 'ItemController@CartDeleteAll')->name('CartDeleteAll');
      /* ******************** END CART ROUTES ********************* */

      /* ******************** START CATEGORY WISE ITEM ROUTES ********************* */

      Route::get('category/{categoryname}/{subcategoryname?}', 'HomeController@categoryItem')->name('categoryItem');
      Route::get('category/sub/{categoryname}/{subcategoryname}', 'HomeController@SubCategoryItem')->name('SubCategoryItem');
      Route::get('by_category/{categoryname}/{attribute?}/{tag?}', 'HomeController@tagCatItem')->name('tagCatItem');
      Route::get('by_category/{categoryname}/{subcategoryname?}/{attribute}/{tag?}', 'HomeController@tagSubItem')->name('tagSubItem');
      Route::get('category/', 'HomeController@categoryWiseItem');
      Route::get('tag/', 'HomeController@tagWiseItem');

      /* ******************** END CATEGORY WISE ITEM ROUTES ********************* */
   });

   Route::group(['middleware' => ['auth', 'verified', 'CheckDashboardMiddleware'], 'namespace' => 'Frontend', 'as' => 'user.'], function () {

      /* ::::::::::::::::::::::::: START REFUND POLICY ROUTES :::::::::::::::::::::::::: */
      Route::get('refund-request/', 'HomeController@refundRequest')->name('refundRequest');
      Route::post('refund-store/', 'HomeController@refundStore')->name('refundStore');
      /* ::::::::::::::::::::::::: END REFUND POLICY  ROUTES :::::::::::::::::::::::::: */

      // Start Fund deposit
      Route::get('fund-deposit/{username}', 'FundDepositController@FundDeposit')->name('deposit');
      Route::post('fund-deposit-store', 'FundDepositController@FundDepositStore')->name('depositStore');
      // paypal 
      Route::post('paypal-fund-deposit', 'PaypalController@paypalDepositAdd')->name('paypalDepositAdd');
      Route::get('/paypal/fund-deposit/done', 'PaypalController@FundgetDone');
      Route::post('paypal-fund-deposit-store', 'PaypalController@paypalDeposit')->name('paypal_deposit');
      //stripe
      Route::post('stripe-fund-deposit-store', 'FundDepositController@StripeDeposit')->name('stripe_deposit');
      //razorpay
      Route::post('razorpay-fund-deposit-store', 'FundDepositController@RazorDeposit')->name('deposit_payment.razer');
      Route::get('fund-deposit-payment-selection', 'FundDepositController@FundDepositPaymentSelection')->name('FundDepositPaymentSelection');
      // End Fund deposit
      // get notify email update
      Route::get('user-update-item-email/{id}', 'Customer\ProductDownloadController@ItemUpdateNotify');


      Route::POST('bank_payment', 'Customer\CustomerController@bank_payment')->name('bank_payment');
   });

   Route::group(['middleware' => ['auth', 'verified', 'CheckDashboardMiddleware'], 'namespace' => 'Frontend', 'prefix' => 'customer', 'as' => 'customer.'], function () {
      Route::get('dashboard', 'Customer\CustomerController@index')->name('dashboard');

      /* ******************** START CHECKOUT ROUTES ********************* */
      Route::get('checkout', 'CheckoutController@index')->name('cheackout');
      Route::post('checkout/store', 'CheckoutController@store')->name('store');
      Route::get('payment', 'CheckoutController@payment')->name('payment');
      Route::post('payment/store', 'CheckoutController@payment_store')->name('payment_store');
      Route::post('coupon/check', 'CheckoutController@couponCheck')->name('couponCheck');
      Route::get('payment/complete', 'CheckoutController@payment_complete')->name('payment_complete');
      /* ******************** END CHECKOUT ROUTES ********************* */

      /* ******************** START EMAIL SETTINGS ROUTES ********************* */

      Route::post('email-settings-store', 'EmailNotificationSettingsController@store')->name('userEmailNotificationStore');
      Route::post('email-settings-update', 'EmailNotificationSettingsController@update')->name('userEmailNotificationUpdate');
      /* ******************** END EMAIL SETTINGS ROUTES ********************* */
   });




   // Start Market APIs

   Route::group(['namespace' => 'Frontend'], function () {
      Route::get('market-apis', 'HomeController@market_apis')->name('marketApis');
   });

   Route::get('mail-send', 'Frontend\EmailNotificationSettingsController@Emailsent');
   // End Market APIs
});
