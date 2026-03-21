<?php

/**
 * Author: Andres Perez Quinchia
 * Description: Controller responsible for managing products
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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
        $newProduct = Product::create($request->only(['name', 'description', 'price', 'stock']));

        if ($request->hasFile('image')) {
            $imageName = $newProduct->getId().'.'.$request->file('image')->extension();
            Storage::disk('public')->put($imageName, file_get_contents($request->file('image')->getRealPath()));
            $newProduct->setImage($imageName);
            $newProduct->save();
        }

        return redirect()->route('admin.product.index')->with('success', __('messages.admin.success_product_created'));
    }

    public function edit(int $product): View
    {
        $viewData = [];
        $viewData['product'] = Product::findOrFail($product);

        return view('admin.product.edit')->with('viewData', $viewData);
    }

    public function update(StoreProductRequest $request, int $product): RedirectResponse
    {
        $product = Product::findOrFail($product);
        $product->setName($request->input('name'));
        $product->setDescription($request->input('description'));
        $product->setPrice($request->input('price'));
        $product->setStock($request->input('stock'));

        if ($request->hasFile('image')) {
            $imageName = $product->getId().'.'.$request->file('image')->extension();
            Storage::disk('public')->put($imageName, file_get_contents($request->file('image')->getRealPath()));
            $product->setImage($imageName);
        }

        $product->save();

        return redirect()->route('admin.product.index');
    }

    public function destroy(int $product): RedirectResponse
    {
        Product::destroy($product);

        return redirect()->route('admin.product.index')->with('success', __('messages.admin.success_product_deleted'));
    }
}
