<!--
  Author: Juan Esteban Trujillo Montes
  Description: View responsible for showing the form to edit a review made by a user on a product
-->
@extends('layouts.app')
@section('title', __('messages.product.edit_review') . ' - ' . __('messages.layout.title_default'))
@section('content')

  <div class="row mb-3">
    <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h4 class="fw-bold mb-0">{{ __('messages.product.edit_review') }}</h4>
      <a href="{{ route('product.show', ['product' => $viewData['review']->getProductId()]) }}"
        class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>{{ __('messages.product.back_to_products') }}
      </a>
    </div>
  </div>

  <div class="card border-0 shadow-sm mt-2">
    <div class="card-body p-4">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
          <form
            action="{{ route('review.update', ['product' => $viewData['review']->getProductId(), 'review' => $viewData['review']->getId()]) }}"
            method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="rating" class="form-label">{{ __('messages.product.review_rating') }}</label>
              <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror">
                <option value="">--</option>
                @for ($i = 1; $i <= 5; $i++)
                  <option value="{{ $i }}"
                    {{ old('rating', $viewData['review']->getRating()) == $i ? 'selected' : '' }}>
                    {{ $i }}
                  </option>
                @endfor
              </select>
              @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">{{ __('messages.product.review_description') }}</label>
              <textarea name="description" id="description" rows="3"
                class="form-control @error('description') is-invalid @enderror">{{ old('description', $viewData['review']->getDescription()) }}</textarea>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-danger">{{ __('messages.product.update_review') }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
