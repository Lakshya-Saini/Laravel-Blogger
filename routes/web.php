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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');
Route::post('/contact', 'PagesController@postContact');
Route::get('/blog', 'PostsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostsController');

Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@singlePost'])->where('slug', '[\w\d\-\_]+');

Route::resource('categories', 'CategoryController', ['except' => 'create']);

Route::resource('tags', 'TagsController', ['except' => 'create']);

Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Route::get('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
