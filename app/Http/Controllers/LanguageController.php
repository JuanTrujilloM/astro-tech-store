<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Controller for managing language preferences, allowing users to switch between different locales in the application
 */

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function switch(string $locale): RedirectResponse
    {
        $supportedLocales = ['en', 'es'];
        if (!in_array($locale, $supportedLocales)) {
            return redirect()->back();
        }
        session(['locale' => $locale]);
        return redirect()->back();
    }
}
