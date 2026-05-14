<!--
  Author: Juan Esteban Trujillo Montes
  Description: View responsible for displaying the allied products in a card format.
-->

@extends('layouts.app')
@section('title', __('messages.allied.title'))
@section('content')

  @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="row mb-3">
    <div class="col-12 text-center">
      <h4 class="fw-bold mb-3">{{ __('messages.allied.heading') }}</h4>
    </div>
  </div>

  @if (!empty($viewData['products']))
    <div class="row row-cols-1 row-cols-md-3 g-4">
      @foreach ($viewData['products'] as $product)
        <div class="col">
          <div class="card h-100 shadow-sm product-card">
            @if (!empty($product['image']))
              <img src="{{ $product['image'] }}" class="card-img-top img-card" alt="{{ $product['name'] }}">
            @else
              <div class="card-img-top img-card bg-secondary d-flex align-items-center justify-content-center">
                <i class="bi bi-image text-white fs-1"></i>
              </div>
            @endif
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $product['name'] }}</h5>
              <p class="card-text text-muted small flex-grow-1">{{ $product['description'] }}</p>
              <p class="card-text fw-bold">${{ number_format($product['price'], 2) }}</p>
              @if (!empty($product['url']))
                <a href="{{ $product['url'] }}" target="_blank" class="btn btn-primary btn-sm mt-auto">
                  {{ __('messages.allied.view_detail') }}
                </a>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @elseif (!session('error'))
    <div class="col-12 text-center text-muted py-5">
      <p>{{ __('messages.allied.no_products') }}</p>
    </div>
  @endif

@endsection
