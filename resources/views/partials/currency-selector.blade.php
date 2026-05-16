<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static"
    aria-expanded="false">
    {{ __('messages.layout.nav.currency') }}: {{ $selectedCurrency }}
  </a>
  <ul class="dropdown-menu dropdown-menu-lg-end">
    <li>
      <a class="dropdown-item {{ $selectedCurrency === 'COP' ? 'active' : '' }}"
        href="{{ route('currency.switch', 'COP') }}">
        🇨🇴 COP — {{ __('messages.layout.nav.currency_cop') }}
      </a>
    </li>
    <li>
      <a class="dropdown-item {{ $selectedCurrency === 'USD' ? 'active' : '' }}"
        href="{{ route('currency.switch', 'USD') }}">
        🇺🇸 USD — {{ __('messages.layout.nav.currency_usd') }}
      </a>
    </li>
    <li>
      <a class="dropdown-item {{ $selectedCurrency === 'EUR' ? 'active' : '' }}"
        href="{{ route('currency.switch', 'EUR') }}">
        🇪🇺 EUR — {{ __('messages.layout.nav.currency_eur') }}
      </a>
    </li>
    <li>
      <a class="dropdown-item {{ $selectedCurrency === 'GBP' ? 'active' : '' }}"
        href="{{ route('currency.switch', 'GBP') }}">
        🇬🇧 GBP — {{ __('messages.layout.nav.currency_gbp') }}
      </a>
    </li>
  </ul>
</li>
