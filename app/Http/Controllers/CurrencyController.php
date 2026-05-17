<?php

/**
 * Author: Andrés Pérez Quinchía
 * Description: Controller responsible for handling currency switching
 */

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class CurrencyController extends Controller
{
    public function switch(string $currency): RedirectResponse
    {
        $currency = strtoupper($currency);

        if (! array_key_exists($currency, config('currencies'))) {
            return redirect()->back();
        }

        session(['currency' => $currency]);

        return redirect()->back();
    }
}
