<?php
/**
 * Author: Andrés Pérez Quinchía
 * Description: Service responsible for using currency exchange rates an external API.
 */
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExchangeRateService
{
    private string $apiKey;
    private string $baseCurrency;
    private string $baseUrl = 'https://v6.exchangerate-api.com/v6';
    private int $cacheTtlMinutes = 60;

    public function __construct()
    {
        $this->apiKey = config('services.exchange_rate.key');
        $this->baseCurrency = config('services.exchange_rate.base_currency');
    }

    public function rateFor(string $targetCurrency): ?float
    {
        if (strtoupper($targetCurrency) === strtoupper($this->baseCurrency)) {
            return 1.0;
        }

        $rates = $this->fetchRates();

        if ($rates === null) {
            return null;
        }

        return $rates[strtoupper($targetCurrency)] ?? null;
    }

    public function fetchBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    public function fetchSupportedCurrencies(): array
    {
        $rates = $this->fetchRates();

        if ($rates === null) {
            return [];
        }

        return array_keys($rates);
    }

    private function fetchRates(): ?array
    {
        $cacheKey = 'exchange_rates_' . strtolower($this->baseCurrency);

        return Cache::remember($cacheKey, now()->addMinutes($this->cacheTtlMinutes), function () {
            try {
                $response = Http::timeout(5)
                    ->get("{$this->baseUrl}/{$this->apiKey}/latest/{$this->baseCurrency}");

                if ($response->successful() && $response->json('result') === 'success') {
                    return $response->json('conversion_rates');
                }

                Log::warning('ExchangeRate API returned unsuccessful response', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                return null;

            } catch (\Exception $e) {
                Log::error('ExchangeRate API request failed', ['error' => $e->getMessage()]);
                return null;
            }
        });
    }
}