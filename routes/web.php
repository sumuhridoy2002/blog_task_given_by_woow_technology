<?php

use Illuminate\Support\Facades\Auth;
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
*/

Route::get('/', 'FrontendController@index');
Auth::routes();
Route::get('/dashboard', 'HomeController@index')->name('home');

Route::get('add-new-post', 'PostController@create');
Route::post('add-new-post', 'PostController@store');
Route::get('read-details/{post}', 'PostController@details');
Route::get('edit-post/{post}', 'PostController@edit');
Route::post('update-post/{post}', 'PostController@update');
Route::get('delete-post/{post}', 'PostController@destroy');
Route::get('update-post-status/{post}', 'PostController@updateStatus');

Route::post('store-comment/{post_id}', 'CommentController@store');
Route::get('delete-comment/{comment}', 'CommentController@destroy');

Route::post('store-replay', 'ReplayController@store');
Route::get('delete-replay/{replay}', 'ReplayController@destroy');