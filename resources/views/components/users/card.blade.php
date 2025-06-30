@props(['user' => null])

@if ($user)
  <div class="card border border-light-subtle shadow rounded" style="width: 320px">
    <div class="card-body">
      {{-- User details --}}
      <div class="d-flex gap-3 justify-content-start align-items-center">
        <x-common.avatar :user="$user" size="small" />
        <div class='card-text d-flex flex-column'>
          <div>
            <span>{{ $user->getFullName() }}</span>
          </div>
          <span class="text-muted"><small>{{ $user->email }}</small></span>
        </div>
      </div>

      {{-- Actions --}}
      @can(['update', 'delete'], $user)
        <div class="mt-1 d-flex align-items-center justify-content-end gap-2">
          <x-common.btnEdit url="{{ route('users.edit', $user->id) }}" />
          <x-common.btnDelete action="{{ route('users.destroy', $user->id) }}"
                              resourceName="{{ Str::lower(__('User')) }}: {{ $user->getFullName() }}" />
        </div>
      @endcan
    </div>
  </div>
@endif
