@props(['announcement'])

@php
  $isRead = $announcement->readers()->where('user_id', auth()->id())->first()?->pivot->read ?? false;
@endphp

<tr class="{{ !$isRead ? 'fw-bold' : '' }}">
  {{-- Read status --}}
  <td>
    @if (!$isRead)
      <x-fas-bookmark class="text-primary" style="height: 20px" />
    @endif
  </td>

  {{-- Title --}}
  <td class="{{ !$isRead ? 'text-primary' : '' }}">
    <a href="{{ route('announcements.show', $announcement) }}">
      {{ $announcement->title }}
    </a>
  </td>

  {{-- Date --}}
  <td class="{{ !$isRead ? 'text-primary' : '' }}">
    {{ $announcement->created_at->diffForHumans() }}
  </td>

  {{-- Actions --}}
  @can(['update', 'delete'], $announcement)
    <td class="d-flex gap-2 align-items-center">
      <x-common.btnEdit
                        url="{{ route('text-editor.show', ['announcement', $announcement->id, 'callBackRoute' => 'announcements.index']) }}" />
      <x-common.btnDelete action="{{ route('announcements.destroy', $announcement->id) }}"
                          resourceName="{{ Str::lower(__('Announcement')) }}: {{ $announcement->title }}" />
    </td>
  @endcan
</tr>
