<nav class="navbar navbar-expand-md navbar-dark bg-primary"
     id="top">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('icons/favicon.svg') }}" width="30" height="30" class="d-inline-block align-top"
           alt="logo">
      {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      {{-- LEFT SIDE OF NAVBAR --}}
      <ul class="navbar-nav me-auto mt-1">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
             href="{{ route('home') }}">{{ __('Home') }}</a>
        </li>
      </ul>

      {{-- RIGHT SIDE OF NAVBAR --}}
      <ul class="navbar-nav ms-auto mt-1">
        {{-- NOT LOGGGED IN: AUTHENTICATION LINKs --}}
        @guest
          @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                 href="{{ route('login') }}">{{ __('Member zone') }}</a>
            </li>
          @endif

          {{--
          @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                 href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
          @endif
          --}}
        @else
          {{-- LOGGED IN: DROPDOWN MENU --}}
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->getFullName() }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              {{-- Announcements --}}
              <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->routeIs('announcements.*') ? 'active' : '' }}"
                 href="{{ route('announcements.index') }}">
                <x-fas-bullhorn class="{{ request()->routeIs('announcements.*') ? 'text-white' : 'text-primary' }}"
                                style="width: 20px" />
                {{ __('Announcements') }}
              </a>
              {{-- Members --}}
              <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->routeIs('users.*') ? 'active' : '' }}"
                 href="{{ route('users.index') }}">
                <x-fas-users class="{{ request()->routeIs('users.*') ? 'text-white' : 'text-primary' }}"
                             style="width: 20px" />
                {{ __('Members') }}
              </a>
              {{-- Photos --}}
              <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->routeIs('albums.*') ? 'active' : '' }}"
                 href="{{ route('albums.index') }}">
                <x-fas-images class="{{ request()->routeIs('albums.*') ? 'text-white' : 'text-primary' }}"
                              style="width: 20px" />
                {{ __('Photos') }}
              </a>
              {{-- Documents --}}
              <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->routeIs('documents.*') ? 'active' : '' }}"
                 href="{{ route('documents.index') }}">
                <x-fas-folder-open class="{{ request()->routeIs('documents.*') ? 'text-white' : 'text-primary' }}"
                                   style="width: 20px" />
                {{ __('Documents') }}
              </a>
              {{-- Profile --}}
              <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                 href="{{ route('profile.index') }}">
                <x-fas-user-circle class="{{ request()->routeIs('profile.*') ? 'text-white' : 'text-primary' }}"
                                   style="width: 20px" />
                {{ __('Profile') }}
              </a>
              {{-- Logout --}}
              <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <x-fas-sign-out-alt class="text-primary" style="width: 20px" />
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
