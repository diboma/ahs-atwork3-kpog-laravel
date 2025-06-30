@props(['album' => null])

@if ($album)
  <div class="card border border-light-subtle shadow rounded" style="width: 320px">
    {{-- Image --}}
    <a href="{{ route('albums.show', $album->id) }}">
      @if ($album->cover)
        <img src="{{ route('render.photo', $album->cover->path) }}"
             class="card-img-top"
             style="max-height: 225px; object-fit: cover; object-position: center;"
             alt="{{ $album->title }}"
             loading="lazy" />
      @else
        <x-fas-photo-video class="card-img-top p-3" style="height: 200px" />
      @endif
    </a>

    {{-- Album details --}}
    <div class="card-body">
      {{-- Title & description --}}
      <h5 class="card-title">{{ $album->title }}</h5>
      <p class="card-text">{{ $album->description }}</p>

      {{-- Actions --}}
      @can(['update', 'delete'], $album)
        <div class="mt-1 d-flex align-items-center justify-content-end gap-2">
          <x-common.btnEdit url="{{ route('albums.edit', $album->id) }}" />
          <x-common.btnDelete action="{{ route('albums.destroy', $album->id) }}"
                              resourceName="{{ Str::lower(__('Album')) }}: {{ $album->title }}" />
        </div>
      @endcan
    </div>
  </div>
@endif
