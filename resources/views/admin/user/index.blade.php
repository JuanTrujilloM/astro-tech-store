<!--
  Author: Juan Esteban Trujillo Montes
  Description: View responsible for managing users in the admin panel, allowing administrators to view, create, edit, and delete users.
-->

@extends('layouts.admin')
@section('title', __('messages.admin.title'))
@section('page_title', __('messages.admin.users'))
@section('content')

  <div class="admin-product-page">

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger mb-4" role="alert">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card border-0 shadow-sm mb-4 admin-product-card">
      <div class="card-header py-3 admin-product-card-header">
        <h5 class="mb-0">
          <i class="bi bi-person-plus me-2"></i>
          {{ __('messages.admin.create_user') }}
        </h5>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.user.store') }}" method="POST" class="row g-3">
          @csrf

          <div class="col-12 col-md-6">
            <label for="name" class="form-label">{{ __('messages.admin.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
          </div>

          <div class="col-12 col-md-6">
            <label for="email" class="form-label">{{ __('messages.admin.email') }}</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
          </div>

          <div class="col-12 col-md-6">
            <label for="password" class="form-label">{{ __('messages.admin.password') }}</label>
            <input type="password" name="password" id="password" class="form-control" required>
          </div>

          <div class="col-12 col-md-3">
            <label for="balance" class="form-label">{{ __('messages.admin.balance') }}</label>
            <input type="number" name="balance" id="balance" class="form-control" value="{{ old('balance', 0) }}">
          </div>

          <div class="col-12 col-md-3">
            <label for="role" class="form-label">{{ __('messages.admin.role') }}</label>
            <select name="role" id="role" class="form-select" required>
              <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>{{ __('messages.admin.client') }}
              </option>
              <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>{{ __('messages.admin.admin') }}
              </option>
            </select>
          </div>

          <div class="col-12">
            <button type="submit" class="btn admin-product-btn-primary">
              <i class="bi bi-person-plus me-1"></i>
              {{ __('messages.admin.save_user') }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="card border-0 shadow-sm admin-product-card">
      <div class="card-header py-3 admin-product-card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          <i class="bi bi-people me-2"></i>
          {{ __('messages.admin.user_list') }}
        </h5>
        <span class="admin-product-badge">{{ $viewData['users']->count() }} {{ __('messages.admin.items') }}</span>
      </div>
      <div class="card-body p-0">
        @if ($viewData['users']->isEmpty())
          <div class="p-4 admin-product-empty">{{ __('messages.admin.no_users_registered') }}</div>
        @else
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 admin-product-table">
              <thead>
                <tr>
                  <th>{{ __('messages.admin.id') }}</th>
                  <th>{{ __('messages.admin.name') }}</th>
                  <th>{{ __('messages.admin.email') }}</th>
                  <th>{{ __('messages.admin.balance') }}</th>
                  <th>{{ __('messages.admin.role') }}</th>
                  <th class="text-center">{{ __('messages.admin.actions') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($viewData['users'] as $user)
                  <tr>
                    <td>{{ $user->getId() }}</td>
                    <td>{{ $user->getName() }}</td>
                    <td>{{ $user->getEmail() }}</td>
                    <td>${{ number_format($user->getBalance(), 0, ',', '.') }}</td>
                    <td>{{ $user->getRole() }}</td>
                    <td class="text-center">
                      <a href="{{ route('admin.user.edit', ['user' => $user->getId()]) }}"
                        class="btn btn-sm admin-product-btn-outline" title="{{ __('messages.admin.edit_action') }}"
                        aria-label="{{ __('messages.admin.edit_action') }}">
                        <i class="bi bi-pencil-square"></i>
                      </a>

                      <form action="{{ route('admin.user.destroy', ['user' => $user->getId()]) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm admin-product-btn-danger"
                          title="{{ __('messages.admin.delete_action') }}"
                          aria-label="{{ __('messages.admin.delete_action') }}"
                          onclick="return confirm('{{ __('messages.admin.confirm_delete_user') }}');">
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
