<x-layout.main>

  <div class="container my-4">

    {{-- Header --}}
    <h1 class="mb-4 text-center position-relative">
      {{-- Title --}}
      {{ __('Users') }}

      {{-- Buttons --}}
      @can('create', App\Models\User::class)
        <div class="position-absolute top-0 end-0 lh-1 d-flex align-center gap-3"
             style="margin-top: -20px">
          {{-- Button to create user --}}
          <x-common.btnCreate url="{{ route('users.create') }}"
                              title="{{ __('Create user') }}" />

          {{-- Button to download users --}}
          <x-common.btnDownload url="{{ route('users.export') }}"
                                title="{{ __('Export users') }}"
                                size='medium' />

        </div>
      @endcan
    </h1>

    {{-- Search --}}
    <div class="my-4 row">
      <div class="col-10 col-md-8 col-lg-6 mx-auto">
        <form action="{{ route('users.index') }}"
              method="get"
              class="d-flex gap-2 align-items-center">
          @if ($search)
            <a href="{{ route('users.index') }}">
              <x-fas-xmark style="width: 20px" />
            </a>
          @endif
          <input type="text" name="search" id="search" class="form-control"
                 placeholder="{{ __('Search by name or email') }}"
                 value="{{ $search ?? '' }}"
                 required>
          <button type="submit" class="btn btn-outline-secondary">{{ __('Search') }}</button>
        </form>
      </div>
    </div>

    {{-- Modal to confirm delete --}}
    @can('delete', [Auth::user(), App\Models\User::class])
      @include('partials.modalDelete')
    @endcan

    {{-- List of users --}}
    @empty($users)
      <div class="text-center mt-4">{{ __('No users found') }}</div>
    @else
      <div class="d-flex justify-content-center flex-wrap gap-3">
        @foreach ($users as $user)
          <x-users.card :user="$user" />
        @endforeach
      </div>
    @endempty

    {{-- Pagination --}}
    <div class="my-5">
      {{ $users->onEachSide(2)->links() }}
    </div>

  </div>

</x-layout.main>
