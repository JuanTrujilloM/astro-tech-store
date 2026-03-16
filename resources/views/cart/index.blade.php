@extends('layouts.app')

@section('title', __('messages.cart.title') . ' - ' . __('messages.layout.title_default'))
@section('subtitle', __('messages.cart.subtitle'))
@section('content')
  <div class="row mb-3">
    <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h4 class="fw-bold mb-0">{{ __('messages.cart.title') }}</h4>
      <a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>{{ __('messages.product.back_to_products') }}
      </a>
    </div>
  </div>

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
                @php
                  $quantity = $viewData['productsInSession'][$product->getId()] ?? 1;
                  $subtotal = $product->getPrice() * $quantity;
                @endphp
                <tr>
                  <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                      @if ($product->getImage())
                        <img src="{{ asset('storage/' . $product->getImage()) }}"
                          alt="{{ $product->getName() }}" class="rounded" width="56" height="56" style="object-fit: cover;">
                      @else
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center text-white" width="56" height="56" style="width: 56px; height: 56px;">
                          <i class="bi bi-image"></i>
                        </div>
                      @endif
                      <div>
                        <a href="{{ route('product.show', ['id' => $product->getId()]) }}" class="fw-semibold text-decoration-none text-dark">
                          {{ $product->getName() }}
                        </a>
                      </div>
                    </div>
                  </td>
                  <td>{{ $quantity }}</td>
                  <td>${{ number_format($product->getPrice(), 0, ',', '.') }}</td>
                  <td class="text-end fw-semibold pe-4">${{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer bg-transparent border-0 d-flex flex-wrap justify-content-between align-items-center gap-3 py-4 px-4">
        <form action="{{ route('cart.delete') }}" method="POST" class="mb-0">
          @csrf
          <button type="submit" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-trash3 me-1"></i>{{ __('messages.cart.remove_all') }}
          </button>
        </form>
        <div class="d-flex align-items-center gap-2">
          <span class="text-muted">{{ __('messages.cart.total') }}:</span>
          <span class="fs-4 fw-bold text-primary">${{ number_format($viewData['total'], 0, ',', '.') }}</span>
        </div>
      </div>
    </div>
  @else
    <div class="card border-0 shadow-sm">
      <div class="card-body text-center py-5">
        <i class="bi bi-cart-x fs-1 text-secondary"></i>
        <p class="mt-3 text-muted mb-4">{{ __('messages.cart.empty') }}</p>
        <a href="{{ route('product.index') }}" class="btn btn-primary">
          <i class="bi bi-bag me-1"></i>{{ __('messages.layout.nav.products') }}
        </a>
      </div>
    </div>
  @endif
@endsection
