<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Controller responsible for handling API requests related to products, including fetching product data and associated reviews.
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Review\ReviewResource;

class ProductAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = new ProductCollection(Product::with('reviews')->get());
        return response()->json($products);
    }
}