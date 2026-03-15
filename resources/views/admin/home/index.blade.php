@extends('layouts.admin')
@section('title', __('messages.admin.title'))
@section('page_title', __('messages.admin.dashboard'))

@section('content')

  <div class="row mb-4">
    <div class="col-12 col-lg-8 mx-auto">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4 text-center">
          <h5 class="mb-2">{{ __('messages.admin.welcome_title') }}</h5>
          <p class="text-muted mb-0">
            {{ __('messages.admin.welcome_description') }}
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-12 col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <p class="text-muted mb-2">{{ __('messages.admin.products') }}</p>
          <h3 class="mb-0">0</h3>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <p class="text-muted mb-2">{{ __('messages.admin.orders') }}</p>
          <h3 class="mb-0">0</h3>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <p class="text-muted mb-2">{{ __('messages.admin.users') }}</p>
          <h3 class="mb-0">0</h3>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <p class="text-muted mb-2">{{ __('messages.admin.reviews') }}</p>
          <h3 class="mb-0">0</h3>
        </div>
      </div>
    </div>
  </div>

@endsection
