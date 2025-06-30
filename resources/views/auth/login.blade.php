<x-layout.main>

  <div class="container my-5">

    <div class="card border border-light-subtle shadow mx-auto" style="width: 320px">
      <div class="card-header text-center text-primary fs-5 fw-semibold bg-body border-0">
        {{ __('Login') }}
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
          @csrf

          {{-- Email --}}
          <x-common.inputField name="email"
                               label="{{ __('Email Address') }}"
                               type="email"
                               value="{{ old('email') }}"
                               autocomplete="email"
                               autofocus={{ true }}
                               error="{{ $errors->first('email') }}" />

          {{-- Password --}}
          <x-common.inputField name="password"
                               label="{{ __('Password') }}"
                               type="password"
                               error="{{ $errors->first('password') }}" />

          {{-- Remember me --}}
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember"
                     {{ old('remember') ? 'checked' : '' }}>

              <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
              </label>
            </div>
          </div>

          {{-- Submit --}}
          <div class="mb-0">
            <button type="submit" class="btn btn-primary w-100 mt-4">
              {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
              <a class="btn btn-link text-center w-100 mt-1" href="{{ route('password.request') }}">
                <small>{{ __('Forgot Your Password?') }}</small>
              </a>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>

</x-layout.main>
