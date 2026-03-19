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

// Cart routes related to user interactions
Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart/add/{product}', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::post('/cart/delete', 'App\Http\Controllers\CartController@delete')->name('cart.delete');

Route::middleware('auth')->group(function () {
    // Purchase route
    Route::get('/cart/purchase', 'App\Http\Controllers\CartController@purchase')->name('cart.purchase');
    // My account routes
    Route::get('/my-account/orders', 'App\Http\Controllers\MyAccountController@orders')->name('my-account.orders');
    Route::post('/my-account/orders/{order}/cancel', 'App\Http\Controllers\MyAccountController@cancelOrder')->name('my-account.orders.cancel');
});

// Review routes nested under product
Route::middleware('auth')->group(function () {
    Route::post('/products/{product}/reviews', 'App\Http\Controllers\ReviewController@store')->name('review.store');
    Route::get('/products/{product}/reviews/{review}/edit', 'App\Http\Controllers\ReviewController@edit')->name('review.edit');
    Route::put('/products/{product}/reviews/{review}', 'App\Http\Controllers\ReviewController@update')->name('review.update');
    Route::delete('/products/{product}/reviews/{review}', 'App\Http\Controllers\ReviewController@destroy')->name('review.destroy');
});

Route::middleware('admin')->group(function () {
    // Admin routes
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name('admin.home.index');

    // Admin product management routes
    Route::get('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name('admin.product.index');
    Route::post('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@store')->name('admin.product.store');
    Route::get('/admin/products/{product}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name('admin.product.edit');
    Route::put('/admin/products/{product}', 'App\Http\Controllers\Admin\AdminProductController@update')->name('admin.product.update');
    Route::delete('/admin/products/{product}', 'App\Http\Controllers\Admin\AdminProductController@destroy')->name('admin.product.destroy');
});

Auth::routes();
