@props([
    'type' => 'text',
    'name',
    'label',
    'value' => null,
    'autocomplete' => 'off',
    'autofocus' => false,
    'required' => true,
    'multiple' => false,
    'error' => null,
    'helperText' => null,
])

<div class="mb-3">
  <label for="{{ $name }}" class="form-label">
    {{ $label }}
    @if ($required)
      <span class="text-danger">*</span>
    @endif
  </label>

  @if ($helperText)
    <div class="form-text mt-0">{{ $helperText }}</div>
  @endif

  @if ($type === 'textarea')
    <textarea class="form-control @error($name) is-invalid @enderror"
              id="{{ $name }}"
              name="{{ $name }}"
              @if ($autofocus) autofocus @endif
              @if ($required) required @endif
              {{ $attributes }}>{{ $value }}</textarea>
  @else
    <input type="{{ $type }}"
           class="form-control @error($name) is-invalid @enderror"
           id="{{ $name }}"
           name="{{ $name }}"
           @if ($value) value="{{ $value }}" @endif
           @if ($type !== 'file') autocomplete="{{ $autocomplete }}" @endif
           @if ($multiple) multiple @endif
           @if ($autofocus) autofocus @endif
           @if ($required) required @endif
           {{ $attributes }}>
  @endif

  @if ($error)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $error }}</strong>
    </span>
  @endif

</div>
