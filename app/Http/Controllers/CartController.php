<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function purchase(Request $request)
    {
        $productsInSession = $request->session()->get('products');

        if ($productsInSession) {
            $userId = Auth::user()->getId();

            $order = new Order;
            $order->setUserId($userId);
            $order->status = 'pending';
            $order->setTotal(0);
            $order->save();

            $total = 0;
            $productsInCart = Product::findMany(array_keys($productsInSession));

            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->getId()];

                $item = new Item;
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->setProductId($product->getId());
                $item->setOrderId($order->id);
                $item->save();

                $total += $product->getPrice() * $quantity;
            }

            $order->setTotal($total);
            $order->save();

            $newBalance = Auth::user()->getBalance() - $total;
            Auth::user()->setBalance($newBalance);
            Auth::user()->save();

            $request->session()->forget('products');

            $viewData = [];
            $viewData['title'] = 'Purchase - Online Store';
            $viewData['subtitle'] = 'Purchase Status';
            $viewData['order'] = $order;

            return view('cart.purchase')->with('viewData', $viewData);
        }

        return redirect()->route('cart.index');
    }
}
