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
use Modules\HumanResource\Http\Controllers\HumanResourceController;
use Modules\HumanResource\Http\Controllers\SmHumanDepartmentController;

Route::group(['middleware' => ['auth', 'verified', 'admin'],  'prefix' => 'humanresource', 'as' => 'admin.'], function () {
    Route::get('department', [SmHumanDepartmentController::class, 'index'])->name('department')->middleware('userRolePermission:2');
    Route::get('department-add', [SmHumanDepartmentController::class, 'index'])->name('department_store')->middleware('userRolePermission:2');
    Route::post('department-store', [SmHumanDepartmentController::class, 'store'])->name('department_add')->middleware('userRolePermission:2');
    Route::get('department-edit/{id}', [SmHumanDepartmentController::class, 'edit'])->name('department_edit')->middleware('userRolePermission:2');
    Route::delete('department/{id}', [SmHumanDepartmentController::class, 'department_delete'])->name('department_delete')->middleware('userRolePermission:2');
    Route::put('department->update/{id}', [SmHumanDepartmentController::class, 'update'])->name('department_edit')->middleware('userRolePermission:2');

    Route::get('user-list', [HumanResourceController::class, 'index'])->name('user_list')->middleware('userRolePermission:2');
    Route::get('add-user', [HumanResourceController::class, 'add_user'])->name('add_user')->middleware('userRolePermission:2');
    Route::get('edit-user/{id}', [HumanResourceController::class, 'user_edit'])->name('user_edit')->middleware('userRolePermission:2');
    Route::post('user-search', [HumanResourceController::class, 'user_search'])->name('user_search')->middleware('userRolePermission:2');
    Route::post('add-user-store', [HumanResourceController::class, 'add_user_store'])->name('add_user_store')->middleware('userRolePermission:2');
    Route::post('add-user-update', [HumanResourceController::class, 'add_user_update'])->name('add_user_update')->middleware('userRolePermission:2');
});
