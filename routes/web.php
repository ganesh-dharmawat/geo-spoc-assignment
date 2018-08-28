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

Route::get('/','UserProfileController@index' );
Auth::routes();
Route::get('/home', 'UserProfileController@index')->name('home');
Route::get('manage',array('uses' => 'UserController@getManageView'));
Route::get('view/{userInfo}',array('uses' => 'UserController@getView'));
Route::get('listing',array('uses' => 'UserController@getListing'));
Route::get('/pdf/{userInfo}', 'UserController@pdfStream')->name('pdfStream');
Route::resource('users', 'UserController');
Route::resource('userprofile', 'UserProfileController');
Route::get('my-captcha', 'HomeController@myCaptcha')->name('myCaptcha');
Route::post('my-captcha', 'HomeController@myCaptchaPost')->name('myCaptcha.post');
Route::get('refresh_captcha', 'HomeController@refreshCaptcha')->name('refresh_captcha');
