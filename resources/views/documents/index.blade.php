<x-layout.main>

  <div class="container my-4">

    {{-- Header --}}
    <h1 class="mb-4 text-center position-relative">
      {{-- Title --}}
      {{ __('Documents') }}

      {{-- Buttons --}}
      @if (Auth::user()->isAdmin())
        <div class="position-absolute top-0 end-0 lh-1 d-flex align-center gap-3"
             style="margin-top: -20px">
          {{-- Button to upload a document --}}
          <x-common.btnCreate url="{{ route('documents.create') }}"
                              title="{{ __('Upload document') }}" />

        </div>
      @endif
    </h1>

    {{-- Modal to confirm delete --}}
    @if (Auth::user()->isAdmin())
      @include('partials.modalDelete')
    @endif


    {{-- Documents --}}
    @empty($documents)
      <p class="text-center">{{ __('No documents found.') }}</p>
    @else
      <ul class="list-group mx-auto shadow" style="max-width: 520px">
        @foreach ($documents as $document)
          <li class="list-group-item position-relative">
            {{-- Title --}}
            <h5>{{ $document->title }}</h5>

            {{-- Path --}}
            {{-- <div class="form-text">{{ $document->path }}</div> --}}

            {{-- Decription --}}
            @if ($document->description)
              <div class="form-text">{{ $document->description }}</div>
            @endif

            {{-- Actions --}}
            <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex gap-2 aligt-items-center">
              {{-- Download --}}
              <x-common.btnDownload url="{{ route('documents.download', $document->id) }}"
                                    class="text-primary" />
              @if (Auth::user()->isAdmin())
                {{-- Edit --}}
                <x-common.btnEdit url="{{ route('documents.edit', $document->id) }}" />
                {{-- Delete --}}
                <x-common.btnDelete action="{{ route('documents.destroy', $document->id) }}"
                                    resourceName="{{ Str::lower(__('Document')) }}: {{ $document->title }}" />
              @endif
            </div>
          </li>
        @endforeach
      </ul>
    @endempty
  </div>

</x-layout.main>
