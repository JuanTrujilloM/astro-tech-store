@extends('layouts.app')
@section('breadcrumbs')
  {{ Breadcrumbs::render('password.confirm') }}
@endsection
@section('content')

  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8 col-xl-6">
      <div class="card">
          <div class="card-header">{{ __('messages.auth.confirm_password') }}</div>

          <div class="card-body">
            {{ __('messages.auth.confirm_password_hint') }}

            <form method="POST" action="{{ route('password.confirm') }}">
              @csrf

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

              <div class="row mb-0">
                <div class="col-12 col-md-8 offset-md-4 d-flex flex-column flex-sm-row flex-wrap gap-2">
                  <button type="submit" class="btn btn-primary">
                    {{ __('messages.auth.confirm_password') }}
                  </button>

                  @if (Route::has('password.request'))
                    <a class="btn btn-link px-sm-0 text-start" href="{{ route('password.request') }}">
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
  </div>

@endsection
