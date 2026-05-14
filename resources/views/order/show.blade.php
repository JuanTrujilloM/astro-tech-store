<!--
  Author: Juan Sebastián Lizcano Urrea
  Description: View responsible for showing the details of an order made by a user
-->
@extends('layouts.app')
@section('title', __('messages.orders.order_prefix') . $viewData['order']->getId())
@section('breadcrumbs')
  {{ Breadcrumbs::render('order.show', $viewData['order']) }}
@endsection
@section('content')

  <div class="card mb-4">
    <div class="card-header">
      {{ __('messages.orders.order_prefix') }}{{ $viewData['order']->getId() }}
    </div>
    <div class="card-body">
      <b>{{ __('messages.orders.date') }}:</b> {{ $viewData['order']->getCreatedAt() }}<br />
      <b>{{ __('messages.orders.total') }}:</b> ${{ number_format($viewData['order']->getTotal(), 0, ',', '.') }}<br />
      <b>{{ __('messages.orders.status') }}:</b> {{ $viewData['order']->getStatus() }}<br />
      <hr>
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center mt-3 mb-0 align-middle">
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
                <td class="text-break">
                  <a class="link-success" href="{{ route('product.show', ['product' => $item->getProductId()]) }}">
                    {{ $item->getProduct()->getName() }}
                  </a>
                </td>
                <td>${{ number_format($item->getPrice(), 0, ',', '.') }}</td>
                <td>{{ $item->getQuantity() }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="row g-2 mt-3 align-items-stretch">
        <div class="col-12 col-md-auto">
          <a href="{{ route('order.index') }}" class="btn btn-secondary w-100">
            <i class="bi bi-arrow-left me-1"></i>{{ __('messages.orders.back_to_orders') }}
          </a>
        </div>

        @if ($viewData['order']->getCanBeCancelled() && $viewData['order']->getStatus() === 'pending')
          <div class="col-12 col-md-auto ms-md-auto">
            <form action="{{ route('order.cancel', ['order' => $viewData['order']->getId()]) }}" method="POST" class="h-100">
              @csrf
              <button type="submit" class="btn btn-secondary w-100 h-100">
                {{ __('messages.orders.cancel_order') }}
              </button>
            </form>
          </div>
        @endif
      </div>
    </div>
  </div>

@endsection
