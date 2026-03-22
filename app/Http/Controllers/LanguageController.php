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
        session(['locale' => $locale]);

        return redirect()->back();
    }
}
