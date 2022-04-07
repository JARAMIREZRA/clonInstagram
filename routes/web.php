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

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/configuration', 'Admin\UserController@config')->name('user.config');

Route::get('/user/{searh?}', 'Admin\UserController@index')->name('user.index');
Route::get('/user/avatar/{filename}', 'Admin\UserController@getImage')->name('user.avatar');
Route::get('/profile/{id}', 'Admin\UserController@profile')->name('user.profile');
Route::post('/user/update', 'Admin\UserController@update')->name('user.update');

Route::post('/comment/save', 'Admin\CommentController@store')->name('comment.store');
Route::get('/comment//delete/{id}', 'Admin\CommentController@delete')->name('comment.delete');

Route::get('/like/{id}', 'Admin\LikeController@store')->name('like.store');
Route::get('/dislike/{id}', 'Admin\LikeController@delete')->name('like.delete');
Route::get('/likes', 'Admin\LikeController@index')->name('like');

Route::post('/image/save', 'Admin\ImageController@store')->name('image.store');
Route::get('/image/file/{filename}', 'Admin\ImageController@getImage')->name('image.file');
Route::get('/subir-imagen', 'Admin\ImageController@create')->name('image.create');
Route::get('/image/edit/{id}', 'Admin\ImageController@edit')->name('image.edit');
Route::get('/image/delete/{id}', 'Admin\ImageController@delete')->name('image.delete');
Route::get('/image/{id}/show', 'Admin\ImageController@show')->name('image.show');
