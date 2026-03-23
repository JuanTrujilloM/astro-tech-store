<?php

/**
 * Author: Juan Sebastián Lizcano Urrea
 * Description: Controller responsible for managing Cart
 */

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Http\Requests\ApplyDiscountRequest;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    private const DISCOUNT_CODES = [
        'DanielCOrrea' => 20,
        'SoftwareArchitecture' => 10,
        'SecretCode' => 30,
        'QueCochinadaDeCodigo' => 100,
    ];

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

        $discount = $request->session()->get('discount');
        $discountAmount = 0;
        if ($discount && $total > 0) {
            $discountAmount = intval($total * $discount['percentage'] / 100);
        }

        $viewData = [];
        $viewData['total'] = $total;
        $viewData['discount'] = $discount;
        $viewData['discountAmount'] = $discountAmount;
        $viewData['totalWithDiscount'] = $total - $discountAmount;
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

    public function applyDiscount(ApplyDiscountRequest $request): RedirectResponse
    {
        $input = trim($request->input('discount_code', ''));
        $matchedCode = null;

        foreach (self::DISCOUNT_CODES as $code => $percentage) {
            if (strcasecmp($code, $input) === 0) {
                $matchedCode = $code;
                break;
            }
        }

        if (! $matchedCode) {
            return redirect()->route('cart.index')->with('error', __('messages.cart.discount_invalid'));
        }

        $request->session()->put('discount', [
            'code' => $matchedCode,
            'percentage' => self::DISCOUNT_CODES[$matchedCode],
        ]);

        return redirect()->route('cart.index')->with('success', __('messages.cart.discount_applied', ['percentage' => self::DISCOUNT_CODES[$matchedCode]]));
    }

    public function removeDiscount(Request $request): RedirectResponse
    {
        $request->session()->forget('discount');

        return redirect()->route('cart.index');
    }

    public function purchase(Request $request): RedirectResponse
    {
        $productsInSession = $request->session()->get('products');

        if (! $productsInSession) {
            return redirect()->route('cart.index');
        }

        $productsInCart = Product::findMany(array_keys($productsInSession));
        $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);

        $discount = $request->session()->get('discount');
        if ($discount) {
            $total -= intval($total * $discount['percentage'] / 100);
        }

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
        $request->session()->forget('discount');

        return redirect()->route('product.index')->with('success', __('messages.cart.purchase_success'));
    }
}
