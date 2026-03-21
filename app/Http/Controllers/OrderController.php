<?php

/**
 * Author: Juan Sebastián Lizcano Urrea
 * Description: Controller responsible for managing Orders
 */

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('items.product')->where('user_id', Auth::id())->get();

        $viewData = [];
        $viewData['orders'] = $orders;

        return view('order.index')->with('viewData', $viewData);
    }

    public function show(int $order): View
    {
        $order = Order::with('items.product')->where('id', $order)->where('user_id', Auth::id())->firstOrFail();

        $viewData = [];
        $viewData['order'] = $order;

        return view('order.show')->with('viewData', $viewData);
    }

    public function cancel(int $order): RedirectResponse
    {
        $order = Order::where('id', $order)->where('user_id', Auth::id())->firstOrFail();

        if ($order->getCanBeCancelled()) {
            $order->setStatus('cancelled');
            $order->save();
        }

        return redirect()->route('order.index');
    }
}
