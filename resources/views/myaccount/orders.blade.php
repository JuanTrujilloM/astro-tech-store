@extends('layouts.app')
@section('title', __('messages.orders.my_orders_title'))
@section('subtitle', __('messages.orders.my_orders_subtitle'))
@section('content')
@if (session('success'))
    <div class="alert alert-success mb-4" role="alert">
        {{ session('success') }}
    </div>
@endif
@forelse ($orders as $order)
<div class="card mb-4">
    <div class="card-header">
        {{ __('messages.orders.order_prefix') }}{{ $order->id }}
    </div>
    <div class="card-body">
        <b>{{ __('messages.orders.date') }}:</b> {{ $order->created_at }}<br />
        <b>{{ __('messages.orders.total') }}:</b> ${{ $order->getTotal() }}<br />

        @if ($order->can_be_cancelled && $order->status === 'pending')
            <form action="{{ route('my-account.orders.cancel', ['order' => $order->id]) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm mt-2">
                    {{ __('messages.orders.cancelable') }}
                </button>
            </form>
        @else
            <button type="button" class="btn btn-outline-secondary btn-sm mt-2" disabled>
                {{ __('messages.orders.not_cancelable') }}
            </button>
        @endif

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
                @foreach ($order->getItems() as $item)
                <tr>
                <td>{{ $item->getId() }}</td>
                <td>
                <a class="link-success" href="{{ route('product.show', ['product' => $item->getProduct()->getId()]) }}">
                {{ $item->getProduct()->getName() }}
                </a>
                </td>
                <td>${{ $item->getPrice() }}</td>
                <td>{{ $item->getQuantity() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@empty
<div class="alert alert-danger" role="alert">
{{ __('messages.orders.empty') }}
</div>
@endforelse
@endsection