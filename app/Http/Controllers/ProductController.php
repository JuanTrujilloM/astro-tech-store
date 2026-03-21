<?php

/**
 * Author:Juan Esteban Trujillo Montes
 * Description: Controller responsible for managing Products
 */

namespace App\Http\Controllers;

use App\Http\Requests\SearchProductsRequest;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(SearchProductsRequest $request): View
    {
        $validated = $request->validated();
        $product_search = trim((string) ($validated['product_search'] ?? ''));

        $query = Product::query()
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        if ($product_search !== '') {
            $query->where(function ($sub) use ($product_search) {
                $sub->where('name', 'like', '%'.$product_search.'%')
                    ->orWhere('description', 'like', '%'.$product_search.'%');
            });
        }

        $viewData = [];
        $viewData['products'] = $query->get();
        $viewData['product_search'] = $product_search;

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(int $product): View
    {
        $viewData = [];
        $viewData['product'] = Product::with('reviews.user')->withAvg('reviews', 'rating')->withCount('reviews')->findOrFail($product);

        return view('product.show')->with('viewData', $viewData);
    }
}
