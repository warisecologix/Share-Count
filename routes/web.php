<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'RegisterController@register')->name('register');
Route::get('/faq', 'RegisterController@faq')->name('faq');


Route::post('/registration/user', 'RegisterController@store')->name('register_post');
Route::post('/registration/user/first/step', 'RegisterController@register_user')->name('register_user');
Route::post('/email_verification_code', 'AJAXController@email_verification_code')->name('email_verification_code');
Route::post('/check_verification', 'AJAXController@check_verification')->name('check_verification');
Route::post('/check_phone_number', 'AJAXController@check_phone_number')->name('check_phone_number');
Route::post('/shares_own_verification_code', 'AJAXController@shares_own_verification_code')->name('shares_own_verification_code');
Route::post('/verify/phone/otp', 'AJAXController@verify_phone_otp')->name('verify_phone_otp');
Route::post('/verify/email/otp', 'AJAXController@verify_email_otp')->name('verify_email_otp');
Route::post('/load/stats', 'AJAXController@load_stat')->name('load_stat');
