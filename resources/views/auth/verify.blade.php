@extends('layouts.app')
@section('breadcrumbs')
  {{ Breadcrumbs::render('verification.notice') }}
@endsection
@section('content')

  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8 col-xl-6">
      <div class="card">
          <div class="card-header">{{ __('messages.auth.verify_email') }}</div>

          <div class="card-body">
            @if (session('resent'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ __('messages.auth.verification_sent') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            {{ __('messages.auth.check_email') }}
            {{ __('messages.auth.did_not_receive') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
              @csrf
              <button type="submit"
                class="btn btn-link p-0 m-0 align-baseline">{{ __('messages.auth.request_another') }}</button>.
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
