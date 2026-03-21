<!--
  Author: Andres Perez Quinchia
  Description: View responsible for managing orders from the administrator side
-->
@extends('layouts.admin')
@section('title', __('messages.admin.title'))
@section('page_title', __('messages.admin.orders'))
@section('content')

  <div class="admin-product-page">
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="card border-0 shadow-sm admin-product-card">
      <div class="card-header py-3 admin-product-card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          <i class="bi bi-bag-check me-2"></i>
          {{ __('messages.admin.order_list') }}
        </h5>
        <span class="admin-product-badge">{{ $viewData['orders']->count() }} {{ __('messages.admin.items') }}</span>
      </div>

      <div class="card-body p-0">
        @if ($viewData['orders']->isEmpty())
          <div class="p-4 admin-product-empty">{{ __('messages.admin.no_orders_registered') }}</div>
        @else
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 admin-product-table">
              <thead>
                <tr>
                  <th>{{ __('messages.admin.id') }}</th>
                  <th>{{ __('messages.admin.user') }}</th>
                  <th>{{ __('messages.admin.total') }}</th>
                  <th>{{ __('messages.admin.date') }}</th>
                  <th>{{ __('messages.orders.status') }}</th>
                  <th class="text-center">{{ __('messages.admin.actions') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($viewData['orders'] as $order)
                  <tr>
                    <td>{{ $order->getId() }}</td>
                    <td>{{ $order->getUser()->getName() }}</td>
                    <td>${{ number_format($order->getTotal(), 0, ',', '.') }}</td>
                    <td>{{ $order->getCreatedAt() }}</td>
                    <td>{{ $order->getStatus() }}</td>
                    <td class="text-center">

                      <form action="{{ route('admin.order.updateStatus', ['order' => $order->getId()]) }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <select name="status" class="form-select form-select-sm w-auto">
                            <option value="pending" {{ $order->getStatus() === 'pending' ? 'selected' : '' }}>
                              {{ __('messages.admin.status_pending') }}
                            </option>
                            <option value="completed" {{ $order->getStatus() === 'completed' ? 'selected' : '' }}>
                              {{ __('messages.admin.status_completed') }}
                            </option>
                            <option value="cancelled" {{ $order->getStatus() === 'cancelled' ? 'selected' : '' }}>
                              {{ __('messages.admin.status_cancelled') }}
                            </option>
                          </select>
                          <button type="submit" class="btn btn-sm admin-product-btn-primary">
                            <i class="bi bi-check-lg"></i>
                          </button>
                        </div>
                      </form>

                    </td>
                  </tr>
                @endforeach
              </tbody>

            </table>
          </div>
        @endif
      </div>
    </div>
  </div>

@endsection
