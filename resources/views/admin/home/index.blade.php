<!--
  Author: Andres Perez Quinchia
  Description: View responsible for showing the numbers of the different aspects relevant to the administrator
-->
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
        <div class="card-body text-center">
          <i class="bi bi-people-fill text-danger mb-2 fs-2"></i>
          <p class="text-muted mb-2">{{ __('messages.admin.users') }}</p>
          <h3 class="mb-0">{{ $viewData['users'] }}</h3>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body text-center">
          <i class="bi bi-box-seam text-danger mb-2 fs-2"></i>
          <p class="text-muted mb-2">{{ __('messages.admin.products') }}</p>
          <h3 class="mb-0">{{ $viewData['products'] }}</h3>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body text-center">
          <i class="bi bi-receipt-cutoff text-danger mb-2 fs-2"></i>
          <p class="text-muted mb-2">{{ __('messages.admin.orders') }}</p>
          <h3 class="mb-0">{{ $viewData['orders'] }}</h3>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body text-center">
          <i class="bi bi-star-fill text-danger mb-2 fs-2"></i>
          <p class="text-muted mb-2">{{ __('messages.admin.reviews') }}</p>
          <h3 class="mb-0">{{ $viewData['reviews'] }}</h3>
        </div>
      </div>
    </div>

    <div class="row mt-5 mb-2">
      <div class="col-12">
        <h4 class="fw-bold text-dark mb-0 text-center">{{ __('messages.admin.total_income') }}</h4>
      </div>
    </div>

    <div class="row mb-4">
      <div class="row mb-4">
        <div class="col-12">
          <div
            class="bg-white rounded-4 shadow-sm p-4 d-flex flex-column align-items-center justify-content-center border border-2 border-light text-center">
            <i class="bi bi-currency-dollar text-danger mb-3 fs-1"></i>
            <h1 class="display-4 fw-bold text-dark mb-0">
              ${{ number_format($viewData['income'], 0, ',', '.') }}
            </h1>
            <small class="text-secondary mb-3">
              {{ __('messages.admin.income_description') }}
            </small>
            <i class="bi bi-graph-up-arrow text-success opacity-75 mt-3 fs-1"></i>
          </div>
        </div>
      </div>
    </div>
    
  </div>

@endsection
