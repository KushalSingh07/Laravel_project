<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


// Route::get('/articles', 'ArticlesController@index');
// Route::get('/articles/create', 'ArticlesController@create');
// Route::get('/articles/{id}', 'ArticlesController@show');
// Route::post('articles', 'ArticlesController@store');
// Route::get('/articles/{id}/edit', 'ArticlesController@edit');
// Route::patch('/articles/{articles}', 'ArticlesController@update');
// Route::delete('/articles/{articles}' 'ArticlesController@destroy');

Route::get('/', 'ArticlesController@index');
Route::get('/makeAdmin/{id}', 'ArticlesController@make_admin');
Route::get('/makeUser/{id}', 'ArticlesController@make_user');
Route::get('/articles/superAdmin', 'ArticlesController@superAdmin');
Route::get('/articles/myarticles', 'ArticlesController@myarticles');
Route::resource('articles', 'ArticlesController');



Auth::routes();

Route::get('/home', 'ArticlesController@index');
