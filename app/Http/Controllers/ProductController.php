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
        $priceMin = isset($validated['price_min']) ? (int) $validated['price_min'] : null;
        $priceMax = isset($validated['price_max']) ? (int) $validated['price_max'] : null;
        $minRating = isset($validated['min_rating']) ? (int) $validated['min_rating'] : null;

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

        if ($minRating !== null) {
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
            || $minRating !== null;

        $viewData = [
            'products' => $products,
            'product_search' => $productSearch,
            'price_min' => $priceMin !== null ? (string) $priceMin : '',
            'price_max' => $priceMax !== null ? (string) $priceMax : '',
            'min_rating' => $minRating !== null ? (string) $minRating : '',
            'has_active_filters' => $hasActiveFilters,
            'topProducts' => $hasActiveFilters ? collect() : Product::getMostPurchased(3),
        ];

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(int $product): View
    {
        $viewData = [];
        $viewData['product'] = Product::with('reviews.user')->withAvg('reviews', 'rating')->withCount('reviews')->findOrFail($product);

        return view('product.show')->with('viewData', $viewData);
    }
}
