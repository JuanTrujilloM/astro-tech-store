<!--
  Author: Juan Esteban Trujillo Montes
  Description: View responsible for showing product details and managing reviews
-->

@extends('layouts.app')

@section('title', $viewData['product']->getName() . ' - ' . __('messages.layout.title_default'))

@section('content')
  <div class="row mb-3">
    <div class="col-12 product-detail-header">
      <h4 class="fw-bold mb-0">{{ __('messages.product.details_title') }}</h4>
      <a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>{{ __('messages.product.back_to_products') }}
      </a>
    </div>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="row g-0">
      <div class="col-12 col-md-5">
        @if ($viewData['product']->getImage())
          <img src="{{ asset('storage/' . $viewData['product']->getImage()) }}"
            class="img-fluid h-100 w-100 product-detail-img" alt="{{ $viewData['product']->getName() }}">
        @else
          <div class="h-100 bg-light product-detail-no-img">
            <div class="product-detail-no-img-inner text-muted">
              <i class="bi bi-image fs-1"></i>
              <span>{{ __('messages.admin.no_image') }}</span>
            </div>
          </div>
        @endif
      </div>

      <div class="col-12 col-md-7">
        <div class="card-body p-4">
          <h3 class="card-title mb-3">{{ $viewData['product']->getName() }}</h3>

          <p class="card-text text-muted mb-4">
            {{ $viewData['product']->getDescription() }}
          </p>

          <div class="product-detail-meta mt-4 pt-3">
            <div class="product-detail-meta-row">
              <div>
                <small class="text-muted d-block">{{ __('messages.admin.price') }}</small>
                <span
                  class="product-detail-price">${{ number_format($viewData['product']->getPrice(), 0, ',', '.') }}</span>
              </div>

              <div class="small">
                @if ($viewData['product']->reviews_count > 0)
                  <span class="fw-semibold d-block">
                    @for ($i = 1; $i <= 5; $i++)
                      @if ($i <= floor($viewData['product']->reviews_avg_rating))
                        <i class="bi bi-star-fill star-gold"></i>
                      @elseif ($i - $viewData['product']->reviews_avg_rating <= 0.5)
                        <i class="bi bi-star-half star-gold"></i>
                      @else
                        <i class="bi bi-star-fill star-gray"></i>
                      @endif
                    @endfor
                    {{ number_format($viewData['product']->reviews_avg_rating, 1) }}
                  </span>
                  <span class="text-muted">
                    ({{ $viewData['product']->reviews_count }} {{ __('messages.product.reviews_count') }})
                  </span>
                @else
                  <span class="text-muted">{{ __('messages.product.no_reviews') }}</span>
                @endif
              </div>

              <div class="product-detail-meta-stock">
                @if ($viewData['product']->getStock() > 0)
                  <span class="product-stock-pill in-stock">{{ __('messages.product.in_stock') }}</span>
                @else
                  <span class="product-stock-pill out-stock">{{ __('messages.product.out_of_stock') }}</span>
                @endif
              </div>
            </div>

            @if ($viewData['product']->getStock() > 0)
              <div class="product-detail-add-cart mt-4">
                <p class="card-text mb-2"><small class="text-muted">{{ __('messages.product.add_to_cart') }}</small></p>
                <form method="POST" action="{{ route('cart.add', ['product' => $viewData['product']->getId()]) }}"
                  class="product-detail-add-cart-form">
                  @csrf
                  <div class="input-group">
                    <span class="input-group-text">{{ __('messages.product.quantity') }}</span>
                    <input type="number" min="1" max="10" class="form-control quantity-input"
                      name="quantity" value="1" aria-label="{{ __('messages.product.quantity') }}">
                  </div>
                  <button class="btn btn-primary" type="submit">
                    <i class="bi bi-cart-plus me-1"></i>{{ __('messages.product.add_to_cart') }}
                  </button>
                </form>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-flash" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card border-0 shadow-sm mt-4">
    <div class="card-body p-4">
      <h5 class="mb-3 text-center">{{ __('messages.product.add_review') }}</h5>
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
          @auth
            <form action="{{ route('review.store', ['product' => $viewData['product']->getId()]) }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="rating" class="form-label">{{ __('messages.product.rating') }}</label>
                <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror">
                  <option value="">--</option>
                  @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }}
                    </option>
                  @endfor
                </select>
                @error('rating')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="description" class="form-label">{{ __('messages.product.review_description') }}</label>
                <textarea name="description" id="description" rows="3"
                  class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-danger">{{ __('messages.product.submit_review') }}</button>
              </div>
            </form>
          @else
            <p class="mb-0 text-center text-muted">{{ __('messages.product.login_to_review') }}</p>
          @endauth
        </div>
      </div>
    </div>
  </div>

  <div class="card border-0 shadow-sm card-section">
    <div class="card-body">
      <h5 class="card-section-title">{{ __('messages.admin.reviews') }}</h5>

      @if ($viewData['product']->reviews_count > 0)
        <div class="reviews-grid">
          @foreach ($viewData['product']->getReviews() as $review)
            <div class="col">
              <article class="product-review-card h-100">
                <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                  <div>
                    <div class="small fw-semibold mb-1 text-dark">
                      {{ __('messages.product.review_by_user', ['name' => $review->getUser()?->getName() ?? '']) }}</div>
                    <div class="product-review-stars mb-1">
                      {{ __('messages.product.review_by_user', ['name' => $review->getUser()?->getName() ?? '']) }}</div>
                    <div class="product-review-stars mb-1">
                      @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $review->getRating())
                          <i class="bi bi-star-fill star-gold"></i>
                        @else
                          <i class="bi bi-star-fill star-gray"></i>
                        @endif
                      @endfor
                      <span class="small text-muted">({{ number_format($review->getRating(), 0) }})</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-2">
                    <span class="product-review-quote">
                      <i class="bi bi-quote"></i>
                    </span>
                    @auth
                      @if (auth()->id() === $review->getUserId())
                        <a href="{{ route('review.edit', ['product' => $viewData['product']->getId(), 'review' => $review->getId()]) }}"
                          class="btn btn-sm btn-outline-secondary" title="{{ __('messages.product.edit_review') }}">
                          <i class="bi bi-pencil"></i>
                        </a>
                        <form
                          action="{{ route('review.destroy', ['product' => $viewData['product']->getId(), 'review' => $review->getId()]) }}"
                          method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-outline-danger"
                            title="{{ __('messages.product.delete_review') }}">
                            <i class="bi bi-trash3"></i>
                          </button>
                        </form>
                      @endif
                    @endauth
                  </div>
                </div>
            </div>
            <p class="mb-0 text-muted product-review-text">{{ $review->getDescription() }}</p>
            </article>
          @endforeach
        </div>
      @else
        <p class="mb-0 text-muted text-center">{{ __('messages.product.no_reviews') }}</p>
      @endif
    </div>
  </div>
@endsection
