<?php

/**
 * Author: Andrés Pérez Quinchía
 * Description: Controller responsible for managing favorite products
 */

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function add(Request $request, int $id): RedirectResponse
    {
        $favorites = $request->session()->get('favorites', []);

        if (! in_array($id, $favorites)) {
            $favorites[] = $id;
            $request->session()->put('favorites', $favorites);
        }

        return redirect()->back()->with('success', __('messages.product.add_to_favorites'));
    }

    public function remove(Request $request, int $id): RedirectResponse
    {
        $favorites = $request->session()->get('favorites', []);

        if (in_array($id, $favorites)) {
            $favorites = array_diff($favorites, [$id]);
            $request->session()->put('favorites', $favorites);
        }

        return redirect()->back()->with('success', __('messages.product.remove_from_favorites'));
    }
}
