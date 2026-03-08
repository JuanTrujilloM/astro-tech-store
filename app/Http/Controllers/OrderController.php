<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'total' => 'required',
            'status' => 'required|in:pending,completed,cancelled',
            'can_be_cancelled' => 'nullable|boolean',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ]);

        $request['can_be_cancelled'] = (bool) ($request->input('can_be_cancelled', 0));
        if (empty($request['created_at'])) {
            $request['created_at'] = now();
        }
        if (empty($request['updated_at'])) {
            $request['updated_at'] = now();
        }
        Order::create($request->only('total', 'status', 'can_be_cancelled', 'created_at', 'updated_at'));

        return redirect()->route('orders.success');
    }

    public function success(): View
    {
        return view('orders.success');
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
