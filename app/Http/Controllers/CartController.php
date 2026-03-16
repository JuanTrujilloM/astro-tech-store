<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $total = 0;
        $productsInCart = [];
        $productsInSession = $request->session()->get('products');
        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);
        }
        $viewData = [];
        $viewData['total'] = $total;
        $viewData['products'] = $productsInCart;
        $viewData['productsInSession'] = $productsInSession ?? [];

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(Request $request, int $id)
    {
        $products = $request->session()->get('products');
        if ($products) {
            $products[$id] = $request->input('quantity');
        } else {
            $products = [];
            $products[$id] = $request->input('quantity');
        }
        $request->session()->put('products', $products);

        return redirect()->route('cart.index');
    }

    public function delete(Request $request)
    {
        $request->session()->forget('products');

        return back();
    }
}
