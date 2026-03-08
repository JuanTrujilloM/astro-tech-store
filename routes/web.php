<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/order', 'App\Http\Controllers\OrderController@index')->name('orders.index');
Route::post('/order', 'App\Http\Controllers\OrderController@store')->name('orders.store');
Route::get('/order/list', 'App\Http\Controllers\OrderController@list')->name('orders.list');
Route::get('/order/success', 'App\Http\Controllers\OrderController@success')->name('orders.success');
