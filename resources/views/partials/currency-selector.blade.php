<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
    data-bs-display="static" aria-expanded="false">
    {{ __('messages.layout.nav.currency') }}: {{ $selectedCurrency }}
  </a>
  <ul class="dropdown-menu dropdown-menu-lg-end">
    @foreach ($supportedCurrencies as $code => $currency)
      <li>
        <a class="dropdown-item {{ $selectedCurrency === $code ? 'active' : '' }}"
          href="{{ route('currency.switch', $code) }}">
          {{ $currency['flag'] }} {{ $code }} — {{ __('messages.layout.nav.'. $currency['label']) }}
        </a>
      </li>
    @endforeach
  </ul>
</li>
