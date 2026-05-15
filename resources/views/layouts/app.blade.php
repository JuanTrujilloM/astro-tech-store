<!--
  Author: Juan Esteban Trujillo Montes
  Description: View responsible for providing the main layout for the application, including the navigation bar, header, footer, and a container for displaying the content of each page, while also supporting localization and responsive design.
-->
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="icon" type="image/svg+xml" href="{{ asset('images/app/logoapp.svg') }}">
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
  <title>@yield('title', __('messages.layout.title_default'))</title>
</head>

<body class="d-flex flex-column min-vh-100">
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-3 py-lg-4">
    <div class="container-fluid px-3 px-lg-4">
      <a class="navbar-brand d-flex align-items-center gap-2 flex-shrink-0 text-wrap" href="{{ route('home.index') }}">
        <img src="{{ asset('images/app/logoapp.svg') }}" alt="" class="navbar-brand-logo flex-shrink-0">
        {{ __('messages.layout.brand') }}
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center text-center text-lg-start">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home.index') ? 'active' : '' }}" href="{{ route('home.index') }}">{{ __('messages.layout.nav.home') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home.about') ? 'active' : '' }}" href="{{ route('home.about') }}">{{ __('messages.layout.nav.about') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home.contact') ? 'active' : '' }}" href="{{ route('home.contact') }}">{{ __('messages.layout.nav.contact') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}" href="{{ route('product.index') }}">{{ __('messages.layout.nav.products') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('cart.*') ? 'active' : '' }}" href="{{ route('cart.index') }}">{{ __('messages.layout.nav.cart') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('order.*') ? 'active' : '' }}" href="{{ route('order.index') }}">{{ __('messages.layout.nav.orders') }}</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
              {{ __('messages.layout.nav.language') }}
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li>
                <a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">{{ __('messages.layout.nav.english') }}</a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('lang.switch', 'es') }}">{{ __('messages.layout.nav.spanish') }}</a>
              </li>
            </ul>
          </li>
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('messages.layout.nav.login') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('messages.layout.nav.register') }}</a>
            </li>
          @else
            <li class="nav-item">
              <span class="nav-link d-inline-flex align-items-center justify-content-center gap-1 text-white">
                <i class="bi bi-wallet2 flex-shrink-0"></i>
                <span class="text-break">${{ number_format(Auth::user()->getBalance(), 0, ',', '.') }}</span>
              </span>
            </li>
            <li class="nav-item">
              <form id="logout" action="{{ route('logout') }}" method="POST" class="d-grid d-lg-inline">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-white text-decoration-none p-0 border-0 w-100 w-lg-auto text-center text-lg-start">
                  {{ __('messages.layout.nav.logout') }}
                </button>
              </form>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <header class="masthead bg-primary text-white text-center py-3 py-md-4 px-3">
    <div class="container">
      <h5 class="mb-0 text-wrap px-md-2">@yield('subtitle', __('messages.layout.subtitle_default'))</h5>
    </div>
  </header>

  <div class="container my-3 my-md-4 flex-grow-1 d-flex flex-column">
    @hasSection('breadcrumbs')
      <nav aria-label="breadcrumb" class="mb-3">
        @yield('breadcrumbs')
      </nav>
    @endif
    @yield('content')
  </div>

  <div class="copyright py-4 text-center text-white mt-auto">
    <div class="container">
      <small>
        {{ __('messages.layout.footer_rights') }}
      </small>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>

  <!-- Confirm Delete Modal -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteModalLabel">{{ __('messages.admin.confirm_delete_title') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="confirmDeleteModalBody">
          {{ __('messages.admin.confirm_delete_generic') }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.admin.cancel') }}</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteBtn">{{ __('messages.admin.confirm_delete_btn') }}</button>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/confirm-delete.js') }}"></script>
</body>

</html>
