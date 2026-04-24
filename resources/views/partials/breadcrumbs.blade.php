<!--
  Author: Juan Esteban Trujillo Montes
  Description: Partial view responsible for rendering the breadcrumb navigation trail.
-->
@unless ($breadcrumbs->isEmpty())
  <ol class="breadcrumb-custom" aria-label="breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
      @if ($breadcrumb->url && !$loop->last)
        <li class="breadcrumb-custom-item">
          <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
        </li>
      @else
        <li class="breadcrumb-custom-item active" aria-current="page">
          {{ $breadcrumb->title }}
        </li>
      @endif
    @endforeach
  </ol>
@endunless
