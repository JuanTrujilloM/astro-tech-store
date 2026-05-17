@extends('layouts.app')
@section('title', __('messages.auth.login') . ' - ' . __('messages.layout.title_default'))
@section('breadcrumbs')
  {{ Breadcrumbs::render('login') }}
@endsection
@section('content')

  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8 col-xl-6">
      <div class="card">
          <div class="card-header">{{ __('messages.auth.login') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="row mb-3">
                <label for="email" class="col-12 col-md-4 col-form-label text-md-end">{{ __('messages.auth.email_address') }} <span class="text-danger">*</span></label>

                <div class="col-12 col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                    name="password" required autocomplete="current-password">

                  @error('password')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-12 col-md-6 offset-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                      {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                      {{ __('messages.auth.remember_me') }}
                    </label>
                  </div>
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-12 col-md-8 offset-md-4 d-flex flex-column flex-sm-row flex-wrap gap-2">
                  <button type="submit" class="btn btn-primary">
                    {{ __('messages.auth.login') }}
                  </button>

                  @if (Route::has('password.request'))
                    <a class="btn btn-link px-sm-0 text-start text-sm-center" href="{{ route('password.request') }}">
                      {{ __('messages.auth.forgot_password') }}
                    </a>
                  @endif
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
