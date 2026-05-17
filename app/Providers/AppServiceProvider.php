<?php

namespace App\Providers;

use App\Interfaces\ReportServiceInterface;
use App\Services\ExcelReportService;
use App\Services\PdfReportService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ReportServiceInterface::class, function ($app, $parameters) {
            return match ($parameters['format']) {
                'csv' => new ExcelReportService,
                default => new PdfReportService,
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
