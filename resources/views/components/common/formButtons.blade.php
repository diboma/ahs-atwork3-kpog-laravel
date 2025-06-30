@props(['submitLabel' => __('Submit'), 'cancelRoute' => 'home'])

<div class="mb-0">
  {{-- Submit --}}
  <button type="submit" class="btn btn-primary w-100 mt-4">
    {{ $submitLabel }}
  </button>

  {{-- Cancel --}}
  <a href="{{ $cancelRoute }}"
     class="btn btn-outline-secondary w-100 mt-3">
    {{ __('Cancel') }}
  </a>
</div>
