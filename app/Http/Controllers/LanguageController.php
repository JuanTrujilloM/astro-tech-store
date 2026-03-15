<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    public function switch(string $locale)
    {
        session(['locale' => $locale]);

        return redirect()->back();
    }
}
