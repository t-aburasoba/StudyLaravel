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

// Route::get('/', function () {
//     return view('welcome');
// });

// 以下使っていたやつ
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/', 'ArticlesController@index')->name('home');
Route::resource('articles', 'ArticlesController');

// Route::get('/blog-post/{id}/{welcome?}', function($id, $welcome = 1){
//     $pages = [
//       1 => [
//         'title' => 'from page 1',
//       ],
//       2 => [
//         'title' => 'from page 2',
//       ],
//     ];
//     $welcomes = [1 => 'Hello ', 2 => 'Welcome to '];

//     return view('blog-post', [
//       'data' => $pages[$id], 
//       'welcome' => $welcomes[$welcome],
//     ]);
// });
Route::get('/mail','MailSendController@index')->name('mail');

// Route::get('/articles', 'ArticlesController@index')->name('articles.index');
// Route::get('articles/create', 'ArticlesController@create')->name('articles.create');
// Route::get('/articles/{id}', 'ArticlesController@show')->name('articles.show');
// Route::post('/articles', 'ArticlesController@store')->name('articles.store');
// Route::get('articles/{id}/edit', 'ArticlesController@edit')->name('articles.edit');
// Route::patch('articles/{id}', 'ArticlesController@update')->name('articles.update');
// Route::delete('articles/{id}', 'ArticlesController@destroy')->name('articles.destroy');

// Route::resource('articles', 'ArticlesController');

// Route::resource('posts', 'PostsController')->except(['create', 'store', 'update', 'destroy']);
Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
