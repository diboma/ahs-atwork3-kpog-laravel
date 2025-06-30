<x-layout.main>

  <div class="container my-4">

    {{-- Header --}}
    <h1 class="mb-4 text-center position-relative">
      <x-common.btnGoBack url="{{ route('albums.index') }}"
                          class="d-block position-absolute start-0"
                          style="margin-top: -20px"
                          title="{{ __('Back to albums') }}" />
      {{ __('Add album') }}
    </h1>

    {{-- Form --}}
    <x-albums.form action="{{ route('albums.store') }}" />

  </div>

</x-layout.main>
