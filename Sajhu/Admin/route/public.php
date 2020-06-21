<?php

Route::get('login','AuthController@showLoginForm')->name('login.form');
Route::post('login','AuthController@login')->name('login');
