<!--
  Author: Juan Esteban Trujillo Montes
  Description: Layout view for the admin panel, providing a consistent structure and design for all admin-related pages, including a sidebar for navigation, a topbar for page titles and user actions, and a main content area for displaying the specific content of each admin page.
-->

<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', __('messages.admin.title'))</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="icon" type="image/jpeg" href="{{ asset('images/app/logapp.jpg') }}">
  <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
</head>

<body class="admin-body">
  <div class="container-fluid p-0 admin-shell">
    <div class="row g-0 admin-layout">

      <aside class="col-12 col-md-3 col-lg-2 admin-sidebar">
        <a href="{{ route('admin.home.index') }}" class="admin-brand text-decoration-none">
          <span class="admin-brand-title">{{ __('messages.layout.brand') }}</span>
          <small class="admin-brand-subtitle">{{ __('messages.admin.panel') }}</small>
        </a>

        <hr class="admin-separator">
        <ul class="nav flex-column admin-nav">
          <li class="nav-item mb-2">
            <a href="{{ route('admin.home.index') }}" class="nav-link admin-nav-link">
              <i class="bi bi-speedometer2 me-2"></i>
              {{ __('messages.admin.dashboard') }}
            </a>
          </li>

          <li class="nav-item mb-2">
            <a href="{{ route('admin.user.index') }}" class="nav-link admin-nav-link">
              <i class="bi bi-people me-2"></i>
              {{ __('messages.admin.users') }}
            </a>
          </li>

          <li class="nav-item mb-2">
            <a href="{{ route('admin.product.index') }}" class="nav-link admin-nav-link">
              <i class="bi bi-box-seam me-2"></i>
              {{ __('messages.admin.products') }}
            </a>
          </li>

          <li class="nav-item mb-2">
            <a href="{{ route('admin.order.index') }}" class="nav-link admin-nav-link">
              <i class="bi bi-cart3 me-2"></i>
              {{ __('messages.admin.orders') }}
            </a>
          </li>

          <li class="nav-item mb-3">
            <a href="{{ route('admin.review.index') }}" class="nav-link admin-nav-link">
              <i class="bi bi-star me-2"></i>
              {{ __('messages.admin.reviews') }}
            </a>
          </li>

          <li class="nav-item pt-4">
            <a href="{{ route('home.index') }}" class="btn btn-primary w-100 admin-store-btn">
              <i class="bi bi-house me-2"></i>
              {{ __('messages.admin.go_to_store') }}
            </a>
          </li>
        </ul>
      </aside>

      <div class="col-12 col-md-9 col-lg-10 admin-main d-flex flex-column min-vh-100">
        <nav class="navbar navbar-light admin-topbar px-4">
          <span class="navbar-brand mb-0 h5 admin-page-title">
            @yield('page_title', __('messages.admin.dashboard'))
          </span>

          <div class="d-flex align-items-center admin-user-box">
            <div class="dropdown me-3">
              <a class="btn btn-sm btn-outline-secondary dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ __('messages.admin.language') }}
              </a>

              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item"
                    href="{{ route('lang.switch', 'en') }}">{{ __('messages.layout.nav.english') }}</a></li>
                <li><a class="dropdown-item"
                    href="{{ route('lang.switch', 'es') }}">{{ __('messages.layout.nav.spanish') }}</a></li>
              </ul>
            </div>
          </div>
        </nav>

        <main class="admin-content flex-grow-1">
          <div class="admin-content-inner">
            @yield('content')
          </div>
        </main>

        <footer class="admin-footer mt-auto">
          <small>
            {{ __('messages.admin.footer_prefix') }}
            Juan Esteban Trujillo Montes,
            Andres Perez Quinchia,
            Juan Sebastian Lizcano
          </small>
        </footer>
      </div>

    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
