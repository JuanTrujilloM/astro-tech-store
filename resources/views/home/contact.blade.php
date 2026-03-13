@extends('layouts.app')
@section('title', __('messages.contact.title'))
@section('content')
  <section class="mb-5">
    <div class="p-5 rounded-4 bg-light border text-center">
      <h1 class="display-6 fw-bold mb-3">{{ __('messages.contact.hero_title') }}</h1>
      <p class="lead mb-0 mx-auto max-width-900">
        {{ __('messages.contact.hero_description') }}
      </p>
    </div>
  </section>

  <div class="row g-4 justify-content-center">
    <div class="col-12 col-md-6 col-lg-5">
      <section class="p-4 rounded-4 border bg-white h-100">
        <h3 class="h4 mb-3">{{ __('messages.contact.info_title') }}</h3>

        <div class="mb-3">
          <div class="d-flex align-items-start">
            <i class="bi bi-envelope text-primary me-2 mt-1 flex-shrink-0 icon-md"></i>
            <div>
              <p class="mb-0 fw-semibold">{{ __('messages.contact.email_info') }}</p>
              <p class="mb-0 text-muted">{{ __('messages.contact.email_value') }}</p>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <div class="d-flex align-items-start">
            <i class="bi bi-telephone text-primary me-2 mt-1 flex-shrink-0 icon-md"></i>
            <div>
              <p class="mb-0 fw-semibold">{{ __('messages.contact.phone_info') }}</p>
              <p class="mb-0 text-muted">{{ __('messages.contact.phone_value') }}</p>
            </div>
          </div>
        </div>

        <div>
          <div class="d-flex align-items-start">
            <i class="bi bi-geo-alt text-primary me-2 mt-1 flex-shrink-0 icon-md"></i>
            <div>
              <p class="mb-0 fw-semibold">{{ __('messages.contact.location_info') }}</p>
              <p class="mb-0 text-muted">{{ __('messages.contact.location_value') }}</p>
            </div>
          </div>
        </div>
      </section>
    </div>

    <div class="col-12 col-md-6 col-lg-5">
      <section class="p-4 rounded-4 border bg-white h-100">
        <h3 class="h4 mb-3">{{ __('messages.contact.hours_title') }}</h3>
        <div class="mb-2">
          <div class="d-flex justify-content-between">
            <span class="text-muted">{{ __('messages.contact.hours_weekdays') }}</span>
            <span class="fw-semibold">{{ __('messages.contact.hours_weekdays_time') }}</span>
          </div>
        </div>
        <div class="mb-2">
          <div class="d-flex justify-content-between">
            <span class="text-muted">{{ __('messages.contact.hours_saturday') }}</span>
            <span class="fw-semibold">{{ __('messages.contact.hours_saturday_time') }}</span>
          </div>
        </div>
        <div>
          <div class="d-flex justify-content-between">
            <span class="text-muted">{{ __('messages.contact.hours_sunday') }}</span>
            <span class="fw-semibold">{{ __('messages.contact.hours_sunday_time') }}</span>
          </div>
        </div>
      </section>
    </div>

  </div>
@endsection
