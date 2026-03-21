<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $total = 0;
        $productsInCart = [];
        $productsInSession = $request->session()->get('products', []);

        if (! empty($productsInSession)) {
            $products = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($products, $productsInSession);

            foreach ($products as $product) {
                $quantity = $productsInSession[$product->getId()] ?? 1;
                $productsInCart[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->getPrice() * $quantity,
                ];
            }
        }

        $viewData = [];
        $viewData['total'] = $total;
        $viewData['products'] = $productsInCart;

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(AddCartRequest $request, int $product): RedirectResponse
    {
        $quantity = $request->input('quantity');
        $products = $request->session()->get('products', []);

        if (isset($products[$product])) {
            $products[$product] += $quantity;
        } else {
            $products[$product] = $quantity;
        }

        $request->session()->put('products', $products);

        return redirect()->route('product.index');
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->session()->forget('products');

        return redirect()->route('product.index');
    }

    public function purchase(Request $request): RedirectResponse
    {
        $productsInSession = $request->session()->get('products');

        if (! $productsInSession) {
            return redirect()->route('cart.index');
        }

        $productsInCart = Product::findMany(array_keys($productsInSession));
        $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);

        if (Auth::user()->getBalance() < $total) {
            return redirect()->route('cart.index')->with('error', __('messages.cart.insufficient_balance'));
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total' => $total,
        ]);

        foreach ($productsInCart as $product) {
            Item::create([
                'quantity' => $productsInSession[$product->getId()],
                'price' => $product->getPrice(),
                'product_id' => $product->getId(),
                'order_id' => $order->getId(),
            ]);
        }

        Auth::user()->setBalance(Auth::user()->getBalance() - $total);
        Auth::user()->save();

        $request->session()->forget('products');

        return redirect()->route('product.index')->with('success', __('messages.cart.purchase_success'));
    }
}
