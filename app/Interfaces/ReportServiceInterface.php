<?php
/**
 * Author: Andrés Pérez Quinchía
 * Description: Interface that defines the contract for report generation services.
 */
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

interface ReportServiceInterface
{
    public function generate(Collection $orders): Response;
}