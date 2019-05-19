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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::post('/user/register', 'UserController@register');
Route::get('/user/all', 'UserController@all');
Route::post('/user/login', 'UserController@login');
Route::get('email/confirm_verification', 'UserController@verify');

Route::post('/article/create', 'ArticleController@create');
Route::get('/article/all', 'ArticleController@all')->middleware('auth');
Route::post('/article/edit', 'ArticleController@edit');
Route::get('/article/list/user', 'ArticleController@display');
Route::post('/article/softDelete', 'ArticleController@softDelete');
Route::get('/article/getTrashed', 'ArticleController@getTrashed');
Route::post('/article/forceDelete', 'ArticleController@forceDelete');
Route::post('/article/restore', 'ArticleController@restore');

Route::post('/category/create', 'CategoryController@create');
Route::post('/category/update', 'CategoryController@update');

Route::post('/comment/make', 'CommentController@make');
Route::get('/comment/list/article', 'CommentController@display');
Route::post('/comment/delete', 'CommentController@delete');