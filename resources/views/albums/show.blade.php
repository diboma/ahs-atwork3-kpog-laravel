<x-layout.main>

  <div class="container my-4 position-relative">

    {{-- Header --}}
    <h1 class="mb-4 text-center position-relative">
      {{-- Button to go back --}}
      <x-common.btnGoBack url="{{ route('albums.index') }}"
                          class="d-block position-absolute start-0"
                          title="{{ __('Back to photos') }}"
                          style="margin-top: -20px" />

      {{-- Title --}}
      {{ $album->title }}

      {{-- Button to upload photos --}}
      @can('create', App\Models\Photo::class)
        <x-common.btnUpload url="{{ route('photos.create', $album) }}"
                            title="{!! __('Upload photos') !!}"
                            size="medium"
                            class="d-block position-absolute top-0 end-0"
                            style="margin-top: -20px" />
      @endcan
    </h1>

    {{-- Modal to confirm delete --}}
    @can('delete', App\Models\Album::class)
      @include('partials.modalDelete')
    @endcan

    {{-- Album description --}}
    <p class="mx-auto text-center text-muted" style="max-width: 80ch">{{ $album->description }}</p>

    {{-- Floating button to scroll to top --}}
    <div class="position-fixed bottom-0 end-0 me-3 mb-3">
      <x-common.btnScrollToTop />
    </div>

    {{-- Photo container --}}
    @if (count($photos) === 0)
      <div class="mt-4 text-center fs-5">{{ __('You have not added any photos.') }}</div>
    @else
      <div class="position-relative d-flex justify-content-center flex-wrap gap-3">
        @foreach ($photos as $index => $photo)
          @php
            $imgSrc = route('render.photo', $photo->path);
          @endphp

          <div class="position-relative photo-container is-loading">
            {{-- Button to delete --}}
            @can('delete', $photo)
              <div class="position-absolute top-0 end-0 m-1">
                <x-common.btnDelete action="{{ route('photos.destroy', ['album' => $photo->album->id, 'photo' => $photo->id]) }}"
                                    resourceName="{{ Str::lower(__('Photo')) }}: {{ $photo->path }}" />
              </div>
            @endcan
            {{-- Image --}}
            <a data-fancybox="gallery" data-src="{{ $imgSrc }}">
              <img src="{{ $imgSrc }}"
                   alt="{{ 'Photo ' . $index + 1 . ' of ' . $album->title }}"
                   id="{{ 'photo-' . $photo->id }}"
                   class="z-3 img-fluid rounded"
                   style="object-fit: cover; object-position: center; width: 200px; height: 200px;"
                   onload="this.parentElement.parentElement.classList.remove('is-loading')" />
            </a>
          </div>
        @endforeach
      </div>
    @endif
  </div>

  <link rel="stylesheet" href="{{ url('fancybox/fancybox.css') }}" />
  <script src="{{ url('fancybox/fancybox.umd.js') }}"></script>
  <script>
    Fancybox.bind('[data-fancybox="gallery"]', {
      //
    });
  </script>
</x-layout.main>
