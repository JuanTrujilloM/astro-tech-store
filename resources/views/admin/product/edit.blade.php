<!--
  Author: Andres Perez Quinchia
  Description: View responsible for managing products
-->
@extends('layouts.admin')
@section('title', __('messages.admin.title'))
@section('page_title', __('messages.admin.products'))
@section('content')

  <div class="admin-product-page">
    @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card border-0 shadow-sm admin-product-card">
      <div class="card-header py-3 d-flex justify-content-between align-items-center admin-product-card-header">
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
            <label for="name" class="form-label">{{ __('messages.admin.name') }}</label>
            <input type="text" name="name" id="name" class="form-control"
              value="{{ old('name', $viewData['product']->getName()) }}" required>
          </div>

          <div class="col-12 col-md-3">
            <label for="price" class="form-label">{{ __('messages.admin.price') }}</label>
            <input type="number" name="price" id="price" class="form-control"
              value="{{ old('price', $viewData['product']->getPrice()) }}" required>
          </div>

          <div class="col-12 col-md-3">
            <label for="stock" class="form-label">{{ __('messages.admin.stock') }}</label>
            <input type="number" name="stock" id="stock" class="form-control"
              value="{{ old('stock', $viewData['product']->getStock()) }}" required>
          </div>

          <div class="col-12">
            <label for="description" class="form-label">{{ __('messages.admin.description') }}</label>
            <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $viewData['product']->getDescription()) }}</textarea>
          </div>

          <div class="col-12">
            <label for="image" class="form-label">{{ __('messages.admin.new_image_optional') }}</label>
            <input type="file" name="image" id="image" class="form-control">
            @if ($viewData['product']->getImage())
              <div class="mt-2">
                <small class="admin-product-no-image d-block">{{ __('messages.admin.current_image') }}</small>
                <img src="{{ asset('storage/' . $viewData['product']->getImage()) }}" alt="Imagen actual del producto"
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
