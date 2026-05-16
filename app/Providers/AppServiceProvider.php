<?php

namespace App\Providers;

use App\Services\ExchangeRateService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ExchangeRateService::class, function () {
            return new ExchangeRateService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $exchangeRateService = $this->app->make(ExchangeRateService::class);

        View::composer('*', function ($view) use ($exchangeRateService) {
            $selectedCurrency = session('currency', $exchangeRateService->fetchBaseCurrency());
            $rate = $exchangeRateService->rateFor($selectedCurrency);

            $view->with([
                'selectedCurrency' => $selectedCurrency,
                'exchangeRate'     => $rate,
                'rateAvailable'    => $rate !== null,
            ]);
        });
    }
}
