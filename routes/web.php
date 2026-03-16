<?php

use Illuminate\Support\Facades\Route;

// User facing routes
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('home.about');
Route::get('/contact', 'App\Http\Controllers\HomeController@contact')->name('home.contact');
Route::get('/lang/{locale}', 'App\Http\Controllers\LanguageController@switch')->name('lang.switch');

// Product routes related to user interactions
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/{product}', 'App\Http\Controllers\ProductController@show')->name('product.show');

// Review routes nested under product
Route::post('/products/{product}/reviews', 'App\Http\Controllers\ReviewController@store')->name('review.store');
Route::get('/products/{product}/reviews/{review}/edit', 'App\Http\Controllers\ReviewController@edit')->name('review.edit');
Route::put('/products/{product}/reviews/{review}', 'App\Http\Controllers\ReviewController@update')->name('review.update');
Route::delete('/products/{product}/reviews/{review}', 'App\Http\Controllers\ReviewController@destroy')->name('review.destroy');
// Admin routes
Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name('admin.home.index');

// Admin product management routes
Route::get('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name('admin.product.index');
Route::post('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@store')->name('admin.product.store');
Route::get('/admin/products/{product}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name('admin.product.edit');
Route::put('/admin/products/{product}', 'App\Http\Controllers\Admin\AdminProductController@update')->name('admin.product.update');
Route::delete('/admin/products/{product}', 'App\Http\Controllers\Admin\AdminProductController@destroy')->name('admin.product.destroy');