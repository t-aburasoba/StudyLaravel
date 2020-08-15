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




Route::get('hello', 'HelloController@index');
Route::get('hello/{id}', 'HelloController@show');
Route::post('hello', 'HelloController@post');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostController');

Route::resource('comments', 'CommentController');

// Route::post('posts/{post}/favorites', 'FavoriteController@store')->name('favorites');
// Route::post('posts/{post}/unfavorites', 'FavoriteController@destroy')->name('unfavorites');

Route::get('posts/{post}/favorites', 'FavoriteController@store');
Route::get('posts/{post}/unfavorites', 'FavoriteController@destroy');
Route::get('posts/{post}/countfavorites', 'FavoriteController@count');
Route::get('posts/{post}/hasfavorites', 'FavoriteController@hasfavorite');

Route::get('login/twitter', 'Auth\LoginController@redirectToProvider')->name('login.twitter');
Route::get('login/twitter/callback', 'Auth\LoginController@handleProviderCallback');
