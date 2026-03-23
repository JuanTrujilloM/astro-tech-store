<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Controller responsible for managing the home page.
 */

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['homeProducts'] = Product::orderBy('created_at', 'desc')->take(9)->get();
        $viewData['topHomeProducts'] = Product::getMostPurchased(3);
        $viewData['homeReviews'] = Review::with(['user', 'product'])->where('rating', '>=', 3)->orderBy('created_at', 'desc')->take(9)->get();

        return view('home.index')->with('viewData', $viewData);
    }

    public function about(): View
    {
        return view('home.about');
    }

    public function contact(): View
    {
        return view('home.contact');
    }
}
