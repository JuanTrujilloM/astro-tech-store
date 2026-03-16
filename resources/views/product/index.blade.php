<!--
  Author: Juan Esteban Trujillo Montes
  Description: View responsible for showing the list of products available in the store
-->

@extends('layouts.app')

@section('title', __('messages.layout.nav.products') . ' - ' . __('messages.layout.title_default'))

@section('content')
  <div class="row mb-3">
    <div class="col">
      <h4 class="fw-bold">{{ __('messages.admin.product_list') }}</h4>
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
                <a href="{{ route('product.show', ['id' => $product->getId()]) }}" class="btn btn-primary btn-sm">
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
      <p class="mt-3 text-muted">{{ __('messages.admin.no_products_registered') }}</p>
    </div>
  @endif
@endsection
