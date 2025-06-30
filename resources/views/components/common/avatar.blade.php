@props(['user' => null, 'size' => 'medium'])

@if ($user)
  @php
    // Get size
    switch ($size) {
        case 'small':
            $style = 'width: 50px; height: 50px';
            break;
        case 'medium':
            $style = 'width: 100px; height: 100px';
            break;
        case 'large':
            $style = 'width: 200px; height: 200px';
            break;
        default:
            $style = 'width: 100px; height: 100px';
            break;
    }

    // Get avatar
    if ($user->avatar && Storage::disk('public')->exists('images/avatars/' . $user->avatar)) {
        $imgSrc = env('SYMLINK')
            ? asset('storage/images/avatars/' . $user->avatar)
            : route('render.avatar', $user->avatar);
    } else {
        $imgSrc = Avatar::create($user->getFullName())->toBase64();
    }
  @endphp

  <img src="{{ $imgSrc }}" alt="{{ $user->getFullName() }}"
       class="rounded-circle img-fluid"
       style="{{ $style }}">
@endif
