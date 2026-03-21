<?php

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
        $viewData['orders'] = Order::all();

        return view('admin.order.index')->with('viewData', $viewData);
    }

    public function updateStatus(UpdateOrderStatusRequest $request, int $order): RedirectResponse
    {
        $order = Order::findOrFail($order);
        $order->setStatus($request->input('status'));
        $order->save();

        return redirect()->route('admin.order.index');
    }
}
