<x-layout.main>

  <div class="container my-4 user-select-none">

    {{-- Header --}}
    <h1 class="mb-4 text-center position-relative">
      {{-- Title --}}
      {{ __('Announcements') }}

      {{-- Button to create announcement --}}
      @can('create', App\Models\Announcement::class)
        <x-common.btnCreate url="{{ route('announcements.create') }}"
                            class="d-block position-absolute top-0 end-0"
                            style="margin-top: -20px"
                            title="{{ __('Create announcement') }}" />
      @endcan

    </h1>

    {{-- Modal to confirm delete --}}
    @can('delete', App\Models\Announcement::class)
      @include('partials.modalDelete')
    @endcan

    {{-- Announcements --}}
    <table class="table table-hover">
      <thead>
        <th></th>
        <th></th>
        <th></th>
        @can(['update', 'delete'], App\Models\Announcement::class)
          <th></th>
        @endcan
      </thead>
      <tbody>
        @foreach ($announcements as $announcement)
          <x-announcements.listItem :announcement="$announcement" />
        @endforeach
      </tbody>
    </table>

  </div>


</x-layout.main>
