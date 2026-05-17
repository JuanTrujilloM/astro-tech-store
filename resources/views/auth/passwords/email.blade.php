@extends('layouts.app')
@section('breadcrumbs')
  {{ Breadcrumbs::render('password.request') }}
@endsection
@section('content')

  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8 col-xl-6">
      <div class="card">
        <div class="card-header">{{ __('messages.auth.reset_password') }}</div>

        <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
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

              <div class="row mb-0">
                <div class="col-12 col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('messages.auth.send_reset_link') }}
                  </button>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

@endsection
