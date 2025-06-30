@props(['url' => null, 'title' => null, 'size' => 'small'])

@php
  switch ($size) {
      case 'small':
          $style = 'width: 20px; height: 20px';
          break;
      case 'medium':
          $style = 'width: 26px; height: 26px';
          break;
      case 'large':
          $style = 'width: 30px; height: 30px';
          break;
      default:
          $style = 'width: 20px; height: 20px';
          break;
  }
@endphp

@if ($url)
  <a href="{{ $url }}"
     title="{{ $title ?? __('Download') }}"
     role="button"
     {{ $attributes }}>
    <x-fas-download style="{{ $style }}" />
  </a>
@endif
