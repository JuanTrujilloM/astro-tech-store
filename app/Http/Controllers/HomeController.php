<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home.index');
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
