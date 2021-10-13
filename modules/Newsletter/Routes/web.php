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

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'newsletter'], function () {

    // Route::get('/', 'NewsletterController@index');
    Route::get('/', 'NewsletterController@index')->name('newsletterList');
    Route::post('/add-newsletter', 'NewsletterController@store')->name('add_subscription');
    Route::post('/update-newsletter', 'NewsletterController@update_subscription')->name('update_subscription');

    Route::get('newsletter-permission-update', 'NewsletterController@newsletterwPermissionUpdate');
    Route::get('email-edit/{id}', 'NewsletterController@emailEdit')->name('emailEdit');
    Route::get('email-delete/{id}', 'NewsletterController@email_Delete')->name('email_Delete');
});
