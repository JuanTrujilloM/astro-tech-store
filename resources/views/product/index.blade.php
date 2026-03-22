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

  @if ($viewData['topProducts']->sum('items_sum_quantity') > 0)
    <section class="mb-4">
      <div class="text-center mb-3">
        <h2 class="h3 mb-0">{{ __('messages.product.most_purchased_title') }}</h2>
      </div>
      <div class="row g-3 justify-content-center">
        @foreach ($viewData['topProducts'] as $index => $topProduct)
          @if ($topProduct->items_sum_quantity > 0)
            <div class="col-12 col-md-3">
              <div class="card h-100 shadow-sm text-center">
                @if ($topProduct->getImage())
                  <img src="{{ asset('storage/' . $topProduct->getImage()) }}" class="card-img-top img-card"
                    alt="{{ $topProduct->getName() }}">
                @else
                  <div class="card-img-top img-card bg-secondary d-flex align-items-center justify-content-center">
                    <i class="bi bi-image text-white fs-1"></i>
                  </div>
                @endif
                <div class="card-body d-flex flex-column">
                  <span class="badge badge-top-{{ $index + 1 }} mb-2 align-self-center">
                    {{ __('messages.home.top_sellers.top_' . ($index + 1)) }}
                  </span>
                  <h5 class="card-title">{{ $topProduct->getName() }}</h5>
                  <p class="text-muted small">{{ $topProduct->items_sum_quantity }}
                    {{ __('messages.product.total_sold') }}</p>
                  <div class="mb-2 small">
                    @if ($topProduct->reviews_count > 0)
                      <span class="fw-semibold">
                        @for ($i = 1; $i <= 5; $i++)
                          @if ($i <= floor($topProduct->reviews_avg_rating))
                            <i class="bi bi-star-fill star-gold"></i>
                          @elseif ($i - $topProduct->reviews_avg_rating <= 0.5)
                            <i class="bi bi-star-half star-gold"></i>
                          @else
                            <i class="bi bi-star-fill star-gray"></i>
                          @endif
                        @endfor
                        {{ number_format($topProduct->reviews_avg_rating, 1) }}
                      </span>
                      <span class="text-muted">
                        ({{ $topProduct->reviews_count }} {{ __('messages.product.reviews_count') }})
                      </span>
                    @else
                      <span class="text-muted">{{ __('messages.product.no_reviews') }}</span>
                    @endif
                  </div>
                  <div class="mt-auto">
                    <span
                      class="fw-bold text-danger fs-5 d-block mb-2">${{ number_format($topProduct->getPrice(), 0, ',', '.') }}</span>
                    <a href="{{ route('product.show', ['product' => $topProduct->getId()]) }}"
                      class="btn btn-primary btn-sm">
                      {{ __('messages.product.view_detail') }} <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </section>
  @endif

  <div class="text-center mb-3">
    <h4 class="fw-bold">{{ __('messages.admin.product_list') }}</h4>
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
              <div class="d-flex justify-content-between align-items-start mb-2">
                <h5 class="card-title mb-0">{{ $product->getName() }}</h5>

                @if (in_array($product->getId(), session('favorites', [])))
                  <form action="{{ route('favorite.remove', ['product' => $product->getId()]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 border-0 shadow-none">
                      <i class="bi bi-heart-fill text-danger fs-5"></i>
                    </button>
                  </form>
                @else
                  <form action="{{ route('favorite.add', ['product' => $product->getId()]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 border-0 shadow-none">
                      <i class="bi bi-heart text-secondary fs-5"></i>
                    </button>
                  </form>
                @endif
              </div>

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
      <p class="mt-3 text-muted">{{ __('messages.admin.no_products_registered') }}</p>
    </div>
  @endif

@endsection
