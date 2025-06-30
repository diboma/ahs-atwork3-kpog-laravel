@props(['document' => null, 'action', 'cancelRoute' => route('documents.index')])

<div class="card border border-light-subtle shadow mx-auto" style="width: 420px">
  <div class="card-body">

    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
      @csrf
      @if ($document)
        @method('PUT')
      @endif

      {{-- Title --}}
      <x-common.inputField name="title"
                           label="{{ __('Title') }}"
                           value="{{ $document->title ?? old('title') }}"
                           autocomplete="title"
                           autofocus
                           error="{{ $errors->first('title') }}"
                           helperText="{{ __('The title must be unique.') }}" />

      {{-- Description --}}
      <x-common.inputField type="textarea"
                           name="description"
                           label="{{ __('Description') }}"
                           value="{{ $document->description ?? old('description') }}"
                           required="{{ false }}"
                           error="{{ $errors->first('description') }}" />

      {{-- File --}}
      <x-common.inputField type="file"
                           name="file"
                           label="{{ __('File') }}"
                           value="{{ old('file') }}"
                           required="{{ $document ? false : true }}"
                           error="{{ $errors->first('file') }}"
                           helperText="{{ $document ? __('Leave empty if you do not want to change the file.') : '' }}"
                           @endif />

        {{-- Buttons --}}
        <x-common.formButtons submitLabel="{{ $document ? __('Save') : __('Upload') }}"
                              cancelRoute="{{ $cancelRoute }}" />
    </form>

  </div>
</div>
