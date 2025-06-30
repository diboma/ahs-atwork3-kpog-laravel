@props(['album' => null, 'action', 'cancelRoute' => route('albums.index')])

<div class="card border border-light-subtle shadow mx-auto" style="width: 420px">
  <div class="card-body">
    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
      @csrf
      @if ($album)
        @method('PUT')
      @endif

      {{-- Title --}}
      <x-common.inputField name="title"
                           label="{{ __('Title') }}"
                           value="{{ $album->title ?? old('title') }}"
                           autocomplete="title"
                           autofocus
                           error="{{ $errors->first('title') }}"
                           helperText="{{ __('The title must be unique.') }}" />

      {{-- Description --}}
      <x-common.inputField type="textarea"
                           name="description"
                           label="{{ __('Description') }}"
                           value="{{ $album->description ?? old('description') }}"
                           required="{{ false }}"
                           error="{{ $errors->first('description') }}" />

      {{-- Buttons --}}
      <x-common.formButtons submitLabel="{{ $album ? __('Save') : __('Add') }}"
                            cancelRoute="{{ $cancelRoute }}" />
    </form>
  </div>
</div>
