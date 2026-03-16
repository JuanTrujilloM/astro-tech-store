<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['products'] = Product::withAvg('reviews', 'rating')->withCount('reviews')->get();

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $viewData = [];
        $viewData['product'] = Product::with('reviews')->withAvg('reviews', 'rating')->withCount('reviews')->findOrFail($id);

        return view('product.show')->with('viewData', $viewData);
    }
    public static function sumPricesByQuantities($products, $productsInSession)
    {
        $total = 0;
        foreach ($products as $product) {
            $total = $total + ($product->getPrice()*$productsInSession[$product->getId()]);
        }
        return $total;
    }
}
