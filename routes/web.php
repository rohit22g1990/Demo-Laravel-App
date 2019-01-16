<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| //Route::get('/add_comment/{id} ', 'CommentController@create')->name('add_comment');
*/

Auth::routes();

Route::get('/', 'BlogsController@showAllBlogs');
Route::get('/show_blog/{id}', 'BlogsController@showBlog')->name('show_blog');
Route::get('/home', 'BlogsController@showAllBlogs')->name('home');
Route::get('/edit_blog/{id}', 'BlogsController@edit')->name('edit_blog');
Route::get('/new_blog', function() {

	return view('new_blog');
});

Route::post('/update_blog/{id}', 'BlogsController@update')->name('update_blog');
Route::post('/store_comment', 'CommentController@store')->name('store_comment');
Route::post('/create_blog', 'BlogsController@create')->name('create_blog');








