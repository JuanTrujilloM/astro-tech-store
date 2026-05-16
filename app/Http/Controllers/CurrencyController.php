<?php

/**
 * Author: Andrés Pérez Quinchía
 * Description: Controller responsible for handling currency switching
 */

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    private const SUPPORTED_CURRENCIES = ['COP', 'USD', 'EUR', 'GBP'];

    public function switch(Request $request, string $currency): RedirectResponse
    {
        $currency = strtoupper($currency);

        if (in_array($currency, self::SUPPORTED_CURRENCIES)) {
            $request->session()->put('currency', $currency);
        }

        return redirect()->back();
    }
}
