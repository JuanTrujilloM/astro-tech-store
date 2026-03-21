@extends('layouts.admin')
@section('title', __('messages.admin.title'))
@section('page_title', __('messages.admin.reviews'))
@section('content')

  <div class="admin-product-page">

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="card border-0 shadow-sm admin-product-card">
      <div class="card-header py-3 admin-product-card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          <i class="bi bi-star me-2"></i>
          {{ __('messages.admin.review_list') }}
        </h5>
        <span class="admin-product-badge">{{ $viewData['reviews']->count() }} {{ __('messages.admin.items') }}</span>
      </div>
      <div class="card-body p-0">
        @if ($viewData['reviews']->isEmpty())
          <div class="p-4 admin-product-empty">{{ __('messages.admin.no_reviews_registered') }}</div>
        @else
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 admin-product-table">
              <thead>
                <tr>
                  <th>{{ __('messages.admin.id') }}</th>
                  <th>{{ __('messages.admin.user') }}</th>
                  <th>{{ __('messages.admin.product') }}</th>
                  <th>{{ __('messages.admin.rating') }}</th>
                  <th>{{ __('messages.admin.description') }}</th>
                  <th class="text-center">{{ __('messages.admin.actions') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($viewData['reviews'] as $review)
                  <tr>
                    <td>{{ $review->getId() }}</td>
                    <td>{{ $review->getUser()->getName() }}</td>
                    <td>{{ $review->getProduct()->getName() }}</td>
                    <td>
                      @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $review->getRating())
                          <i class="bi bi-star-fill star-gold"></i>
                        @else
                          <i class="bi bi-star-fill star-gray"></i>
                        @endif
                      @endfor
                    </td>
                    <td class="admin-product-description">{{ $review->getDescription() }}</td>
                    <td class="text-center">
                      <form action="{{ route('admin.review.destroy', ['review' => $review->getId()]) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm admin-product-btn-danger"
                          title="{{ __('messages.admin.delete_action') }}"
                          onclick="return confirm('{{ __('messages.admin.confirm_delete_review') }}');">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>

  </div>

@endsection
