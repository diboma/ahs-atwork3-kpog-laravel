@props(['title', 'content', 'action', 'callBackRoute'])

<div>
  <link rel="stylesheet" href="{{ asset('ckeditor/ckeditor5.css') }}" />

  <form action="{{ $action }}" method="post">
    @csrf
    @method('PUT')

    <input type="hidden" name="callBackRoute" value="{{ $callBackRoute }}">

    <div class="mb-4">
      <label for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
      <input type="text"
             class="form-control text-center text-primary fs-2"
             name="title"
             id="title"
             value="{{ $title }}">
    </div>

    <div class="mb-3">
      <label for="editor">{{ __('Content') }} <span class="text-danger">*</span></label>
      <textarea id="editor" name="content">{!! $content !!}</textarea>
    </div>

    <div class="mt-4">
      <button type="submit" class="btn btn-primary">
        {{ __('Save') }}
      </button>

      <a href="{{ route($callBackRoute) }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
    </div>
  </form>

  {{-- TinyMCE --}}
  <script src="{{ asset('tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      language: 'nl_BE',
      selector: '#editor',
      min_height: 500,
      plugins: 'accordion code table lists autoresize fullscreen',
      toolbar: 'fullscreen | undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist accordion | code | table'
    });
  </script>
</div>
