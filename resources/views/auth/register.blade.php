@extends('layouts.app')
@section('title', __('messages.auth.register') . ' - ' . __('messages.layout.title_default'))
@section('breadcrumbs')
  {{ Breadcrumbs::render('register') }}
@endsection
@section('content')

  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8 col-xl-6">
      <div class="card">
          <div class="card-header">{{ __('messages.auth.register') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="row mb-3">
                <label for="name" class="col-12 col-md-4 col-form-label text-md-end">{{ __('messages.auth.name') }} <span class="text-danger">*</span></label>

                <div class="col-12 col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                  @error('name')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="email" class="col-12 col-md-4 col-form-label text-md-end">{{ __('messages.auth.email_address') }} <span class="text-danger">*</span></label>

                <div class="col-12 col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="password" class="col-12 col-md-4 col-form-label text-md-end">{{ __('messages.auth.password') }} <span class="text-danger">*</span></label>

                <div class="col-12 col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                  @error('password')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="password-confirm" class="col-12 col-md-4 col-form-label text-md-end">{{ __('messages.auth.confirm_password') }} <span class="text-danger">*</span></label>

                <div class="col-12 col-md-6">
                  <input id="password-confirm" type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation" required autocomplete="new-password">
                  @error('password_confirmation')
                    <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                  @enderror
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-12 col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('messages.auth.register') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
