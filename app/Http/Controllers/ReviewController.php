<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request): RedirectResponse
    {
        $product = Product::findOrFail($request->input('product_id'));

        Review::create(['description' => $request->input('description'), 'rating' => $request->input('rating'), 'product_id' => $product->getId()]);

        return redirect()->route('product.show', ['id' => $product->getId()])->with('success', __('messages.product.review_added'));
    }

    public function edit(int $id): View
    {
        $viewData = [];
        $viewData['review'] = Review::findOrFail($id);

        return view('review.edit')->with('viewData', $viewData);
    }

    public function update(StoreReviewRequest $request, int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $review->setDescription($request->input('description'));
        $review->setRating($request->input('rating'));
        $review->save();

        return redirect()->route('product.show', ['id' => $review->getProductId()])->with('success', __('messages.product.review_updated'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $productId = $review->getProductId();
        $review->delete();

        return redirect()->route('product.show', ['id' => $productId])->with('success', __('messages.product.review_deleted'));
    }
}
