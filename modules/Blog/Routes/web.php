<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
// */

Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'blog'], function () {

    Route::get('/category', 'BlogController@categoryList')->name('categoryList');
    Route::POST('category-store', 'BlogController@categoryStore')->name('store_blog_category');
    Route::get('category-edit/{id}', 'BlogController@editCategory')->name('blog_category_edit');
    Route::POST('category-update', 'BlogController@categoryUpdate')->name('update_blog_category');
    Route::get('category-delete/{id}', 'BlogController@destroy')->name('deleteBlogCategory');

    //Blogs
    Route::get('/blogs-list', 'BlogController@blogList')->name('blogList');
    Route::get('/blog-edit/{id}', 'BlogController@blogEdit')->name('blogEdit');
    Route::get('/blog-add', 'BlogController@blogAdd')->name('add_blog');
    Route::post('/blog-new-add', 'BlogController@blogStore')->name('create_blog');
    Route::post('/blog-update', 'BlogController@blogUpdate')->name('blogUpdate');
    Route::get('/blog-delete/{id}', 'BlogController@blogDelete')->name('blogDelete');
});
