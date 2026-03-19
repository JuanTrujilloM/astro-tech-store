<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function orders()
    {
        // Hide cancelled orders from the user's list
        $orders = Order::where('user_id', Auth::user()->getId())
            ->where('status', '!=', 'cancelled')
            ->get();

        return view('myaccount.orders')->with('orders', $orders);
    }

    public function cancelOrder(int $order): RedirectResponse
    {
        $currentUserId = Auth::user()->getId();
        $order = Order::where('id', $order)->where('user_id', $currentUserId)->firstOrFail();

        $wasCancelled = $order->cancelIfPossible();

        return redirect()->route('my-account.orders')
            ->with(
                'success',
                $wasCancelled ? __('messages.orders.cancel_success') : __('messages.orders.not_cancelable')
            );
    }
}
