<?php

/**
 * Author:Juan Esteban Trujillo Montes
 * Description: Controller responsible for managing Products
 */

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $viewData = [];
        $favorites = $request->session()->get('favorites', []);

        $viewData['products'] = Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->get()
            ->sortByDesc(function ($product) use ($favorites) {
                return in_array($product->getId(), $favorites);
            });

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(int $product): View
    {
        $viewData = [];
        $viewData['product'] = Product::with('reviews.user')->withAvg('reviews', 'rating')->withCount('reviews')->findOrFail($product);

        return view('product.show')->with('viewData', $viewData);
    }
}
