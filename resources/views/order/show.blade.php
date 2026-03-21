<!--
  Author: Juan Sebastián Lizcano Urrea
  Description: View responsible for showing the details of an order made by a user
-->
@extends('layouts.app')
@section('title', __('messages.orders.order_prefix') . $viewData['order']->getId())
@section('content')

  <div class="card mb-4">
    <div class="card-header">
      {{ __('messages.orders.order_prefix') }}{{ $viewData['order']->getId() }}
    </div>
    <div class="card-body">
      <b>{{ __('messages.orders.date') }}:</b> {{ $viewData['order']->getCreatedAt() }}<br />
      <b>{{ __('messages.orders.total') }}:</b> ${{ $viewData['order']->getTotal() }}<br />
      <b>{{ __('messages.orders.status') }}:</b> {{ $viewData['order']->getStatus() }}<br />
      <hr>
      <table class="table table-bordered table-striped text-center mt-3">
        <thead>
          <tr>
            <th scope="col">{{ __('messages.orders.item_id') }}</th>
            <th scope="col">{{ __('messages.orders.product_name') }}</th>
            <th scope="col">{{ __('messages.admin.price') }}</th>
            <th scope="col">{{ __('messages.product.quantity') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($viewData['order']->getItems() as $item)
            <tr>
              <td>{{ $item->getId() }}</td>
              <td>
                <a class="link-success" href="{{ route('product.show', ['product' => $item->getProductId()]) }}">
                  {{ $item->getProduct()->getName() }}
                </a>
              </td>
              <td>${{ $item->getPrice() }}</td>
              <td>{{ $item->getQuantity() }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <a href="{{ route('order.index') }}" class="btn btn-secondary">
          <i class="bi bi-arrow-left me-1"></i>{{ __('messages.orders.back_to_orders') }}
        </a>

        @if ($viewData['order']->getCanBeCancelled() && $viewData['order']->getStatus() === 'pending')
          <form action="{{ route('order.cancel', ['order' => $viewData['order']->getId()]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary">
              {{ __('messages.orders.cancel_order') }}
            </button>
          </form>
        @endif
      </div>
    </div>
  </div>

@endsection
