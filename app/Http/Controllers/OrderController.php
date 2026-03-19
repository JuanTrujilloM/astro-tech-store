<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Author: Juan Sebastián Lizcano Urrea
     * Description: Controller responsible for managing orders
     */
    
    public function index(): View
    {
        return view('orders.index');
    }

    public function list(): View
    {
        $viewData = [];
        $viewData['Orders'] = Order::all();

        return view('orders.list')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $viewData = [];
        $product = Order::findOrFail($id);
        $viewData['Order'] = $product;

        return view('orders.show')->with('viewData', $viewData);
    }

    public function delete(string $id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.list')->with('success', 'Order deleted successfully.');
    }
}
