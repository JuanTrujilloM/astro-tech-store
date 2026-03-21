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

  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @forelse ($viewData['orders'] as $order)
      <div class="col">
        <div class="card h-100 shadow-sm">
          <div class="card-header">
            {{ __('messages.orders.order_prefix') }}{{ $order->getId() }}
          </div>
          <div class="card-body">
            <b>{{ __('messages.orders.date') }}:</b> {{ $order->getCreatedAt() }}<br />
            <b>{{ __('messages.orders.total') }}:</b> ${{ $order->getTotal() }}<br />
            <b>{{ __('messages.orders.status') }}:</b> {{ $order->getStatus() }}<br />
            <div class="mt-3">
              <a href="{{ route('order.show', ['order' => $order->getId()]) }}" class="btn btn-primary btn-sm">
                {{ __('messages.orders.view_details') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-danger" role="alert">
          {{ __('messages.orders.empty') }}
        </div>
      </div>
    @endforelse
  </div>

@endsection
