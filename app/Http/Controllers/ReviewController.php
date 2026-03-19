<?php

/**
 * Author:Juan Esteban Trujillo Montes
 * Description: Controller responsible for managing reviews
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, int $product): RedirectResponse
    {
        $product = Product::findOrFail($product);

        Review::create([
            'description' => $request->input('description'),
            'rating' => $request->input('rating'),
            'product_id' => $product->getId(),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('product.show', ['product' => $product->getId()])->with('success', __('messages.product.review_added'));
    }

    public function edit(int $product, int $review): View
    {
        $viewData = [];
        $viewData['review'] = Review::findOrFail($review);

        if (Auth::id() !== $viewData['review']->getUserId()) {
            abort(403);
        }

        return view('review.edit')->with('viewData', $viewData);
    }

    public function update(StoreReviewRequest $request, int $product, int $review): RedirectResponse
    {
        $review = Review::findOrFail($review);

        if (Auth::id() !== $review->getUserId()) {
            abort(403);
        }

        $review->setDescription($request->input('description'));
        $review->setRating($request->input('rating'));
        $review->save();

        return redirect()->route('product.show', ['product' => $product])->with('success', __('messages.product.review_updated'));
    }

    public function destroy(int $product, int $review): RedirectResponse
    {
        $review = Review::findOrFail($review);

        if (Auth::id() !== $review->getUserId()) {
            abort(403);
        }

        $review->delete();

        return redirect()->route('product.show', ['product' => $product])->with('success', __('messages.product.review_deleted'));
    }
}
