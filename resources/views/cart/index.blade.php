<!--
  Author: Juan Sebastián Lizcano Urrea
  Description: View responsible for showing the list of products in the cart
-->
@extends('layouts.app')
@section('title', __('messages.cart.title') . ' - ' . __('messages.layout.title_default'))
@section('breadcrumbs')
  {{ Breadcrumbs::render('cart.index') }}
@endsection
@section('content')

  @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <h3 class="fw-bold text-center mb-4">{{ __('messages.cart.title') }}</h3>

  @if (count($viewData['products']) > 0)
    <div class="card border-0 shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th class="border-0 ps-4">{{ __('messages.admin.name') }}</th>
                <th class="border-0">{{ __('messages.product.quantity') }}</th>
                <th class="border-0">{{ __('messages.admin.price') }}</th>
                <th class="border-0 text-end pe-4">{{ __('messages.cart.subtotal') }}</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($viewData['products'] as $product)
                <tr>
                  <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                      @if ($product['product']->getImage())
                        <img src="{{ $product['product']->getImage() }}"
                          alt="{{ $product['product']->getName() }}" class="cart-item-img rounded">
                      @else
                        <div class="cart-item-img-placeholder bg-secondary rounded text-white">
                          <i class="bi bi-image"></i>
                        </div>
                      @endif
                      <div class="min-w-0">
                        <a href="{{ route('product.show', ['product' => $product['product']->getId()]) }}"
                          class="fw-semibold text-decoration-none text-dark text-break d-inline-block">
                          {{ $product['product']->getName() }}
                        </a>
                      </div>
                    </div>
                  </td>
                  <td>{{ $product['quantity'] }}</td>
                  <td>${{ number_format($product['product']->getPrice(), 0, ',', '.') }}</td>
                  <td class="text-end fw-semibold pe-4">${{ number_format($product['subtotal'], 0, ',', '.') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
      <div class="card-footer bg-transparent border-0 py-4 px-3 px-md-4">
        <div class="row align-items-end gy-3">
          <div class="col-12 col-md-5">

            @if ($viewData['discount'])
              <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2">
                <span class="badge bg-success fs-6 px-3 py-2 text-wrap text-center">
                  <i class="bi bi-tag-fill me-1"></i>{{ $viewData['discount']['code'] }}
                  (-{{ $viewData['discount']['percentage'] }}%)
                </span>
                <form action="{{ route('cart.removeDiscount') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-outline-danger align-self-sm-center">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </form>
              </div>
            @else
              <form action="{{ route('cart.applyDiscount') }}" method="POST">
                @csrf
                <label for="discount_code" class="form-label mb-1 small">{{ __('messages.cart.discount_placeholder') }}</label>
                <div class="d-flex flex-column flex-sm-row gap-2">
                  <input type="text" name="discount_code" id="discount_code"
                    class="form-control form-control-sm flex-grow-1 min-w-0 @error('discount_code') is-invalid @enderror"
                    placeholder="{{ __('messages.cart.discount_placeholder') }}" required>
                  <button type="submit" class="btn btn-sm btn-outline-primary text-nowrap flex-shrink-0">
                    {{ __('messages.cart.discount_apply') }}
                  </button>
                </div>
                @error('discount_code')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </form>
            @endif
            
          </div>
          <div class="col-12 col-md-7 text-center text-md-end">
            <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 justify-content-center justify-content-md-end align-items-stretch align-items-sm-center">
            @if ($viewData['discount'])
              <div class="d-inline-flex flex-column flex-sm-row align-items-center gap-2 mb-0 mb-sm-2 px-3 py-2 rounded-3 bg-light text-center text-sm-start">
                <span class="text-muted">
                  {{ __('messages.cart.subtotal') }}: <s>${{ number_format($viewData['total'], 0, ',', '.') }}</s>
                </span>
                <span class="text-success fw-semibold">
                  <i
                    class="bi bi-arrow-down-circle me-1"></i>-${{ number_format($viewData['discountAmount'], 0, ',', '.') }}
                </span>
              </div>
            @endif

            <span class="d-inline-block border rounded px-3 py-2 text-center">
              <b>{{ __('messages.cart.total_to_pay') }}:</b>
              ${{ number_format($viewData['totalWithDiscount'], 0, ',', '.') }}
            </span>

            <form action="{{ route('cart.purchase') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn bg-primary text-white">
                {{ __('messages.cart.purchase') }}
              </button>
            </form>

            <form action="{{ route('cart.delete') }}" method="POST" class="d-inline" id="delete-cart-form">
              @csrf
              <button type="button" class="btn btn-danger"
                data-confirm-delete="delete-cart-form"
                data-confirm-message="{{ __('messages.cart.confirm_delete_all') }}">
                {{ __('messages.cart.remove_all_products') }}
              </button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  @else
    <div class="d-flex justify-content-center align-items-center flex-grow-1">
      <div class="text-center">
        <i class="bi bi-cart-x empty-state-icon"></i>
        <h4 class="mt-3">{{ __('messages.cart.empty') }}</h4>
        <p class="text-muted">{{ __('messages.cart.empty_subtitle') }}</p>
        <a href="{{ route('product.index') }}" class="btn btn-primary mt-2">
          <i class="bi bi-shop me-1"></i>{{ __('messages.cart.browse_products') }}
        </a>
      </div>
    </div>
  @endif

@endsection
