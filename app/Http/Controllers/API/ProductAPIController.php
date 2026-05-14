<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Controller responsible for handling API requests related to products, including fetching product data and associated reviews.
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductAPIController extends Controller
{
    public function index(): JsonResponse
    {
        $products = new ProductCollection(Product::with('reviews')->get());

        return response()->json($products);
    }
}
