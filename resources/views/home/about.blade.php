@extends('layouts.app')
@section('title', __('messages.about.title'))
@section('content')
  <section class="mb-5">
    <div class="p-5 rounded-4 bg-light border text-center">
      <h1 class="display-6 fw-bold mb-3">{{ __('messages.about.hero_title') }}</h1>
      <p class="lead mb-0 mx-auto max-width-900">
        {{ __('messages.about.hero_description') }}
      </p>
    </div>
  </section>

  <section class="mb-5">
    <div class="p-5 rounded-4 border bg-white">
      <h2 class="h3 mb-3 text-center">{{ __('messages.about.mission_title') }}</h2>
      <p class="text-muted text-center mx-auto max-width-800">
        {{ __('messages.about.mission_description') }}
      </p>
    </div>
  </section>

  <section class="mb-5">
    <div class="text-center mb-4">
      <h2 class="h3 mb-0">{{ __('messages.about.values_title') }}</h2>
    </div>
    <div class="row g-3">
      <div class="col-12 col-md-4">
        <div class="p-4 rounded-4 border h-100 bg-light text-center">
          <div class="mb-3">
            <i class="bi bi-lightbulb text-primary icon-lg"></i>
          </div>
          <h3 class="h5 mb-2">{{ __('messages.about.innovation.title') }}</h3>
          <p class="text-muted mb-0">
            {{ __('messages.about.innovation.description') }}
          </p>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="p-4 rounded-4 border h-100 bg-light text-center">
          <div class="mb-3">
            <i class="bi bi-award text-primary icon-lg"></i>
          </div>
          <h3 class="h5 mb-2">{{ __('messages.about.quality.title') }}</h3>
          <p class="text-muted mb-0">
            {{ __('messages.about.quality.description') }}
          </p>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="p-4 rounded-4 border h-100 bg-light text-center">
          <div class="mb-3">
            <i class="bi bi-people text-primary icon-lg"></i>
          </div>
          <h3 class="h5 mb-2">{{ __('messages.about.customer_focus.title') }}</h3>
          <p class="text-muted mb-0">
            {{ __('messages.about.customer_focus.description') }}
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="mb-5">
    <div class="p-5 rounded-4 border bg-white">
      <h2 class="h3 mb-3 text-center">{{ __('messages.about.team_title') }}</h2>
      <p class="text-muted text-center mx-auto mb-4 max-width-800">
        {{ __('messages.about.team_description') }}
      </p>

      <div class="row g-3 mt-4">
        @foreach (__('messages.about.team_members') as $member)
          <div class="col-12 col-md-4">
            <div class="p-4 rounded-4 border h-100 bg-light text-center">
              <div class="mb-3">
                <img src="{{ asset('images/team/' . $member['image']) }}" alt="{{ $member['name'] }}"
                  class="rounded-circle team-img">
              </div>
              <h4 class="h6 mb-0">{{ $member['name'] }}</h4>
            </div>
          </div>
        @endforeach
      </div>

      <p class="text-center text-muted mt-4">
        <small>{{ __('messages.about.contact_cta') }}</small>
      </p>
    </div>
  </section>
@endsection
