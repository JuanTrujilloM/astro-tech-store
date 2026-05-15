<!--
  Author: Andres Perez Quinchia
  Description: View responsible for managing products
-->
@extends('layouts.admin')
@section('title', __('messages.admin.title'))
@section('page_title', __('messages.admin.products'))
@section('breadcrumbs')
  {{ Breadcrumbs::render('admin.product.edit', $viewData['product']) }}
@endsection
@section('content')

  <div class="admin-product-page">
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

    <div class="card border-0 shadow-sm admin-product-card">
      <div class="card-header py-3 d-flex flex-column flex-sm-row flex-wrap gap-2 justify-content-between align-items-stretch align-items-sm-center admin-product-card-header">
        <h5 class="mb-0">{{ __('messages.admin.edit_product') }}</h5>
        <a href="{{ route('admin.product.index') }}" class="btn btn-sm admin-product-btn-outline">
          <i class="bi bi-arrow-left me-1"></i>
          {{ __('messages.admin.back') }}
        </a>
      </div>

      <div class="card-body">
        <form action="{{ route('admin.product.update', ['product' => $viewData['product']->getId()]) }}" method="POST"
          enctype="multipart/form-data" class="row g-3">
          @csrf
          @method('PUT')

          <div class="col-12 col-md-6">
            <label for="name" class="form-label">{{ __('messages.admin.name') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name', $viewData['product']->getName()) }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 col-md-3">
            <label for="price" class="form-label">{{ __('messages.admin.price') }} <span class="text-danger">*</span></label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
              value="{{ old('price', $viewData['product']->getPrice()) }}" min="0" step="0.01" required>
            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 col-md-3">
            <label for="stock" class="form-label">{{ __('messages.admin.stock') }} <span class="text-danger">*</span></label>
            <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror"
              value="{{ old('stock', $viewData['product']->getStock()) }}" min="0" step="1" required>
            @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <label for="description" class="form-label">{{ __('messages.admin.description') }} <span class="text-danger">*</span></label>
            <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $viewData['product']->getDescription()) }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <label for="image" class="form-label">{{ __('messages.admin.new_image_optional') }}</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            @if ($viewData['product']->getImage())
              <div class="mt-2">
                <small class="admin-product-no-image d-block">{{ __('messages.admin.current_image') }}</small>
                <img src="{{ $viewData['product']->getImage() }}" alt="Actual Image Of {{ $viewData['product']->getName() }}"
                  class="img-thumbnail mt-1 admin-product-preview">
              </div>
            @endif
          </div>

          <div class="col-12">
            <button type="submit" class="btn admin-product-btn-primary">
              <i class="bi bi-save me-1"></i>
              {{ __('messages.admin.update_product') }}
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>

@endsection
