<x-layout.main>
  <div class="container my-5">

    <div class="card border border-light-subtle shadow mx-auto" style="width: 320px">
      <div class="card-header text-center text-primary fs-5 fw-semibold bg-body border-0">
        {{ __('Confirm Password') }}
      </div>

      <div class="card-body">
        {{ __('Please confirm your password before continuing.') }}

        <form method="POST" action="{{ route('password.confirm') }}">
          @csrf

          <div class="mb-3">
            <label for="password" class="form-label">
              {{ __('Password') }} <span class="text-danger">*</span>
            </label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password">

            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="mb-0">
            <button type="submit" class="btn btn-primary w-100 mt-4">
              {{ __('Confirm Password') }}
            </button>

            @if (Route::has('password.request'))
              <a class="btn btn-link text-center w-100 mt-1" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
              </a>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>
</x-layout.main>
