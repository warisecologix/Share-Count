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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/registration', 'RegisterController@register')->name('register');
Route::post('/registration/user', 'RegisterController@store')->name('register_post');

Route::post('/email_verification_code', 'AJAXController@email_verification_code')->name('email_verification_code');
Route::post('/phone_number_verification_code', 'AJAXController@phone_number_verification_code')->name('phone_number_verification_code');
Route::post('/check_phone_number', 'AJAXController@check_phone_number')->name('check_phone_number');


