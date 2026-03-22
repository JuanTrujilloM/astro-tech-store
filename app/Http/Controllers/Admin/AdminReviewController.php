<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Controller for managing reviews in the admin panel, allowing administrators to view and delete reviews.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminReviewController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['reviews'] = Review::all();

        return view('admin.review.index')->with('viewData', $viewData);
    }

    public function destroy(int $review): RedirectResponse
    {
        Review::destroy($review);

        return redirect()->route('admin.review.index')->with('success', __('messages.admin.success_review_deleted'));
    }
}
