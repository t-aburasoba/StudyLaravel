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

Route::get('/', 'WelcomeController@index');
Route::get('/contact', 'PagesController@contact');
Route::get('/blog-post/{id}/{welcome?}', function($id, $welcome = 1){
    $pages = [
      1 => [
        'title' => 'from page 1',
      ],
      2 => [
        'title' => 'from page 2',
      ],
    ];
    $welcomes = [1 => 'Hello ', 2 => 'Welcome to '];

    return view('blog-post', [
      'data' => $pages[$id], 
      'welcome' => $welcomes[$welcome],
    ]);
});
Route::get('/about', 'PagesController@about');
Route::get('/mail','MailSendController@index');
Route::get('/articles', 'ArticlesController@index');
Route::get('articles/create', 'ArticlesController@create');
Route::get('/articles/{id}', 'ArticlesController@show');
Route::post('/articles', 'ArticlesController@store');
Route::get('articles/{id}/edit', 'ArticlesController@edit');
Route::patch('articles/{id}', 'ArticlesController@update');
