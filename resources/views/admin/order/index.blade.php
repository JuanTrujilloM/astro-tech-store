<!--
  Author: Andres Perez Quinchia
  Description: View responsible for managing orders from the administrator side
-->
@extends('layouts.admin')
@section('title', __('messages.admin.title'))
@section('page_title', __('messages.admin.orders'))
@section('breadcrumbs')
  {{ Breadcrumbs::render('admin.order.index') }}
@endsection
@section('content')

  <div class="admin-product-page">
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="card border-0 shadow-sm admin-product-card">
      <div class="card-header py-3 admin-product-card-header d-flex flex-column flex-sm-row flex-wrap gap-2 justify-content-between align-items-stretch align-items-sm-center">
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
                        <div class="row g-2 justify-content-center justify-content-md-center">
                          <div class="col-12 col-md-8 col-lg-6">
                            <label for="status-{{ $order->getId() }}" class="visually-hidden">{{ __('messages.orders.status') }}</label>
                            <select name="status" id="status-{{ $order->getId() }}" class="form-select form-select-sm w-100 @error('status') is-invalid @enderror">
                            <option value="pending" {{ old('status', $order->getStatus()) === 'pending' ? 'selected' : '' }}>
                              {{ __('messages.admin.status_pending') }}
                            </option>
                            <option value="completed" {{ old('status', $order->getStatus()) === 'completed' ? 'selected' : '' }}>
                              {{ __('messages.admin.status_completed') }}
                            </option>
                            <option value="cancelled" {{ old('status', $order->getStatus()) === 'cancelled' ? 'selected' : '' }}>
                              {{ __('messages.admin.status_cancelled') }}
                            </option>
                          </select>
                          @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                          </div>
                          <div class="col-12 col-md-auto d-grid d-md-inline-block">
                          <button type="submit" class="btn btn-sm admin-product-btn-primary" title="{{ __('messages.admin.update_status') }}">
                            <i class="bi bi-check-lg"></i>
                          </button>
                          </div>
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
