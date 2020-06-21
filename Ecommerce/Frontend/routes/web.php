<?php

Route::get('/','HomeController@index')->middleware('ecommerce-admin-auth');
Route::get('/{category}','HomeController@category');
