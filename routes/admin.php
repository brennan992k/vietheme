<?php

use Illuminate\Support\Facades\Route;

Route::post('/search', 'Frontend\HomeController@search')->name('search');

Route::group(['middleware' => ['auth', 'verified', 'admin']], function () {

    Route::get('admin/file-view', 'Frontend\Vendor\ItemController@fileView')->name('fileView');
    Route::post('admin/files', 'Frontend\Vendor\ItemController@files')->name('files');
    Route::get('admin/files-delete/{id}', 'Frontend\Vendor\ItemController@filesDeleteAdmin')->name('filesDeleteAdmin');
    /* ::::::::::::::::::::::::: START ADMIN ROUTES :::::::::::::::::::::::::: */

    Route::group(['middleware' => ['auth', 'verified', 'admin'], 'namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::get('addons-setting', 'DashboardController@addonsSetting')->name('addons-setting');
        Route::get('modules/{id}', 'DashboardController@addonsSetting');

        Route::get('dashboard', 'DashboardController@index')->name('dashboard')->middleware('userRolePermission:1');
        Route::get('dashboard/chart', 'DashboardController@DashboardChart');
        Route::get('profile/{id}', 'UserController@profile')->name('profile');
        Route::get('profile-edit/{id}', 'UserController@profile_edit')->name('profile_edit');
        Route::post('profile-update/{id}', 'UserController@profile_update')->name('profile_update');
        //userlo
        Route::get('user-log', 'UserController@userLog')->name('userLog')->middleware('userRolePermission:2');
        Route::get('user-log-delete/{id}', 'UserController@userLogDelete')->name('userLogDelete')->middleware('userRolePermission:2');
        //vendor
        Route::get('vendor', 'UserController@vendor')->name('vendor')->middleware('userRolePermission:2');
        Route::get('vendor/{id}', 'UserController@vendor_view')->name('vendor_view')->middleware('userRolePermission:2');
        Route::get('vendor/edit/{id}', 'UserController@vendor_edit')->name('vendor_edit')->middleware('userRolePermission:2');
        Route::post('vendor/update/{id}', 'UserController@vendor_update')->name('vendor_update')->middleware('userRolePermission:2');
        Route::get('vendor-status-change/{id}', 'UserController@statusChange')->name('status_change')->middleware('userRolePermission:2');
        Route::get('vendor-status-changed/{id}', 'UserController@statusChanged')->name('status_changed')->middleware('userRolePermission:2');
        Route::get('vendor-delete/{id}', 'UserController@vendorDelete')->name('vendorDelete')->middleware('userRolePermission:2');
        Route::any('vendor-deleted/{id}', 'UserController@vendorDeleted')->name('vendorDeleted')->middleware('userRolePermission:2');

        Route::get('login-access-permission', 'UserController@loginAccessPermission')->name('login_permission');
        Route::get('user/approve', 'UserController@userApprove')->name('userApprove');
        //customer
        Route::get('customer', 'UserController@customer')->name('customer')->middleware('userRolePermission:2');
        Route::get('customer/{id}', 'UserController@customer_view')->name('customer_view')->middleware('userRolePermission:2');
        Route::get('customer/edit/{id}', 'UserController@customer_edit')->name('customer_edit')->middleware('userRolePermission:2');
        Route::post('customer/update/{id}', 'UserController@customer_update')->name('customer_update')->middleware('userRolePermission:2');
        Route::get('customer-status-change/{id}', 'UserController@CustomerstatusChange')->name('CustomerstatusChange')->middleware('userRolePermission:2');
        Route::get('customer-status-changed/{id}', 'UserController@CustomerstatusChanged')->name('CustomerstatusChanged')->middleware('userRolePermission:2');
        Route::get('customer-delete/{id}', 'UserController@customerDelete')->name('customerDelete')->middleware('userRolePermission:2');
        Route::get('customer-deleted/{id}', 'UserController@customerDeleted')->name('customerDeleted')->middleware('userRolePermission:2');

       
        //end customer
        //Agent
        Route::get('agent', 'UserController@agent')->name('agent')->middleware('userRolePermission:2');
        Route::get('agent/{id}', 'UserController@agent_view')->name('agent_view')->middleware('userRolePermission:2');
        Route::get('agent/edit/{id}', 'UserController@agent_edit')->name('agent_edit')->middleware('userRolePermission:2');
        Route::post('agent/update/{id}', 'UserController@agent_update')->name('agent_update')->middleware('userRolePermission:2');
        Route::get('agent-status-change/{id}', 'UserController@agentstatusChange')->name('agentstatusChange')->middleware('userRolePermission:2');
        Route::get('agent-status-changed/{id}', 'UserController@agentstatusChanged')->name('agentstatusChanged')->middleware('userRolePermission:2');
        Route::get('agent-delete/{id}', 'UserController@agentDelete')->name('agentDelete')->middleware('userRolePermission:2');
        Route::get('agent-deleted/{id}', 'UserController@agentDeleted')->name('agentDeleted')->middleware('userRolePermission:2');

        //end Agent
        Route::get('registration-bonus', 'UserController@registrationBonus')->name('registrationBonus')->middleware('userRolePermission:2');
        Route::post('registration-bonus-store', 'UserController@registrationBonusStore')->name('registrationBonusStore')->middleware('userRolePermission:2');
        Route::get('registration-bonus-edit/{id}', 'UserController@editregistrationBonus')->name('editregistrationBonus')->middleware('userRolePermission:2');
        Route::post('registration-bonus-update', 'UserController@updateregistrationBonus')->name('updateregistrationBonus')->middleware('userRolePermission:2');
        Route::get('registration-bonus-delete/{id}', 'UserController@deleteregistrationBonus')->name('deleteregistrationBonus')->middleware('userRolePermission:2');
        // Product

        /* ******************** START CATEGORY ROUTES ********************* */
        Route::get('add-category', 'ProductController@adCategory')->name('adCategory')->middleware('userRolePermission:5');
        Route::post('add-category-store', 'ProductController@adCategoryStore')->name('adCategoryStore')->middleware('userRolePermission:5');
        Route::get('add-category-edit/{id}', 'ProductController@editCategory')->name('editCategory')->middleware('userRolePermission:5');
        Route::post('add-category-store-update', 'ProductController@updateCategory')->name('updateCategory')->middleware('userRolePermission:5');
        Route::get('add-category-delete/{id}', 'ProductController@deleteCategory')->name('deleteCategory')->middleware('userRolePermission:5');
        /* ********************* END CATEGORY ROUTES ********************* */

        /* ******************** START SUB CATEGORY ROUTES ********************* */
        Route::get('sub-category', 'ProductController@subCategory')->name('subCategory')->middleware('userRolePermission:5');
        Route::post('sub-category-store', 'ProductController@subCategoryStore')->name('subCategoryStore')->middleware('userRolePermission:5');
        Route::get('sub-category-edit/{id}', 'ProductController@editSubCategory')->name('editSubCategory')->middleware('userRolePermission:5');
        Route::post('sub-category-update', 'ProductController@updateSubCategory')->name('updateSubCategory')->middleware('userRolePermission:5');
        Route::get('sub-category-delete/{id}', 'ProductController@deleteSubCategory')->name('deleteSubCategory')->middleware('userRolePermission:5');

        /* ********************* END SUB CATEGORY ROUTES ********************* */

        /* ******************** START Attributes ROUTES ********************* */
        Route::get('attributes', 'AttributeController@attributes')->name('attributes')->middleware('userRolePermission:5');
        Route::post('attributes-store', 'AttributeController@attributesStore')->name('attributesStore')->middleware('userRolePermission:5');
        Route::get('attributes-edit/{id}', 'AttributeController@editattributes')->name('editattributes')->middleware('userRolePermission:5');
        Route::post('attributes-update', 'AttributeController@updateattributes')->name('updateattributes')->middleware('userRolePermission:5');
        Route::get('attributes-delete/{id}', 'AttributeController@deleteattributes')->name('deleteattributes')->middleware('userRolePermission:5');

        /* ********************* END Attributes ROUTES ********************* */
        /* ******************** START SUB Attributes ROUTES ********************* */
        Route::get('sub-attributes', 'AttributeController@subattributes')->name('subattributes')->middleware('userRolePermission:5');
        Route::post('sub-attributes-store', 'AttributeController@subattributesStore')->name('subattributesStore')->middleware('userRolePermission:5');
        Route::get('sub-attributes-edit/{id}', 'AttributeController@editSubattributes')->name('editSubattributes')->middleware('userRolePermission:5');
        Route::post('sub-attributes-update', 'AttributeController@updateSubattributes')->name('updateSubattributes')->middleware('userRolePermission:5');
        Route::get('sub-attributes-delete/{id}', 'AttributeController@deleteSubattributes')->name('deleteSubattributes')->middleware('userRolePermission:5');

        /* ********************* END SUB Attributes ROUTES ********************* */

        /* ******************** START REVIEW TYPE ROUTES ********************* */
        Route::get('review-type', 'AttributeController@review_type')->name('review_type')->middleware('userRolePermission:11');
        Route::post('review-type-store', 'AttributeController@review_typeStore')->name('review_typeStore')->middleware('userRolePermission:11');
        Route::get('review-type-edit/{id}', 'AttributeController@editreview_type')->name('editreview_type')->middleware('userRolePermission:11');
        Route::post('review-type-update', 'AttributeController@updatereview_type')->name('updatereview_type')->middleware('userRolePermission:11');
        Route::get('review-type-delete/{id}', 'AttributeController@deletereview_type')->name('deletereview_type')->middleware('userRolePermission:11');

        /* ********************* END REVIEW TYPE ROUTES ********************* */

        /* ******************** START BUYER FEE ROUTES ********************* */
        Route::get('fee-type', 'AttributeController@fee_type')->name('fee_type');
        Route::post('fee-type-store', 'AttributeController@fee_typeStore')->name('fee_typeStore');
        Route::get('fee-type-edit/{id}', 'AttributeController@editfee_type')->name('editfee_type');
        Route::post('fee-type-update', 'AttributeController@updatefee_type')->name('updatefee_type');
        Route::get('fee-type-delete/{id}', 'AttributeController@deletefee_type')->name('deletefee_type');

        /* ********************* END BUYER FEE ROUTES ********************* */

        /* ******************** START BUYER FEE ROUTES ********************* */
        Route::get('fee', 'AttributeController@fee')->name('fee');
        Route::post('fee-store', 'AttributeController@feeStore')->name('feeStore');
        Route::get('fee-edit/{id}', 'AttributeController@editfee')->name('editfee');
        Route::post('fee-update', 'AttributeController@updatefee')->name('updatefee');
        Route::get('fee-delete/{id}', 'AttributeController@deletefee')->name('deletefee');
  
        /* ********************* END BUYER FEE ROUTES ********************* */
        

        /* ******************** START ITEM ROUTES ********************* */
        Route::get('product', 'ProductController@content')->name('content')->middleware('userRolePermission:5');

        Route::get('product-upload', 'ProductUploadController@product_upload')->name('product_upload');
        Route::post('product-upload', 'ProductUploadController@product_upload_store')->name('product_upload_store');
        Route::post('product-update', 'ProductUploadController@product_upload_update')->name('product_upload_update');
        Route::post('select_product_category', 'ProductUploadController@selectCategory')->name('selectCategory');

        Route::get('product/{title}/{id}', 'ProductController@product_viewSingle')->name('product_viewSingle');
        Route::get('product-pending', 'ProductController@content_pending')->name('content_pending')->middleware('userRolePermission:7');
        Route::post('product/feedback/{id}', 'ProductController@item_feedback')->name('item_feedback')->middleware('userRolePermission:7');
        Route::get('product-edit/{id}', 'ProductController@contentEdit')->name('contentEdit')->middleware('userRolePermission:5');
        Route::get('product-approve/{id}', 'ProductController@itemApprove')->name('itemApprove')->middleware('userRolePermission:5');
        // Route::post('product-update', 'ProductController@itemUpdate')->name('itemUpdate')->middleware('userRolePermission:5');
        Route::post('product-update', 'Vendor\ItemController@itemUpdate')->name('itemUpdate')->middleware('userRolePermission:5');
        Route::get('item-delete/{id}', 'ProductController@itemDelete')->name('itemDelete')->middleware('userRolePermission:5');
        Route::get('deactive-products', 'ProductController@deactiveProduct')->name('deactive_product')->middleware('userRolePermission:5');

        // free product start
        Route::get('free-product', 'ProductSettingController@free_product')->name('free_product')->middleware('userRolePermission:5');
        Route::post('free-product-active/{id}', 'ProductSettingController@free_product_active')->name('free_product_active')->middleware('userRolePermission:5');
        Route::post('free-product-deactive/{id}', 'ProductSettingController@free_product_deactive')->name('free_product_deactive')->middleware('userRolePermission:5');
        // free product end

        Route::get('product-setting', 'ProductSettingController@ProductSetting')->name('ProductSetting');
        Route::post('product-setting-store', 'ProductSettingController@ProductSettingStore')->name('ProductSettingStore');
        Route::post('product-setting-update', 'ProductSettingController@ProductSettingUpdate')->name('ProductSettingUpdate');
        Route::get('product-setting-edit/{id}', 'ProductSettingController@ProductSettingEdit')->name('ProductSettingEdit');
        Route::get('product-setting-delete/{id}', 'ProductSettingController@ProductSettingDelete')->name('ProductSettingDelete');

        //Admin fund
        Route::get('add-fund', 'FundController@addFund')->name('addFund')->middleware('userRolePermission:3');
        Route::post('add-fund', 'FundController@addFundStore')->name('addFundStore')->middleware('userRolePermission:3');
        Route::post('update-fund', 'FundController@addFundUpdate')->name('addFundUpdate')->middleware('userRolePermission:3');
        Route::get('fund-history/{id}', 'FundController@fundHistory')->name('fundHistory')->middleware('userRolePermission:3');
        Route::get('fund-list', 'FundController@fundList')->name('fundList')->middleware('userRolePermission:3');
        Route::get('fund-delete/{id}', 'FundController@fundrDeleted')->name('fundrDeleted')->middleware('userRolePermission:3');

        Route::get('deposit-request', 'FundController@depositRequest')->name('depositRequest')->middleware('userRolePermission:4');
        Route::get('deposit-request-noti/{id}', 'FundController@depositRequestNoti');
        Route::get('mark_all_as_read', 'FundController@MarkAllNoti')->name('mark_all_as_read');
        Route::get('deposit-approved', 'FundController@depositApproved')->name('depositApproved')->middleware('userRolePermission:4');
        Route::get('deposit-delete/{id}', 'FundController@depositDelete')->name('depositDelete')->middleware('userRolePermission:4');
        Route::get('deposit-approve/{id}', 'FundController@approveDeposit')->name('approveDeposit')->middleware('userRolePermission:4');
        //Product Update

        // Product download
        Route::get('product-download/{id}', 'ProductController@ProductDownload')->name('ProductDownload');
        /* ********************* END ITEM ROUTES ********************* */

        /* ******************** START ITEM PREVIEW ROUTES ********************* */
        Route::get('item-preview', 'PreviewController@item_preview')->name('item_preview')->middleware('userRolePermission:6');
        Route::get('item-preview-approve/{id}', 'PreviewController@item_preview_approve')->name('item_preview_approve')->middleware('userRolePermission:6');
        Route::get('item-preview-delete/{id}', 'PreviewController@itemDelete')->name('previewitemDelete')->middleware('userRolePermission:6');
        Route::post('product/review-feedback/{id}', 'PreviewController@item_feedback')->name('item_review_feedback')->middleware('userRolePermission:6');
        Route::get('approve-feedback-review/{id}', 'PreviewController@item_feedback_direct')->name('item_feedback_direct')->middleware('userRolePermission:6');

        /* ********************* END ITEM PREVIEW ROUTES ********************* */

        /* ******************** START LABEL ROUTES ********************* */
        Route::get('label', 'LabelController@label')->name('label')->middleware('userRolePermission:11');
        Route::post('label-store', 'LabelController@labelStore')->name('labelStore')->middleware('userRolePermission:11');
        Route::get('label-edit/{id}', 'LabelController@editlabel')->name('editlabel')->middleware('userRolePermission:11');
        Route::post('label-update', 'LabelController@updatelabel')->name('updatelabel')->middleware('userRolePermission:11');
        Route::get('label-delete/{id}', 'LabelController@deletelabel')->name('deletelabel')->middleware('userRolePermission:11');

        /* ********************* END LABEL ROUTES ********************* */

        /* ******************** START LABEL ROUTES ********************* */
        Route::get('badge', 'BadgeController@badge')->name('badge')->middleware('userRolePermission:11');
        Route::post('badge-store', 'BadgeController@badgeStore')->name('badgeStore')->middleware('userRolePermission:11');
        Route::get('badge-edit/{id}', 'BadgeController@editbadge')->name('editbadge')->middleware('userRolePermission:11');
        Route::post('badge-update', 'BadgeController@updatebadge')->name('updatebadge')->middleware('userRolePermission:11');
        Route::get('badge-delete/{id}', 'BadgeController@deletebadge')->name('deletebadge')->middleware('userRolePermission:11');

        /* ********************* END LABEL ROUTES ********************* */

        /* ******************** START PACKAGE TYPE ROUTES ********************* */
        Route::get('package-type', 'PackageController@package_type')->name('package_type');
        Route::post('package-type-store', 'PackageController@package_typeStore')->name('package_typeStore');
        Route::get('package-type-edit/{id}', 'PackageController@editpackage_type')->name('editpackage_type');
        Route::post('package-type-update', 'PackageController@updatepackage_type')->name('updatepackage_type');
        Route::get('package-type-delete/{id}', 'PackageController@deletepackage_type')->name('deletepackage_type');

        /* ********************* END PACKAGE TYPE ROUTES ********************* */

        /* ******************** START PACKAGE ROUTES ********************* */
        Route::get('package', 'PackageController@package')->name('package');
        Route::post('package-store', 'PackageController@packageStore')->name('packageStore');
        Route::get('package-edit/{id}', 'PackageController@editpackage')->name('editpackage');
        Route::post('package-update', 'PackageController@updatepackage')->name('updatepackage');
        Route::get('package-delete/{id}', 'PackageController@deletepackage')->name('deletepackage');

        /* ********************* END PACKAGE ROUTES ********************* */

        /* ******************** START Coupon ROUTES ********************* */
        Route::get('coupon-list', 'CouponController@couponList')->name('coupon-list')->middleware('userRolePermission:12');
        Route::post('coupon-add', 'CouponController@couponStore')->name('couponStore')->middleware('userRolePermission:12');
        Route::post('coupon-update', 'CouponController@couponUpdate')->name('couponUpdate')->middleware('userRolePermission:12');
        Route::get('coupon_edit/{id}', 'CouponController@couponEdit')->name('coupon_edit')->middleware('userRolePermission:12');
        Route::get('coupon', 'CouponController@index')->name('coupon')->middleware('userRolePermission:12');
        Route::get('coupon-delete/{id}', 'CouponController@deletecoupon')->name('deletecoupon')->middleware('userRolePermission:12');

        /* ********************* END Coupon ROUTES ********************* */

        /* ********************* Start Knowledge Base  ********************* */
        /*   Route::get('knowledge/category', 'KnowledgeBaseCategoryController@index')->name('add_kno_category');
        Route::POST('knowledge/category', 'KnowledgeBaseCategoryController@store')->name('store_kno_category');
        Route::get('kn-category-edit/{id}', 'KnowledgeBaseCategoryController@show')->name('show_kno_category');
        Route::POST('update_kno_category', 'KnowledgeBaseCategoryController@update')->name('show_kno_category');
        Route::get('delete_knowledge_category/{id}', 'KnowledgeBaseCategoryController@destroy')->name('deleteKnoCategory');
         */
        /* ********************* End Knowledge Base  ********************* */

        /* ********************* Start Blog   ********************* */
        /* Route::get('knowledge/blog', 'BlogController@index')->name('blogList');
        Route::get('knowledge/blog/add', 'BlogController@ceateBlog')->name('ceateBlog');
        Route::Post('knowledge/blog/create', 'BlogController@store')->name('storeBlog');
        Route::get('knowledge/blog/edit/{id}', 'BlogController@edit')->name('blogEdit');
        Route::post('knowledge/blog/update', 'BlogController@update')->name('updateBlog');
        Route::get('knowledge/blog/delete/{id}', 'BlogController@destroy')->name('blogDelete'); */

        /* ********************* End Blog   ********************* */

        /* ********************* START ITEM FEE   ********************* */
        Route::get('item-fee', 'ItemFeeController@itemFee')->name('item_fee')->middleware('userRolePermission:10');
        Route::post('item-fee-store', 'ItemFeeController@itemFeeStore')->name('itemFeeStore')->middleware('userRolePermission:10');
        Route::get('item-fee-edit/{id}', 'ItemFeeController@itemFeeEdit')->name('itemFeeEdit')->middleware('userRolePermission:10');
        Route::post('item-fee-update', 'ItemFeeController@itemFeeUpdate')->name('itemFeeUpdate')->middleware('userRolePermission:10');
        Route::get('item-fee-update/{id}', 'ItemFeeController@itemFeeDelete')->name('itemFeeDelete')->middleware('userRolePermission:10');

        Route::get('buyer-item-fee', 'ItemFeeController@buyerItemFee')->name('buyerItemFee');
        Route::post('buyer-item-fee-store', 'ItemFeeController@feeStore')->name('buyerItemFeeStore');
        Route::get('buyer-item-fee-edit/{id}', 'ItemFeeController@editfee')->name('editbuyerItemFee');
        Route::post('buyer-item-fee-update', 'ItemFeeController@updatefee')->name('updatebuyerItemFee');
        Route::get('buyer-item-fee-delete/{id}', 'ItemFeeController@deletefee')->name('deletebuyerItemFee');
        /* ********************* START ITEM FEE   ********************* */

        /* ********************* START ORDER   ********************* */
        Route::get('item-order', 'OrderController@order')->name('item_order')->middleware('userRolePermission:8');
        /* ********************* END ORDER   ********************* */

        /* ********************* START REFUND ORDER   ********************* */
        Route::get('request-refund-order', 'RefundController@refund_order')->name('refund_order')->middleware('userRolePermission:9');
        Route::get('refund-approve/{id}', 'RefundController@refundApprove')->name('refundApprove')->middleware('userRolePermission:9');
        Route::get('refund-order', 'RefundController@approved_refund_order')->name('approved_refund_order')->middleware('userRolePermission:9');
        /* ********************* END REFUND ORDER   ********************* */

        /* ******************** START ITEM ACTIVE DEACTVE ROUTES ********************* */
        Route::get('item-approve/{id}', 'ProductController@Item_approve')->name('Item_approve');

        /* ********************* END ITEM ACTIVE DEACTVE ROUTES ********************* */

        /* ********************* END AFFILIATE ROUTES ********************* */
        Route::get('affiliate-view/{username}', 'UserController@affiliateView')->name('affiliateView');
        /* ********************* END AFFILIATE ROUTES ********************* */

        /* ********************* END AFFILIATE ROUTES ********************* */
        Route::get('recaptcha-setting', 'UserController@reCaptcha')->name('reCaptcha')->middleware('userRolePermission:17');
        Route::post('recaptcha-setting-store', 'UserController@reCaptchaStore')->name('reCaptchaStore')->middleware('userRolePermission:17');
        Route::get('recaptcha-setting-edit/{id}', 'UserController@editreCaptcha')->name('editreCaptcha')->middleware('userRolePermission:17');
        Route::post('recaptcha-setting-update', 'UserController@updatereCaptcha')->name('updatereCaptcha')->middleware('userRolePermission:17');
        Route::get('recaptcha-setting-status', 'UserController@StatusreCaptcha')->middleware('userRolePermission:17');
        /* ********************* END AFFILIATE ROUTES ********************* */

        /** ******************* START PAYMENT METHOD ****************************  */
        Route::get('save-credit-card', 'PaymentController@CreditCard')->name('CreditCard')->middleware('userRolePermission:15');
        Route::get('save-credit-card/{id}', 'PaymentController@CreditCardView')->name('CreditCardView')->middleware('userRolePermission:15');
        Route::get('save-credit-card-approve/{id}', 'PaymentController@CreditCardViewApprove')->name('CreditCardViewApprove')->middleware('userRolePermission:15');
        Route::get('save-credit-card-reject/{id}', 'PaymentController@CreditCardViewReject')->name('CreditCardViewReject')->middleware('userRolePermission:15');

        Route::get('paymnet-method', 'PaymentController@paymentMethod')->name('paymentMethod')->middleware('userRolePermission:15');
        Route::get('paymnet-method-view/{id}', 'PaymentController@paymentMethodView')->name('paymentMethodView')->middleware('userRolePermission:15');
        Route::get('paymnet-method-approve/{id}', 'PaymentController@paymentMethodApprove')->name('paymentMethodApprove')->middleware('userRolePermission:15');
        /** ******************* END PAYMENT METHOD ****************************  */

        /** ******************* START PAYMENT ****************************  */
        Route::get('payable-author', 'PaymentController@payableUser')->name('payableUser')->middleware('userRolePermission:15');
        Route::get('withdraw-author/{id}', 'PaymentController@WithdrawUser')->name('WithdrawUser')->middleware('userRolePermission:15');
        Route::post('payment-author/', 'PaymentController@paymentAuthor')->name('paymentAuthor')->middleware('userRolePermission:15');
        /** ******************* END PAYMENT ****************************  */
        ////logout

        Route::get('max-sell', 'UserController@max_sell');

        Route::get('logout', 'UserController@logout')->name('logout');

        // Password Change Start
        Route::get('change-password', 'UserController@updatePassowrd')->name('password_change');
        Route::post('admin-change-password', 'UserController@updatePassowrdStore')->name('password_update');
        // Password Change End

        // meail send start
        Route::get('send-email-sms-view', 'MailSystemController@sendEmailSmsView')->name('sendEmailSmsView')->middleware('userRolePermission:16');
        Route::post('send-email-sms', 'MailSystemController@sendEmailSms')->name('sendEmailSms')->middleware('userRolePermission:16');
        Route::get('studStaffByRole', 'MailSystemController@studStaffByRole')->middleware('userRolePermission:16');
        // meail send end

        /** ******************* Start Report Routes ****************************  */
        Route::get('revenue', 'ReportController@adminRevenue')->name('revenue')->middleware('userRolePermission:19');
        Route::post('revenue', 'ReportController@getAdminRevenue')->name('revenue')->middleware('userRolePermission:19');

        Route::get('author-revenue', 'ReportController@authorRevenue')->name('authorRevenue')->middleware('userRolePermission:19');
        Route::get('ajaxGetAuthorProduct', 'ReportController@authorProduct')->name('authorProduct');
        Route::post('author-revenue', 'ReportController@getAuthorRevenue')->name('authorRevenue')->middleware('userRolePermission:19');
        /** ******************* End Report Routes ****************************  */

    });

    /** ******************* Start FrontSetting ****************************  */
    Route::get('front-setting', 'FrontSettingController@FrontSetting');
    Route::get('edit_front_setting', 'FrontSettingController@FrontSettingEdit');
    Route::post('front-setting-update', 'FrontSettingController@FrontSettingUpdate');
    /** ******************* END FrontSetting ****************************  */

    /** ******************* Start FooterMenu ****************************  */
    Route::get('footer-menu', 'FrontSettingController@FooterMenu')->middleware('userRolePermission:22');

    Route::post('footer-menu-store', 'FrontSettingController@FooterMenuStore')->middleware('userRolePermission:22');

    Route::get('edit_footer-menu/{id}', 'FrontSettingController@FooterMenuEdit')->middleware('userRolePermission:22');
    Route::post('footer-menu-store-update', 'FrontSettingController@updateFooterMenu')->middleware('userRolePermission:22');

    Route::get('footer-menu-delete/{id}', 'FrontSettingController@FooterMenuDelete')->middleware('userRolePermission:22');
    /** ******************* END FooterMenu ****************************  */
    /** ******************* Start License Feature ****************************  */
    Route::get('license-feature', 'FrontSettingController@licenseFeature')->middleware('userRolePermission:21');
    Route::post('license-feature-store', 'FrontSettingController@licenseFeatureStore')->middleware('userRolePermission:21');
    Route::get('license-feature-edit/{id}', 'FrontSettingController@licenseFeatureEdit')->middleware('userRolePermission:21');
    Route::post('license-feature-update', 'FrontSettingController@licenseFeatureUpdate')->middleware('userRolePermission:21');
    Route::get('license-feature-delete/{id}', 'FrontSettingController@licenseFeatureDelete')->middleware('userRolePermission:21');

    /** ******************* End License Feature ****************************  */

    /** ******************* Start Report Routes ****************************  */
    Route::get('revenue', 'ReportController@adminRevenue');
    /** ******************* End Report Routes ****************************  */
    /* ::::::::::::::::::::::::: END ADMIN ROUTES :::::::::::::::::::::::::: */

});