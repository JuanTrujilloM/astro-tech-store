<?php

/**
 * Author: Juan Esteban Trujillo Montes
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
        $productSearch = trim((string) ($validated['product_search'] ?? ''));

        $priceMin = $request->filled('price_min') && isset($validated['price_min']) && $validated['price_min'] !== null
            ? (int) $validated['price_min']
            : null;
        $priceMax = $request->filled('price_max') && isset($validated['price_max']) && $validated['price_max'] !== null
            ? (int) $validated['price_max']
            : null;

        $minRating = isset($validated['min_rating']) && $validated['min_rating'] !== null
            ? (int) $validated['min_rating']
            : null;

        $query = Product::query()
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        if ($productSearch !== '') {
            $query->where(function ($sub) use ($productSearch) {
                $sub->where('name', 'like', '%'.$productSearch.'%')
                    ->orWhere('description', 'like', '%'.$productSearch.'%');
            });
        }

        if ($priceMin !== null && $priceMin > 0) {
            $query->where('price', '>=', $priceMin);
        }
        if ($priceMax !== null && $priceMax > 0) {
            $query->where('price', '<=', $priceMax);
        }

        if ($minRating !== null && $minRating >= 1 && $minRating <= 5) {
            $query->having('reviews_avg_rating', '>=', $minRating);
        }

        $products = $query->get();

        $favorites = $request->session()->get('favorites', []);
        $products = $products
            ->sortByDesc(fn ($product) => in_array($product->getId(), $favorites))
            ->values();

        $hasActiveFilters = $productSearch !== ''
            || ($priceMin !== null && $priceMin > 0)
            || ($priceMax !== null && $priceMax > 0)
            || ($minRating !== null && $minRating >= 1);

        $viewData = [];
        $viewData['products'] = $products;
        $viewData['product_search'] = $productSearch;
        $viewData['price_min'] = $request->filled('price_min') ? (string) $priceMin : '';
        $viewData['price_max'] = $request->filled('price_max') ? (string) $priceMax : '';
        $viewData['min_rating'] = $minRating !== null ? (string) $minRating : '';
        $viewData['has_active_filters'] = $hasActiveFilters;

        $viewData['topProducts'] = $hasActiveFilters
            ? collect()
            : Product::getMostPurchased(3);

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(int $product): View
    {
        $viewData = [];
        $viewData['product'] = Product::with('reviews.user')->withAvg('reviews', 'rating')->withCount('reviews')->findOrFail($product);

        return view('product.show')->with('viewData', $viewData);
    }
}
