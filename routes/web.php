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

Route::get('/','CandidateController@index' );
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('manage',array('uses' => 'UserController@getManageView'));
Route::get('view/{userInfo}',array('uses' => 'UserController@getView'));
Route::get('listing',array('uses' => 'UserController@getListing'));
Route::resource('users', 'UserController');
Route::resource('candidate', 'CandidateController');
Route::get('my-captcha', 'HomeController@myCaptcha')->name('myCaptcha');
Route::post('my-captcha', 'HomeController@myCaptchaPost')->name('myCaptcha.post');
Route::get('refresh_captcha', 'HomeController@refreshCaptcha')->name('refresh_captcha');
