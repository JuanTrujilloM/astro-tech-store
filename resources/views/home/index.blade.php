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
    </div>
    <div class="rounded-4 border bg-light p-5 text-center">
      <h3 class="h5 mb-2">{{ __('messages.home.carousel.empty_title') }}</h3>
      <p class="text-muted mb-0">
        {{ __('messages.home.carousel.empty_description') }}
      </p>
    </div>
  </section>

  <section class="mb-5">
    <div class="text-center mb-3">
      <h2 class="h3 mb-0">{{ __('messages.home.featured.title') }}</h2>
      <small class="text-muted">{{ __('messages.home.featured.caption') }}</small>
    </div>
    <div class="rounded-4 border bg-light p-5 text-center">
      <h3 class="h5 mb-2">{{ __('messages.home.featured.empty_title') }}</h3>
      <p class="text-muted mb-0">
        {{ __('messages.home.featured.empty_description') }}
      </p>
    </div>
  </section>

  <section class="mb-5">
    <div class="text-center mb-3">
      <h2 class="h3 mb-0">{{ __('messages.home.top_sellers.title') }}</h2>
      <small class="text-muted">{{ __('messages.home.top_sellers.caption') }}</small>
    </div>
    <div class="row g-3">
      @if ($viewData['topProducts']->sum('items_sum_quantity') > 0)
        @foreach ($viewData['topProducts'] as $index => $topProduct)
          <div class="col-12 col-md-4">
            <div class="p-4 rounded-4 border h-100 bg-light text-center">
              <div class="mb-2">
                <span
                  class="badge badge-top-{{ $index + 1 }} fs-6 px-3 py-2">{{ __('messages.home.top_sellers.top_' . ($index + 1)) }}</span>
              </div>
              @if ($topProduct->getImage())
                <img src="{{ asset('storage/' . $topProduct->getImage()) }}" class="rounded mb-2"
                  style="height: 120px; object-fit: cover;" alt="{{ $topProduct->getName() }}">
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
    <div class="row g-3">
      <div class="col-12 col-md-4">
        <div class="p-4 rounded-4 border h-100 bg-light text-center">
          <h3 class="h5 mb-2">{{ __('messages.home.reviews.placeholder_title') }}</h3>
          <p class="text-muted mb-0">
            {{ __('messages.home.reviews.placeholder_description') }}
          </p>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="p-4 rounded-4 border h-100 bg-light text-center">
          <h3 class="h5 mb-2">{{ __('messages.home.reviews.placeholder_title') }}</h3>
          <p class="text-muted mb-0">
            {{ __('messages.home.reviews.placeholder_description') }}
          </p>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="p-4 rounded-4 border h-100 bg-light text-center">
          <h3 class="h5 mb-2">{{ __('messages.home.reviews.placeholder_title') }}</h3>
          <p class="text-muted mb-0">
            {{ __('messages.home.reviews.placeholder_description') }}
          </p>
        </div>
      </div>
    </div>
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
