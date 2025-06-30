@props(['image' => null, 'title' => null, 'imageWidth' => '500'])

<div class="container-fluid bg-primary text-white text-center p-3">
  @if ($image)
    <img src="{{ $image }}" alt="{{ $title }}" class="img-fluid" width="{{ $imageWidth }}">
  @endif
  @if ($title)
    <h1>{{ $title }}</h1>
  @endif
</div>
