<!--
  Author: Andres Perez Quinchia
  Description: View responsible for showing all the products
-->
@extends('layouts.admin')
@section('title', __('messages.admin.title'))
@section('page_title', __('messages.admin.products'))
@section('breadcrumbs')
  {{ Breadcrumbs::render('admin.product.index') }}
@endsection
@section('content')

  <div class="admin-product-page">

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="card border-0 shadow-sm mb-4 admin-product-card">
      <div class="card-header py-3 admin-product-card-header">
        <h5 class="mb-0">
          <i class="bi bi-plus-circle me-2"></i>
          {{ __('messages.admin.create_product') }}
        </h5>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
          @csrf

          <div class="col-12 col-md-6">
            <label for="name" class="form-label">{{ __('messages.admin.name') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 col-md-3">
            <label for="price" class="form-label">{{ __('messages.admin.price') }} <span class="text-danger">*</span></label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" min="0" step="0.01" required>
            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 col-md-3">
            <label for="stock" class="form-label">{{ __('messages.admin.stock') }} <span class="text-danger">*</span></label>
            <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" min="0" step="1" required>
            @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <label for="description" class="form-label">{{ __('messages.admin.description') }} <span class="text-danger">*</span></label>
            <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <label for="image" class="form-label">{{ __('messages.admin.image') }} <span class="text-danger">*</span></label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <button type="submit" class="btn admin-product-btn-primary">
              <i class="bi bi-plus-circle me-1"></i>
              {{ __('messages.admin.save_product') }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="card border-0 shadow-sm admin-product-card">
      <div class="card-header py-3 admin-product-card-header d-flex flex-column flex-sm-row flex-wrap gap-2 justify-content-between align-items-stretch align-items-sm-center">
        <h5 class="mb-0">
          <i class="bi bi-box-seam me-2"></i>
          {{ __('messages.admin.product_list') }}
        </h5>
        <span class="admin-product-badge">{{ $viewData['products']->count() }} {{ __('messages.admin.items') }}</span>
      </div>
      <div class="card-body p-0">
        @if ($viewData['products']->isEmpty())
          <div class="p-4 admin-product-empty">{{ __('messages.admin.no_products_registered') }}</div>
        @else
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 admin-product-table">
              <thead>
                <tr>
                  <th>{{ __('messages.admin.id') }}</th>
                  <th>{{ __('messages.admin.name') }}</th>
                  <th>{{ __('messages.admin.description') }}</th>
                  <th>{{ __('messages.admin.price') }}</th>
                  <th>{{ __('messages.admin.stock') }}</th>
                  <th>{{ __('messages.admin.image') }}</th>
                  <th class="text-center">{{ __('messages.admin.actions') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($viewData['products'] as $product)
                  <tr>
                    <td>{{ $product->getId() }}</td>
                    <td>{{ $product->getName() }}</td>
                    <td class="admin-product-description">{{ $product->getDescription() }}</td>
                    <td class="fw-semibold">${{ number_format($product->getPrice(), 0, ',', '.') }}</td>
                    <td>{{ $product->getStock() }}</td>
                    <td>
                      @if ($product->getImage())
                        <img src="{{ $product->getImage() }}"
                          alt="Image of {{ $product->getName() }}" class="img-thumbnail admin-product-thumb">
                      @else
                        <span class="admin-product-no-image">{{ __('messages.admin.no_image') }}</span>
                      @endif
                    </td>
                    <td class="text-center">
                      <a href="{{ route('admin.product.edit', ['product' => $product->getId()]) }}"
                        class="btn btn-sm admin-product-btn-outline" title="{{ __('messages.admin.edit_action') }}"
                        aria-label="{{ __('messages.admin.edit_action') }}">
                        <i class="bi bi-pencil-square"></i>
                      </a>

                      <form id="delete-product-{{ $product->getId() }}"
                        action="{{ route('admin.product.destroy', ['product' => $product->getId()]) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm admin-product-btn-danger"
                          title="{{ __('messages.admin.delete_action') }}"
                          aria-label="{{ __('messages.admin.delete_action') }}"
                          data-confirm-delete="delete-product-{{ $product->getId() }}"
                          data-confirm-message="{{ __('messages.admin.confirm_delete_product') }}">
                          <i class="bi bi-trash"></i>
                        </button>
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
