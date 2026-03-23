<!--
  Author: Juan Sebastián Lizcano Urrea
  Description: View responsible for showing the list of orders made by a user
-->
@extends('layouts.app')
@section('title', __('messages.orders.my_orders_title'))
@section('content')

  @if (session('success'))
    <div class="alert alert-success mb-4" role="alert">
      {{ session('success') }}
    </div>
  @endif

  <h3 class="fw-bold text-center mb-4">{{ __('messages.layout.nav.orders') }}</h3>

  @forelse ($viewData['orders'] as $order)
    @if ($loop->first)
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @endif
      <div class="col">
        <div class="card h-100 shadow-sm">
          <div class="card-header">
            {{ __('messages.orders.order_prefix') }}{{ $order->getId() }}
          </div>
          <div class="card-body">
            <b>{{ __('messages.orders.date') }}:</b> {{ $order->getCreatedAt() }}<br />
            <b>{{ __('messages.orders.total') }}:</b> ${{ number_format($order->getTotal(), 0, ',', '.') }}<br />
            <b>{{ __('messages.orders.status') }}:</b> {{ $order->getStatus() }}<br />
            <div class="mt-3">
              <a href="{{ route('order.show', ['order' => $order->getId()]) }}" class="btn btn-primary btn-sm">
                {{ __('messages.orders.view_details') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    @if ($loop->last)
      </div>
    @endif
  @empty
    <div class="d-flex justify-content-center align-items-center flex-grow-1">
      <div class="text-center">
        <i class="bi bi-bag-x empty-state-icon"></i>
        <h4 class="mt-3">{{ __('messages.orders.empty') }}</h4>
        <p class="text-muted">{{ __('messages.orders.empty_subtitle') }}</p>
        <a href="{{ route('product.index') }}" class="btn btn-primary mt-2">
          <i class="bi bi-shop me-1"></i>{{ __('messages.orders.browse_products') }}
        </a>
      </div>
    </div>
  @endforelse

@endsection
