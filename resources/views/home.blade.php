<x-layout.main>

  {{-- Sub navigation --}}
  <nav class="navbar navbar-dark bg-primary-900">
    <div class="container d-flex justify-content-center">
      <div class="navbar-nav d-flex flex-row justify-content-center align-items-center gap-3">
        @foreach ($pageBlocks as $block)
          <a class="nav-link" href="{{ route('home') . '#' . $block->slug }}">
            {{ $block->title }}
          </a>
        @endforeach
      </div>
    </div>
  </nav>

  @foreach ($pageBlocks as $block)
    <div class="container mb-3" style="max-width: 920px">
      {{-- Title --}}
      <div class="container position-relative" id="{{ $block->slug }}">
        <h2 class="page-block-title">{{ $block->title ?? 'Title' }}</h2>

        {{-- Edit button --}}
        @if (Auth::check() && Auth::user()->isAdmin())
          <x-common.btnEdit url="{{ route('text-editor.show', ['resourceType' => 'pageblock', 'resourceId' => $block->id, 'callBackRoute' => 'home']) }}"
                            class="d-block position-absolute bottom-0 end-0 me-2" />
        @endif
      </div>

      {{-- Content --}}
      <div class="container position-relative">
        <div class="row justify-content-center">
          <div class="editor-content my-4">{!! $block->content !!}</div>
        </div>

        {{-- Button to scroll to top --}}
        @unless ($block->slug === 'wie-zijn-we')
          <x-common.btnScrollToTop class="d-block position-absolute bottom-0 end-0 me-2" />
        @endunless
      </div>



    </div>
  @endforeach

</x-layout.main>
