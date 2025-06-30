@props(['url' => null, 'title' => null])

@if ($url)
  <a href="{{ $url }}"
     title="{{ $title ?? __('Edit') }}"
     role="button"
     {{ $attributes }}>
    <x-far-edit class="text-warning" style="height: 20px" />
  </a>
@endif
