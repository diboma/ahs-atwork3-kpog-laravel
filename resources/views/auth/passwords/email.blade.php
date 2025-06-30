<x-layout.main>
  <div class="container my-5">

    <div class="card border border-light-subtle shadow mx-auto" style="width: 320px">
      <div class="card-header text-center text-primary fs-5 fw-semibold bg-body border-0">
        {{ __('Reset Password') }}
      </div>

      <div class="card-body">
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
          @csrf

          <div class="mb-3">
            <label for="email" class="form-label">
              {{ __('Email Address') }} <span class="text-danger">*</span>
            </label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="mb-0">
            <button type="submit" class="btn btn-primary w-100 mt-4">
              {{ __('Send Password Reset Link') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-layout.main>
