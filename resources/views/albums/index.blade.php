<x-layout.main>

  <div class="container my-4">

    {{-- Header --}}
    <h1 class="mb-4 text-center position-relative">
      {{-- Title --}}
      {{ __('Photos') }}

      {{-- Button to create announcement --}}
      @can('create', App\Models\Album::class)
        <x-common.btnCreate url="{{ route('albums.create') }}"
                            class="d-block position-absolute top-0 end-0"
                            style="margin-top: -20px"
                            title="{{ __('Create album') }}" />
      @endcan
    </h1>

    {{-- Modal to confirm delete --}}
    @can('delete', App\Models\Album::class)
      @include('partials.modalDelete')
    @endcan

    {{-- Albums --}}
    @if ($albums->count() === 0)
      <div class="text-center mt-4">{{ __('No albums found') }}</div>
    @else
      <div class="d-flex justify-content-center flex-wrap gap-3">
        @foreach ($albums as $album)
          <x-albums.card :album="$album" />
        @endforeach
      </div>
    @endif

    {{-- Pagination --}}
    <div class="my-5">
      {{ $albums->onEachSide(2)->links() }}
    </div>

  </div>

</x-layout.main>
