<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
  <title>@yield('title', __('messages.layout.title_default'))</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
    <div class="container">
      <a class="navbar-brand" href="#">{{ __('messages.layout.brand') }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

        <div class="navbar-nav ms-auto">
          <a class="nav-link active" href="{{ route('home.index') }}">{{ __('messages.layout.nav.home') }}</a>
          <a class="nav-link active" href="{{ route('home.about') }}">{{ __('messages.layout.nav.about') }}</a>
          <a class="nav-link active" href="{{ route('home.contact') }}">{{ __('messages.layout.nav.contact') }}</a>
          <div class="vr bg-white mx-2 d-none d-lg-block"></div>
          <a class="nav-link active" href="#">{{ __('messages.layout.nav.products') }}</a>
          <a class="nav-link active" href="#">{{ __('messages.layout.nav.cart') }}</a>
          <a class="nav-link active" href="#">{{ __('messages.layout.nav.orders') }}</a>
          <div class="vr bg-white mx-2 d-none d-lg-block"></div>

          <li class="nav-item dropdown ms-2">
            <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              {{ __('messages.layout.nav.language') }}
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">
                  {{ __('messages.layout.nav.english') }}
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('lang.switch', 'es') }}">
                  {{ __('messages.layout.nav.spanish') }}
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              {{ __('messages.layout.nav.account') }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="#">
                  {{ __('messages.layout.nav.login') }}
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#">
                  {{ __('messages.layout.nav.register') }}
                </a>
              </li>
            </ul>
          </li>

        </div>
      </div>
    </div>
  </nav>

  <header class="masthead bg-primary text-white text-center py-4">
    <div class="container d-flex align-items-center flex-column">
      <h5>@yield('subtitle', __('messages.layout.subtitle_default'))</h5>
    </div>
  </header>

  <div class="container my-4">
    @yield('content')
  </div>

  <div class="copyright py-4 text-center text-white">
    <div class="container">
      <small>
        {{ __('messages.layout.footer_rights') }}
      </small>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
</body>
</html>
