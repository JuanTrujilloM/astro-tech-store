<?php

/**
 * Author: Andrés Pérez Quinchía
 * Description: Generates a PDF report of all orders
 */

namespace App\Services;

use App\Interfaces\ReportServiceInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class PdfReportService implements ReportServiceInterface
{
    public function generate(Collection $orders): Response
    {
        $pdf = Pdf::loadView('admin.order.report-pdf', ['orders' => $orders]);

        return $pdf->download('orders-report.pdf');
    }
}
