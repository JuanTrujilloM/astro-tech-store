<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['products'] = Product::all();

        return view('admin.product.index')->with('viewData', $viewData);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        Product::create($request->only(['name', 'description', 'price', 'stock', 'image']));

        return redirect()->route('admin.product.index')->with('success', __('messages.admin.success_product_created'));
    }

    public function edit(int $id): View
    {
        $viewData = [];
        $viewData['product'] = Product::findOrFail($id);

        return view('admin.products.edit')->with('viewData', $viewData);
    }

    public function update(StoreProductRequest $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->setName($request->input('name'));
        $product->setDescription($request->input('description'));
        $product->setPrice($request->input('price'));
        $product->setStock($request->input('stock'));
        $product->setImage($request->input('image'));

        $product->save();

        return redirect()->route('admin.product.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        Product::destroy($id);

        return redirect()->route('admin.product.index')->with('success', __('messages.admin.success_product_deleted'));
    }
}