<?php

Route::post('logout', 'AuthController@logout')->name('logout');
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

// profile route
Route::get('profile', 'ProfileController@index')->name('profile');
Route::get('edit', 'ProfileController@edit')->name('profile.edit');
Route::put('profile/general/update', 'ProfileController@generalUpdate')->name('profile.general.update');
Route::put('profile/picture/update', 'ProfileController@pictureUpdate')->name('profile.picture.update');
Route::put('profile/security/update', 'ProfileController@securityUpdate')->name('profile.security.update');

Route::resource('category/{category}/subcategory', 'SubCategoryController');
Route::resource('category/{subcategory}/minisubcategory', 'MiniSubCategoryController');
Route::resource('vendor', 'VendorController');
Route::resource('currency', 'CurrencyController');
Route::resource('language', 'LanguageController');
Route::resource('category', 'CategoryController');
Route::resource('attribute', 'AttributeController');
Route::resource('brand', 'BrandController');

Route::delete('measurement/sortable', 'MeasurementController@sortable')->name('measurement.sortable');
Route::resource('measurement', 'MeasurementController');

Route::delete('non_measurement/sortable', 'NonMeasurementController@sortable')->name('non_measurement.sortable');
Route::resource('non_measurement', 'NonMeasurementController');

Route::post('banner/picture/update', 'BannerController@picture')->name('banner.picture.update');
Route::resource('banner', 'BannerController');
Route::get('attribute/for_product/{id}','ProductController@attribute');
Route::resource('product', 'ProductController');
Route::post('product-image','ProductController@storeImage')->name('product.storeImage');
Route::post('product-delete-image','ProductController@deleteImage')->name('product.deleteImage');

Route::get('page/{page}', 'PageController@index')->name('page.index');
Route::put('page/{page}', 'PageController@update')->name('page.update');


