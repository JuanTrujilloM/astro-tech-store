<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Middleware responsible for setting the active currency and sharing exchange rate data with all views
 */

namespace App\Http\Middleware;

use App\Services\ExchangeRateService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class SetCurrency
{
    private ExchangeRateService $exchangeRateService;

    public function __construct(ExchangeRateService $exchangeRateService)
    {
        $this->exchangeRateService = $exchangeRateService;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $selectedCurrency = session('currency', $this->exchangeRateService->getBaseCurrency());
        $rate = $this->exchangeRateService->rateFor($selectedCurrency);

        View::share([
            'selectedCurrency' => $selectedCurrency,
            'exchangeRate' => $rate,
            'rateAvailable' => $rate !== null,
            'supportedCurrencies' => config('currencies'),
        ]);

        return $next($request);
    }
}
