<!--
  Author: Juan Sebastián Lizcano Urrea
  Description: View responsible for showing the list of products in the cart
-->
@extends('layouts.app')
@section('title', __('messages.cart.title') . ' - ' . __('messages.layout.title_default'))
@section('subtitle', __('messages.cart.subtitle'))
@section('content')

  @if (session('error'))
    <div class="alert alert-danger mb-4" role="alert">
      {{ session('error') }}
    </div>
  @endif

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
                <tr>
                  <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                      @if ($product['product']->getImage())
                        <img src="{{ asset('storage/' . $product['product']->getImage()) }}"
                          alt="{{ $product['product']->getName() }}" class="cart-item-img rounded">
                      @else
                        <div class="cart-item-img-placeholder bg-secondary rounded text-white">
                          <i class="bi bi-image"></i>
                        </div>
                      @endif
                      <div>
                        <a href="{{ route('product.show', ['product' => $product['product']->getId()]) }}"
                          class="fw-semibold text-decoration-none text-dark">
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
      <div class="card-footer bg-transparent border-0 py-4 px-4">
        <div class="text-end">
          <a class="btn btn-outline-secondary mb-2">
            <b>{{ __('messages.cart.total_to_pay') }}:</b> ${{ $viewData['total'] }}
          </a>

          <a href="{{ route('cart.purchase') }}" class="btn bg-primary text-white mb-2">
            {{ __('messages.cart.purchase') }}
          </a>

          <form action="{{ route('cart.delete') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger mb-2">
              {{ __('messages.cart.remove_all_products') }}
            </button>
          </form>
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
