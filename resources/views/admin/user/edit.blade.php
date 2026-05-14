<!--
  Author: Juan Esteban Trujillo Montes
  Description: View responsible for managing users in the admin panel, allowing administrators to view, create, edit, and delete users.
-->

@extends('layouts.admin')
@section('title', __('messages.admin.title'))
@section('page_title', __('messages.admin.users'))
@section('breadcrumbs')
  {{ Breadcrumbs::render('admin.user.edit', $viewData['user']) }}
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
        <h5 class="mb-0">{{ __('messages.admin.edit_user') }}</h5>
        <a href="{{ route('admin.user.index') }}" class="btn btn-sm admin-product-btn-outline">
          <i class="bi bi-arrow-left me-1"></i>
          {{ __('messages.admin.back') }}
        </a>
      </div>

      <div class="card-body">
        <form action="{{ route('admin.user.update', ['user' => $viewData['user']->getId()]) }}" method="POST"
          class="row g-3">
          @csrf
          @method('PUT')

          <div class="col-12 col-md-6">
            <label for="name" class="form-label">{{ __('messages.admin.name') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name', $viewData['user']->getName()) }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 col-md-6">
            <label for="email" class="form-label">{{ __('messages.admin.email') }} <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
              value="{{ old('email', $viewData['user']->getEmail()) }}" autocomplete="email" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 col-md-6">
            <label for="password" class="form-label">{{ __('messages.admin.password_optional') }}</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            <small class="text-muted">{{ __('messages.admin.leave_blank_to_keep') }}</small>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 col-md-3">
            <label for="balance" class="form-label">{{ __('messages.admin.balance') }}</label>
            <input type="number" name="balance" id="balance" class="form-control @error('balance') is-invalid @enderror"
              value="{{ old('balance', $viewData['user']->getBalance()) }}" min="0" step="0.01">
            @error('balance')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 col-md-3">
            <label for="role" class="form-label">{{ __('messages.admin.role') }} <span class="text-danger">*</span></label>
            <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
              <option value="client" {{ old('role', $viewData['user']->getRole()) == 'client' ? 'selected' : '' }}>
                {{ __('messages.admin.client') }}</option>
              <option value="admin" {{ old('role', $viewData['user']->getRole()) == 'admin' ? 'selected' : '' }}>
                {{ __('messages.admin.admin') }}</option>
            </select>
            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <button type="submit" class="btn admin-product-btn-primary">
              <i class="bi bi-save me-1"></i>
              {{ __('messages.admin.update_user') }}
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>

@endsection
