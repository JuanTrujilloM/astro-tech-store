<!--
  Author: Juan Esteban Trujillo Montes
  Description: View responsible for displaying the home page, showcasing featured products, top sellers, and recent reviews in a visually appealing and user-friendly manner, while also providing links to the "About Us" and "Contact Us" pages for more information about the company.
-->

@extends('layouts.app')
@section('title', __('messages.home.title'))
@section('content')

  <section class="mb-5">
    <div class="p-5 rounded-4 bg-light border text-center">
      <h1 class="display-6 fw-bold mb-3">{{ __('messages.home.welcome_title') }}</h1>
      <p class="lead mb-0 mx-auto max-width-900">
        {{ __('messages.home.welcome_description') }}
      </p>
    </div>
  </section>

  <section class="mb-5">
    <div class="text-center mb-3">
      <h2 class="h3 mb-0">{{ __('messages.home.carousel.title') }}</h2>
      <small class="text-muted">{{ __('messages.home.carousel.caption') }}</small>
    </div>
    @if ($viewData['homeProducts']->count() > 0)
      <div id="homeCarousel" class="carousel slide rounded-4 border overflow-hidden" data-bs-ride="carousel">
        <div class="carousel-inner py-5 px-3 px-md-5">
          @foreach ($viewData['homeProducts']->chunk(3) as $chunkIndex => $chunk)
            <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
              <div class="d-flex carousel-cards-row">
                @foreach ($chunk->values() as $cardIndex => $product)
                  <div
                    class="carousel-product-card {{ $cardIndex === 1 ? 'carousel-card-center' : 'carousel-card-side' }}">
                    <div class="card border rounded-4 text-center p-3 h-100">
                      @if ($product->getImage())
                        <img src="{{ asset('storage/' . $product->getImage()) }}" alt="{{ $product->getName() }}"
                          class="carousel-product-img mx-auto mt-2">
                      @else
                        <div
                          class="carousel-product-no-img mx-auto mt-2 rounded-3 d-flex align-items-center justify-content-center">
                          <i class="bi bi-image text-muted icon-placeholder-lg"></i>
                        </div>
                      @endif
                      <div class="card-body px-2 pb-2">
                        <h5 class="card-title fw-semibold mb-1">{{ $product->getName() }}</h5>
                        <p class="text-muted fw-bold mb-2">${{ number_format($product->getPrice(), 0, ',', '.') }}</p>
                        <a href="{{ route('product.show', ['product' => $product->getId()]) }}"
                          class="btn btn-primary btn-sm rounded-pill px-4">
                          {{ __('messages.product.view_detail') }}
                        </a>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
        </button>
        <div class="carousel-indicators position-relative mt-2 mb-2">
          @foreach ($viewData['homeProducts']->chunk(3) as $chunkIndex => $chunk)
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="{{ $chunkIndex }}"
              class="{{ $chunkIndex === 0 ? 'active' : '' }} carousel-indicator-dark"></button>
          @endforeach
        </div>
      </div>
    @else
      <div class="rounded-4 border bg-light p-5 text-center">
        <h3 class="h5 mb-2">{{ __('messages.home.carousel.empty_title') }}</h3>
        <p class="text-muted mb-0">
          {{ __('messages.home.carousel.empty_description') }}
        </p>
      </div>
    @endif
  </section>

  <section class="mb-5">
    <div class="text-center mb-3">
      <h2 class="h3 mb-0">{{ __('messages.home.top_sellers.title') }}</h2>
      <small class="text-muted">{{ __('messages.home.top_sellers.caption') }}</small>
    </div>
    <div class="row g-3">
      @if ($viewData['topHomeProducts']->sum('items_sum_quantity') > 0)
        @foreach ($viewData['topHomeProducts'] as $index => $topProduct)
          <div class="col-12 col-md-4">
            <div class="p-4 rounded-4 border h-100 bg-light text-center">
              <div class="mb-2">
                <span
                  class="badge badge-top-{{ $index + 1 }} fs-6 px-3 py-2">{{ __('messages.home.top_sellers.top_' . ($index + 1)) }}</span>
              </div>
              @if ($topProduct->getImage())
                <img src="{{ asset('storage/' . $topProduct->getImage()) }}" class="rounded mb-2 top-product-img"
                  alt="{{ $topProduct->getName() }}">
              @endif
              <h3 class="h5 mb-2">{{ $topProduct->getName() }}</h3>
              <p class="text-muted mb-2">${{ number_format($topProduct->getPrice(), 0, ',', '.') }}</p>
              <a href="{{ route('product.show', ['product' => $topProduct->getId()]) }}" class="btn btn-primary btn-sm">
                {{ __('messages.product.view_detail') }}
              </a>
            </div>
          </div>
        @endforeach
      @else
        <div class="col-12 col-md-4">
          <div class="p-4 rounded-4 border h-100 bg-light text-center">
            <div class="mb-2">
              <span class="badge badge-top-1 fs-6 px-3 py-2">{{ __('messages.home.top_sellers.top_1') }}</span>
            </div>
            <h3 class="h5 mb-2">{{ __('messages.home.top_sellers.placeholder_title') }}</h3>
            <p class="text-muted mb-0">{{ __('messages.home.top_sellers.first_description') }}</p>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="p-4 rounded-4 border h-100 bg-light text-center">
            <div class="mb-2">
              <span class="badge badge-top-2 fs-6 px-3 py-2">{{ __('messages.home.top_sellers.top_2') }}</span>
            </div>
            <h3 class="h5 mb-2">{{ __('messages.home.top_sellers.placeholder_title') }}</h3>
            <p class="text-muted mb-0">{{ __('messages.home.top_sellers.second_description') }}</p>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="p-4 rounded-4 border h-100 bg-light text-center">
            <div class="mb-2">
              <span class="badge badge-top-3 fs-6 px-3 py-2">{{ __('messages.home.top_sellers.top_3') }}</span>
            </div>
            <h3 class="h5 mb-2">{{ __('messages.home.top_sellers.placeholder_title') }}</h3>
            <p class="text-muted mb-0">{{ __('messages.home.top_sellers.third_description') }}</p>
          </div>
        </div>
      @endif
    </div>
  </section>

  <section class="mb-5">
    <div class="text-center mb-3">
      <h2 class="h3 mb-0">{{ __('messages.home.reviews.title') }}</h2>
      <small class="text-muted">{{ __('messages.home.reviews.caption') }}</small>
    </div>
    @if ($viewData['homeReviews']->count() > 0)
      <div class="row g-3">
        @foreach ($viewData['homeReviews'] as $review)
          <div class="col-12 col-md-6 col-lg-4">
            <div class="p-4 rounded-4 border h-100 bg-white d-flex flex-column">
              <div class="d-flex align-items-center mb-3">
                <div
                  class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center flex-shrink-0 review-avatar">
                  {{ strtoupper(mb_substr($review->getUser()->getName(), 0, 1)) }}
                </div>
                <div class="ms-3">
                  <h6 class="mb-0 fw-semibold">{{ $review->getUser()->getName() }}</h6>
                  <small class="text-muted">{{ $review->getCreatedAtDiff() }}</small>
                </div>
              </div>
              <div class="mb-2">
                @for ($i = 1; $i <= 5; $i++)
                  @if ($i <= $review->getRating())
                    <i class="bi bi-star-fill star-gold"></i>
                  @else
                    <i class="bi bi-star-fill star-gray"></i>
                  @endif
                @endfor
              </div>
              <p class="text-muted mb-3 flex-grow-1">
                {{ Str::limit($review->getDescription(), 120) }}
              </p>
              <div class="mt-auto">
                <a href="{{ route('product.show', ['product' => $review->getProductId()]) }}"
                  class="text-decoration-none text-primary fw-medium link-sm">
                  {{ $review->getProduct()->getName() }} <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="rounded-4 border bg-light p-5 text-center">
        <h3 class="h5 mb-2">{{ __('messages.home.reviews.empty_title') }}</h3>
        <p class="text-muted mb-0">{{ __('messages.home.reviews.empty_description') }}</p>
      </div>
    @endif
  </section>

  <section class="mb-4">
    <div class="row g-3">
      <div class="col-12 col-lg-6">
        <div class="p-4 rounded-4 border h-100 bg-white text-center">
          <h3 class="h4">{{ __('messages.home.about.title') }}</h3>
          <p class="mb-3 text-muted">
            {{ __('messages.home.about.description') }}
          </p>
          <a href="{{ route('home.about') }}" class="btn btn-primary">{{ __('messages.home.about.button') }}</a>
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <div class="p-4 rounded-4 border h-100 bg-white text-center">
          <h3 class="h4">{{ __('messages.home.contact.title') }}</h3>
          <p class="mb-3 text-muted">
            {{ __('messages.home.contact.description') }}
          </p>
          <a href="{{ route('home.contact') }}" class="btn btn-primary">{{ __('messages.home.contact.button') }}</a>
        </div>
      </div>
    </div>
  </section>

@endsection
