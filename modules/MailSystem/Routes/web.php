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

Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'mailsystem'], function () {
    Route::get('/mail-template', 'MailSystemController@create')->name('admin.mail_template');
    Route::post('/mail-template/{id}', 'MailSystemController@store');
});
