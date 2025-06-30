<x-layout.main>

  <div class="container my-4">

    {{-- Header --}}
    <h1 class="mb-4 text-center position-relative">
      {{-- Button to go back --}}
      <x-common.btnGoBack url="{{ route('albums.show', $album->id) }}"
                          class="d-block position-absolute start-0"
                          title="{{ __('Back to photos') }}"
                          style="margin-top: -20px" />

      {{-- Title --}}
      {{ __('Upload photos') }}
    </h1>

    {{-- Form --}}
    <div class="card border border-light-subtle shadow mx-auto" style="width: 420px">
      <div class="card-body">

        <form action="{{ route('photos.store', $album->id) }}"
              method="post"
              enctype="multipart/form-data">
          @csrf

          <x-common.inputField type="file"
                               name="photos[]"
                               label="{{ __('Please select at least one photo.') }}"
                               value=""
                               required="true"
                               multiple="true"
                               error="{{ $errors->first('files.*') }}" />

          {{-- Buttons --}}
          <x-common.formButtons submitLabel="{{ __('Upload') }}"
                                cancelRoute="{{ route('albums.show', $album->id) }}" />
        </form>

      </div>
    </div>


  </div>

</x-layout.main>
