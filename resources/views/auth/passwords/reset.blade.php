<x-layout.main>
  <div class="container my-5">

    <div class="card border border-light-subtle shadow mx-auto" style="width: 320px">
      <div class="card-header text-center text-primary fs-5 fw-semibold bg-body border-0">
        {{ __('Reset Password') }}
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('password.update') }}">
          @method('PUT')
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          <div class="mb-3">
            <label for="email" class="form-label">
              {{ __('Email Address') }} <span class="text-danger">*</span>
            </label>
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ $email ?? old('email') }}"
                   required
                   autocomplete="email">

            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">
              {{ __('Password') }} <span class="text-danger">*</span>
            </label>
            <input type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   id="password"
                   name="password"
                   required
                   autocomplete="new-password"
                   autofocus>

            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password_confirmation"
                   class="form-label">
              {{ __('Confirm Password') }} <span class="text-danger">*</span>
            </label>
            <input type="password"
                   class="form-control"
                   id="password_confirmation"
                   name="password_confirmation"
                   required
                   autocomplete="new-password">
          </div>

          <div class="mb-0">
            <button type="submit" class="btn btn-primary w-100 mt-4">
              {{ __('Reset Password') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-layout.main>
