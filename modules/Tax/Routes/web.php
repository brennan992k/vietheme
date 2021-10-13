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
    Route::get('tax-list', 'TaxController@index')->name('tax_list')->middleware('userRolePermission:14');
    Route::post('tax-store', 'TaxController@store')->name('taxStore')->middleware('userRolePermission:14');
    Route::get('tax-edit/{id}', 'TaxController@edit')->name('edittax')->middleware('userRolePermission:14');
    Route::post('tax-update', 'TaxController@update')->name('updatetax')->middleware('userRolePermission:14');
    Route::get('tax-delete/{id}', 'TaxController@destroy')->name('deletetax')->middleware('userRolePermission:14');
});
