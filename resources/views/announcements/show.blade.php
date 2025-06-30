<x-layout.main>

  <div class="container my-4">

    {{-- Header --}}
    <div class="mb-4 text-center position-relative" style="height: 36px">
      <x-common.btnGoBack url="{{ route('announcements.index') }}"
                          class="d-block position-absolute start-0"
                          title="{{ __('Back to announcements') }}" />

    </div>

    {{-- Content --}}
    <div class="card border border-light-subtle shadow mb-3">
      <div class="card-body position-relative">
        {{-- Mark as not read --}}
        <form action="{{ route('announcements.mark-as-not-read', $announcement->id) }}" method="post">
          @csrf
          @method('PUT')
          <button type="submit"
                  role="button"
                  class="btn btn-link position-absolute top-0 end-0"
                  title="{{ __('Mark as unread') }}">
            <x-far-bookmark style="height: 20px" />
          </button>
        </form>

        {{-- Title --}}
        <h5 class="card-title">
          {{ $announcement->title }}
        </h5>

        {{-- Date --}}
        <span class="text-muted"><small>{{ $announcement->created_at->diffForHumans() }}</small></span>

        {{-- Content --}}
        <p class="card-text">{!! $announcement->content !!}</p>
      </div>
    </div>


  </div>
</x-layout.main>
