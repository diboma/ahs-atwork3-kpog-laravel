@props(['url' => 'javascript:history.back()', 'title' => null])

<a href="{{ $url }}"
   title="{{ $title ?? __('Back') }}"
   role="button"
   {{ $attributes }}>
  <x-fas-arrow-alt-circle-left style="width: 30px" />
</a>
