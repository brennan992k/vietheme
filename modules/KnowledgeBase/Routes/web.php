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

use Illuminate\Routing\Route;

Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'knowledgebase'], function () {

    Route::get('/category', 'KnowledgeBaseController@categoryList')->name('KnowledgeBaseCategoryList')->middleware('userRolePermission:13');
    Route::get('/category-edit/{id}', 'KnowledgeBaseController@editCategory')->name('editCategory')->middleware('userRolePermission:13');
    Route::get('/category/delete/{id}', 'KnowledgeBaseController@deleteCategory')->name('deleteKnowledgeBaseCategory')->middleware('userRolePermission:13');
    Route::post('/category/store', 'KnowledgeBaseController@categoryStore')->name('store_knowledge_base_category')->middleware('userRolePermission:13');
    Route::post('/category/update', 'KnowledgeBaseController@categoryUpdate')->name('update_knowledge_base_category')->middleware('userRolePermission:13');

    //Knowledge Base Question 
    Route::get('/category-question', 'KnowledgeBaseController@categoryQuestion')->name('categoryQuestion')->middleware('userRolePermission:13');
    // Route::get('/add-kn-base', 'KnowledgeBaseController@create')->name('add_knowledge_base');
    Route::get('/question-edit/{id}', 'KnowledgeBaseController@categoryQuestionEdit')->name('categoryQuestionEdit')->middleware('userRolePermission:13');
    Route::get('/delete-question/{id}', 'KnowledgeBaseController@deleteQuestion')->name('deleteQuestion')->middleware('userRolePermission:13');
    Route::post('/store-kn-question', 'KnowledgeBaseController@storeQuestion')->name('storeQuestion')->middleware('userRolePermission:13');
    Route::post('/update-kn-question', 'KnowledgeBaseController@updateQuestion')->name('update_knowledge_base_question')->middleware('userRolePermission:13');
    // Route::post('/update-kn-base', 'KnowledgeBaseController@update')->name('update_kn_base');

    //Knowledge Base -> Question -> Question & answer
    Route::get('/question', 'KnowledgeBaseController@index')->name('questionList')->middleware('userRolePermission:13');
    Route::post('/question', 'KnowledgeBaseController@SearchQuestion')->name('SearchquestionList')->middleware('userRolePermission:13');
    Route::get('/add-kn-base', 'KnowledgeBaseController@create')->name('add_knowledge_base')->middleware('userRolePermission:13');
    Route::get('/add-kn-edit/{id}', 'KnowledgeBaseController@show')->name('kn_baseEdit')->middleware('userRolePermission:13');
    Route::get('/delete-kn-base/{id}', 'KnowledgeBaseController@destroy')->name('blogKnBase')->middleware('userRolePermission:13');
    Route::post('/store-kn-base', 'KnowledgeBaseController@store')->name('create_kn_base')->middleware('userRolePermission:13');
    Route::post('/update-kn-base', 'KnowledgeBaseController@update')->name('update_kn_base')->middleware('userRolePermission:13');



    Route::get('/category/vue', 'KnowledgeBaseController@categoryListVue')->name('KnowledgeBaseCategoryListVue')->middleware('userRolePermission:13');
    Route::get('/ajax-knowledgebase', 'KnowledgeBaseController@ajaxKnowledgeBaseList')->name('ajaxKnowledgeBaseList')->middleware('userRolePermission:13');
});