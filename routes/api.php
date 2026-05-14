<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: API routes file responsible for defining the endpoints for the application's API, including a route for fetching products and their associated reviews.
 */

use Illuminate\Support\Facades\Route;

Route::get('/products', 'App\Http\Controllers\API\ProductAPIController@index')->name('api.product.index');
