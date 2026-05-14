<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Controller responsible for fetching allied products from an external API and passing the data to the view for display.
 */

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AlliedProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['products'] = [];

        try {
            // Fetch allied products from the external API with a timeout of 5 seconds
            $response = Http::timeout(5)->get(env('ALLIED_API_ENDPOINT'));

            if ($response->failed()) {
                session()->flash('error', __('messages.allied.error'));

                return view('allied.index')->with('viewData', $viewData);
            }

            $viewData['products'] = $response->json('data');
        } catch (Exception $e) {
            session()->flash('error', __('messages.allied.error'));
        }

        return view('allied.index')->with('viewData', $viewData);
    }
}
