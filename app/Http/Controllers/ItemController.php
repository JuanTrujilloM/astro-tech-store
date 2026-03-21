<?php

/**
 * Author: Andres Perez Quinchia
 * Description: Controller responsible for managing items
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function store(StoreItemRequest $request): RedirectResponse
    {
        $newItem = Item::create($request->only(['quantity', 'price']));
    }
}