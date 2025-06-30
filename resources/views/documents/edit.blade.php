<x-layout.main>

  <div class="container my-4">

    {{-- Header --}}
    <h1 class="mb-4 text-center position-relative">
      <x-common.btnGoBack url="{{ route('documents.index') }}"
                          class="d-block position-absolute start-0"
                          style="margin-top: -20px"
                          title="{{ __('Back to documents') }}" />
      {{ __('Edit document') }}
    </h1>

    {{-- Form --}}
    <x-documents.form action="{{ route('documents.update', $document) }}"
                      :document="$document" />

  </div>

</x-layout.main>
