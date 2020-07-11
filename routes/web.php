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
*/


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::resource('/products','ProductController');
Route::get('/products/search/value={value}','ProductController@search');
Route::get('/products/all/show','ProductController@index');
Route::resource('products.comments','CommentProductController');
Route::get('comments/{cid}/replyComment','CommentProductController@showReply')->name('replyComment');
Route::post('comments/{cid}/likeComment','LikeCommentController')->name('likeComment');
Route::post('products/{pid}/rate','RateController@rate_product')->name('rateProducts');
Route::get('products/{pid}/rate','RateController@get_rate_product')->name('getrateProducts');
Route::resource('/carts','CartController');
Route::get('list_bill','CartController@index');
