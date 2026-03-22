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
        $productSearch = trim((string) $request->input('product_search', ''));
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');
        $minRating = $request->input('min_rating');

        $query = Product::query()
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        if ($productSearch !== '') {
            $query->where(function ($sub) use ($productSearch) {
                $sub->where('name', 'like', '%'.$productSearch.'%')
                    ->orWhere('description', 'like', '%'.$productSearch.'%');
            });
        }

        if ($priceMin !== null) {
            $query->where('price', '>=', $priceMin);
        }
        if ($priceMax !== null) {
            $query->where('price', '<=', $priceMax);
        }

        if ($minRating !== null && $minRating >= 1 && $minRating <= 5) {
            $query->having('reviews_avg_rating', '>=', $minRating);
        }

        $products = $query->get();

        $hasActiveFilters = $productSearch !== ''
            || $priceMin !== null
            || $priceMax !== null
            || ($minRating !== null && $minRating >= 1);

        $viewData = [];
        $viewData['products'] = $products;
        $viewData['product_search'] = $productSearch;
        $viewData['price_min'] = $priceMin !== null ? $priceMin : '';
        $viewData['price_max'] = $priceMax !== null ? $priceMax : '';
        $viewData['min_rating'] = $minRating !== null ? $minRating : '';
        $viewData['has_active_filters'] = $hasActiveFilters;

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(int $product): View
    {
        $viewData = [];
        $viewData['product'] = Product::with('reviews.user')->withAvg('reviews', 'rating')->withCount('reviews')->findOrFail($product);

        return view('product.show')->with('viewData', $viewData);
    }
}
