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

Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'ticket'], function () {

    Route::get('ticket-status', 'TicketController@titcketStatus')->name('titcketStatus')->middleware('userRolePermission:18');
    Route::get('ticket-category', 'TicketController@category')->name('infixTicketcategory')->middleware('userRolePermission:18');
    Route::post('ticket-category', 'TicketController@category_store')->name('infixTicketcategory_store')->middleware('userRolePermission:18');
    Route::get('ticket-category-edit/{id}', 'TicketController@category_edit')->name('infixTicketcategory_edit')->middleware('userRolePermission:18');
    Route::post('ticket-category-update/{id}', 'TicketController@category_update')->name('infixTicketcategory_update')->middleware('userRolePermission:18');
    Route::get('ticket-category-delete/{id}', 'TicketController@category_delete')->name('infixTicketcategory_delete')->middleware('userRolePermission:18');


    Route::get('ticket-priority', 'TicketController@priority')->name('infixTicketPriority')->middleware('userRolePermission:18');
    Route::post('ticket-priority', 'TicketController@priority_store')->name('infixTicketPriority_store')->middleware('userRolePermission:18');
    Route::get('ticket-priority-edit/{id}', 'TicketController@priority_edit')->name('infixTicketPriority_edit')->middleware('userRolePermission:18');
    Route::post('ticket-priority-update/{id}', 'TicketController@priority_update')->name('infixTicketPriority_update')->middleware('userRolePermission:18');
    Route::get('ticket-priority-delete/{id}', 'TicketController@priority_delete')->name('infixTicketPriority_delete')->middleware('userRolePermission:18');

    Route::get('ticket-list', 'TicketController@index')->name('infixTicket_list')->middleware('userRolePermission:18');
    route::get('admin/add-ticket', 'TicketController@add_ticket')->name('infixTicket_ticket')->middleware('userRolePermission:18');



    route::post('admin/ticket-store', 'TicketController@ticket_store')->name('infixTicket_store')->middleware('userRolePermission:18');
    route::get('admin/ticket-edit/{id}', 'TicketController@ticket_edit')->name('infixTicket_edit')->middleware('userRolePermission:18');
    route::get('admin/ticket-view/{id}', 'TicketController@infixTicket_view')->name('infixTicket_view')->middleware('userRolePermission:18');
    route::post('admin/ticket-update/', 'TicketController@ticket_update')->name('infixTicket_update')->middleware('userRolePermission:18');
    route::get('admin/ticket-delete-view/{id}', 'TicketController@ticket_delete_view')->name('admin.ticket_delete_view')->middleware('userRolePermission:18');
    route::get('admin/ticket-delete/{id}', 'TicketController@ticket_delete')->name('infixTicket_delete')->middleware('userRolePermission:18');
    route::post('admin/ticket-search/', 'TicketController@ticket_search')->name('infixTicket_search')->middleware('userRolePermission:18');

    route::get('admin/ticket-show/{id}', 'TicketController@ticket_show')->name('admin.ticket_show')->middleware('userRolePermission:18');

    //Department

    Route::get('department', 'TicketController@showDepartment')->name('InfixDepartmentShow')->middleware('userRolePermission:18');
    Route::post('department', 'TicketController@storeDepartment')->name('InfixDepartmentStore')->middleware('userRolePermission:18');
    Route::get('department/{id}', 'TicketController@editDepartment')->name('InfixDepartmentEdit')->middleware('userRolePermission:18');
    Route::put('department/{id}', 'TicketController@updateDepartment')->name('InfixDepartmentUpdate')->middleware('userRolePermission:18');
    Route::delete('department/{id}', 'TicketController@deleteDepartment')->name('InfixDepartmentDelete')->middleware('userRolePermission:18');

    //comment
    Route::post('admin/comment-store', 'TicketController@comment_store')->name('admin.comment_store')->middleware('userRolePermission:18');
    Route::post('admin/comment-reply', 'TicketController@comment_reply')->name('admin.comment_reply')->middleware('userRolePermission:18');
    Route::get('download-file/{id}', 'TicketController@download_file')->name('download_file')->middleware('userRolePermission:18');
});