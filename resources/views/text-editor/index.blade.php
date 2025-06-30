<x-layout.main>

  <div class="container my-4">

    <x-common.textEditor title="{{ $title ?? '' }}"
                         content="{{ $content ?? '' }}"
                         action="{{ $action }}"
                         callBackRoute="{{ $callBackRoute }}" />
  </div>

</x-layout.main>
