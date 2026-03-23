<?php

/**
 * Author: Andres Perez Quinchia
 * Description: Controller responsible for managing the main view  of the administrator
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\View\View;

class AdminHomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['users'] = User::count();
        $viewData['products'] = Product::count();
        $viewData['orders'] = Order::count();
        $viewData['reviews'] = Review::count();
        $viewData['income'] = Order::where('status', '!=', 'cancelled')->sum('total');

        return view('admin.home.index')->with('viewData', $viewData);
    }
}
