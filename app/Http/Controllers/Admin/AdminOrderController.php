<?php

/**
 * Author: Andres Perez Quinchia
 * Description: Controller responsible for managing orders from the administrator side
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['orders'] = Order::with('user')->get();

        return view('admin.order.index')->with('viewData', $viewData);
    }

    public function updateStatus(UpdateOrderStatusRequest $request, int $order): RedirectResponse
    {
        $order = Order::with('items.product')->findOrFail($order);
        $newStatus = $request->input('status');

        if ($newStatus === 'cancelled' && $order->getStatus() !== 'cancelled') {
            foreach ($order->getItems() as $item) {
                $product = $item->getProduct();
                $product->setStock($product->getStock() + $item->getQuantity());
                $product->save();
            }
        }

        $order->setStatus($newStatus);
        $order->save();

        return redirect()->route('admin.order.index');
    }
}
