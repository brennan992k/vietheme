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

Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('refund-list', 'RefundController@index')->name('refund_list')->middleware('userRolePermission:9');
    Route::post('refund-store', 'RefundController@store')->name('refundStore')->middleware('userRolePermission:9');
    Route::get('refund-edit/{id}', 'RefundController@edit')->name('editrefund')->middleware('userRolePermission:9');
    Route::post('refund-update', 'RefundController@update')->name('updaterefund')->middleware('userRolePermission:9');
    Route::get('refund-delete/{id}', 'RefundController@destroy')->name('deleterefund')->middleware('userRolePermission:9');
});