<?php

use Illuminate\Support\Facades\Route;

// User facing routes
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('home.about');
Route::get('/contact', 'App\Http\Controllers\HomeController@contact')->name('home.contact');

// Language switcher route
Route::get('/lang/{locale}', 'App\Http\Controllers\LanguageController@switch')->name('lang.switch');

// Product routes related to user interactions
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/{product}', 'App\Http\Controllers\ProductController@show')->name('product.show');

// Cart routes related to user interactions
Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart/add/{product}', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::post('/cart/delete', 'App\Http\Controllers\CartController@delete')->name('cart.delete');

// Order routes related to user interactions
Route::middleware('auth')->group(function () {
    Route::get('/cart/purchase', 'App\Http\Controllers\CartController@purchase')->name('cart.purchase');
    Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('order.index');
    Route::get('/orders/{order}', 'App\Http\Controllers\OrderController@show')->name('order.show');
    Route::post('/orders/{order}/cancel', 'App\Http\Controllers\OrderController@cancel')->name('order.cancel');
});

// Review routes related to user interactions
Route::middleware('auth')->group(function () {
    Route::post('/products/{product}/reviews', 'App\Http\Controllers\ReviewController@store')->name('review.store');
    Route::get('/products/{product}/reviews/{review}/edit', 'App\Http\Controllers\ReviewController@edit')->name('review.edit');
    Route::put('/products/{product}/reviews/{review}', 'App\Http\Controllers\ReviewController@update')->name('review.update');
    Route::delete('/products/{product}/reviews/{review}', 'App\Http\Controllers\ReviewController@destroy')->name('review.destroy');
});

// Admin routes
Route::middleware('admin')->group(function () {
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name('admin.home.index');

    // Admin product management routes
    Route::get('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name('admin.product.index');
    Route::post('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@store')->name('admin.product.store');
    Route::get('/admin/products/{product}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name('admin.product.edit');
    Route::put('/admin/products/{product}', 'App\Http\Controllers\Admin\AdminProductController@update')->name('admin.product.update');
    Route::delete('/admin/products/{product}', 'App\Http\Controllers\Admin\AdminProductController@destroy')->name('admin.product.destroy');

    // Admin user management routes
    Route::get('/admin/users', 'App\Http\Controllers\Admin\AdminUserController@index')->name('admin.user.index');
    Route::post('/admin/users', 'App\Http\Controllers\Admin\AdminUserController@store')->name('admin.user.store');
    Route::get('/admin/users/{user}/edit', 'App\Http\Controllers\Admin\AdminUserController@edit')->name('admin.user.edit');
    Route::put('/admin/users/{user}', 'App\Http\Controllers\Admin\AdminUserController@update')->name('admin.user.update');
    Route::delete('/admin/users/{user}', 'App\Http\Controllers\Admin\AdminUserController@destroy')->name('admin.user.destroy');

    // Admin order management routes
    Route::get('/admin/orders', 'App\Http\Controllers\Admin\AdminOrderController@index')->name('admin.order.index');
    Route::patch('/admin/orders/{order}/update-status', 'App\Http\Controllers\Admin\AdminOrderController@updateStatus')->name('admin.order.updateStatus');

    // Admin review management routes
    Route::get('/admin/reviews', 'App\Http\Controllers\Admin\AdminReviewController@index')->name('admin.review.index');
    Route::delete('/admin/reviews/{review}', 'App\Http\Controllers\Admin\AdminReviewController@destroy')->name('admin.review.destroy');
});

Auth::routes();
