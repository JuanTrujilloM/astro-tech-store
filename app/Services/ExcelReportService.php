<?php
/**
 * Author: Andrés Pérez Quinchía
 * Description: Implementation that generates a CSV report of all orders.
 */
namespace App\Services;

use App\Interfaces\ReportServiceInterface;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use League\Csv\Writer;

class ExcelReportService implements ReportServiceInterface
{
    public function generate(Collection $orders): Response
    {
        $csv = Writer::createFromString('');

        $csv->insertOne(['ID', 'User', 'Total', 'Date', 'Status']);

        foreach ($orders as $order) {
            $csv->insertOne([
                $order->getId(),
                $order->getUser()->getName(),
                $order->getTotal(),
                $order->getCreatedAt(),
                $order->getStatus(),
            ]);
        }

        return response($csv->toString(), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="orders-report.csv"',
        ]);
    }
}