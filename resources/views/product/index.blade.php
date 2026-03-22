<!--
  Author: Juan Esteban Trujillo Montes
  Description: View responsible for showing the list of products available in the store
-->
@extends('layouts.app')
@section('title', __('messages.layout.nav.products') . ' - ' . __('messages.layout.title_default'))
@section('content')

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="row mb-3">
    <div class="col-12">
      <h4 class="fw-bold mb-3">{{ __('messages.admin.product_list') }}</h4>
    </div>
    <div class="col-12">
      <div class="card shadow-sm border-0 product-filters-card">
        <div class="card-body">
          <h6 class="card-subtitle mb-3 text-muted">{{ __('messages.product.filters_title') }}</h6>
          <form method="GET" action="{{ route('product.index') }}" class="product-filters-form" role="search">
            <div class="row g-3 align-items-end">
              <div class="col-12 col-md-6 col-lg-4">
                <label for="product-search-product_search" class="form-label small mb-1">{{ __('messages.product.search_placeholder') }}</label>
                <input type="search" name="product_search" id="product-search-product_search"
                  value="{{ old('product_search', $viewData['product_search'] ?? '') }}"
                  class="form-control @error('product_search') is-invalid @enderror"
                  placeholder="{{ __('messages.product.search_placeholder') }}" maxlength="100" autocomplete="off">
                @error('product_search')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-6 col-md-3 col-lg-2">
                <label for="filter-price-min" class="form-label small mb-1">{{ __('messages.product.filter_price_min') }}</label>
                <input type="text" name="price_min" id="filter-price-min" min="0" step="1"
                  value="{{ old('price_min', $viewData['price_min'] ?? '') }}"
                  class="form-control @error('price_min') is-invalid @enderror" placeholder="0">
                @error('price_min')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-6 col-md-3 col-lg-2">
                <label for="filter-price-max" class="form-label small mb-1">{{ __('messages.product.filter_price_max') }}</label>
                <input type="text" name="price_max" id="filter-price-max" min="0" step="1"
                  value="{{ old('price_max', $viewData['price_max'] ?? '') }}"
                  class="form-control @error('price_max') is-invalid @enderror" placeholder="0">
                @error('price_max')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-md-6 col-lg-2">
                <label for="filter-min-rating" class="form-label small mb-1">{{ __('messages.product.filter_min_rating') }}</label>
                <select name="min_rating" id="filter-min-rating"
                  class="form-select @error('min_rating') is-invalid @enderror">
                  <option value="">{{ __('messages.product.filter_min_rating_any') }}</option>
                  @foreach ([1, 2, 3, 4, 5] as $stars)
                    <option value="{{ $stars }}" @selected(old('min_rating', $viewData['min_rating'] ?? '') == $stars)>
                      {{ $stars }} {{ __('messages.product.rating') }}
                    </option>
                  @endforeach
                </select>
                @error('min_rating')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-lg-2 d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">{{ __('messages.product.filter_apply') }}</button>
                @if (!empty($viewData['has_active_filters']))
                  <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">{{ __('messages.product.search_clear') }}</a>
                @endif
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @if (count($viewData['products']) > 0)
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
      @foreach ($viewData['products'] as $product)
        <div class="col">
          <div class="card h-100 shadow-sm">
            @if ($product->getImage())
              <img src="{{ asset('storage/' . $product->getImage()) }}" class="card-img-top img-card"
                alt="{{ $product->getName() }}">
            @else
              <div class="card-img-top img-card bg-secondary d-flex align-items-center justify-content-center">
                <i class="bi bi-image text-white fs-1"></i>
              </div>
            @endif
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $product->getName() }}</h5>
              <p class="card-text text-muted small flex-grow-1">
                {{ Str::limit($product->getDescription(), 80) }}
              </p>
              <div class="mb-2 small">
                @if ($product->reviews_count > 0)
                  <span class="fw-semibold">
                    @for ($i = 1; $i <= 5; $i++)
                      @if ($i <= floor($product->reviews_avg_rating))
                        <i class="bi bi-star-fill star-gold"></i>
                      @elseif ($i - $product->reviews_avg_rating <= 0.5)
                        <i class="bi bi-star-half star-gold"></i>
                      @else
                        <i class="bi bi-star-fill star-gray"></i>
                      @endif
                    @endfor
                    {{ number_format($product->reviews_avg_rating, 1) }}
                  </span>
                  <span class="text-muted">
                    ({{ $product->reviews_count }} {{ __('messages.product.reviews_count') }})
                  </span>
                @else
                  <span class="text-muted">{{ __('messages.product.no_reviews') }}</span>
                @endif
              </div>
              <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="fw-bold text-danger fs-5">${{ number_format($product->getPrice(), 0, ',', '.') }}</span>
                <a href="{{ route('product.show', ['product' => $product->getId()]) }}" class="btn btn-primary btn-sm">
                  {{ __('messages.product.view_detail') }} <i class="bi bi-arrow-right ms-1"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="text-center py-5">
      <i class="bi bi-box-seam fs-1 text-secondary"></i>
      <p class="mt-3 text-muted">
        @if (!empty($viewData['has_active_filters']))
          {{ __('messages.product.filters_no_results') }}
        @else
          {{ __('messages.admin.no_products_registered') }}
        @endif
      </p>
    </div>
  @endif

@endsection
