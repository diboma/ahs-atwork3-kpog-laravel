@props(['url' => null, 'title' => null])

@if ($url)
  <a href="{{ $url }}"
     title="{{ $title ?? __('Create') }}"
     role="button"
     {{ $attributes }}>
    <x-fas-plus-circle class="text-success" style="width: 30px" />
  </a>
@endif
