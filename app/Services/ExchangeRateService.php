<?php

/**
 * Author: Andrés Pérez Quinchía
 * Description: Service responsible for using currency exchange rates an external API.
 */

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExchangeRateService
{
    private const BASE_URL = 'https://v6.exchangerate-api.com/v6';

    private string $apiKey;

    private string $baseCurrency;

    public function __construct()
    {
        $this->apiKey = config('services.exchange_rate.key');
        $this->baseCurrency = strtoupper(config('services.exchange_rate.base_currency'));
    }

    public function rateFor(string $targetCurrency): ?float
    {
        $currency = strtoupper($targetCurrency);

        if ($currency === $this->baseCurrency) {
            return 1.0;
        }

        return $this->fetchRates()[$currency] ?? null;
    }

    public function fetchBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    private function fetchRates(): ?array
    {
        return Cache::remember('exchange_rates_'.strtolower($this->baseCurrency), now()->addHour(), function () {
            try {
                $response = Http::timeout(5)
                    ->get(self::BASE_URL."/{$this->apiKey}/latest/{$this->baseCurrency}");

                if ($response->successful() && $response->json('result') === 'success') {
                    return $response->json('conversion_rates');
                }

                Log::warning('ExchangeRate API returned unsuccessful response', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return null;

            } catch (Exception $e) {
                Log::error('ExchangeRate API request failed', ['error' => $e->getMessage()]);

                return null;
            }
        });
    }
}
