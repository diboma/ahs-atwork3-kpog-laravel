<x-layout.main>

  <div class="container my-4">

    <h1 class="mb-4 text-center">{{ __('Your profile') }}</h1>

    <div
         class="mt-3 mb-5 d-flex flex-column justify-content-center align-items-center
                flex-md-row align-items-md-start gap-5 ">

      {{-- PROFILE --}}
      <div class="card border border-light-subtle shadow" style="width: 320px;">
        <div class="card-header text-center text-primary fs-5 fw-semibold bg-body border-0 mb-0">
          {{ __('Profile') }}
        </div>

        <div class="card-body">
          {{-- Avatar --}}
          <div class="mb-3 d-flex justify-content-center">
            <x-common.avatar :user="$user" size="medium" />
          </div>

          {{-- First name  --}}
          <div class="mb-3">
            <label for="firstname" class="form-label">{{ __('First name') }}</label>
            <input type="text" class="form-control" value="{{ $user->firstname }}" disabled>
          </div>

          {{-- Last name  --}}
          <div class="mb-3">
            <label for="lastname" class="form-label">{{ __('Last name') }}</label>
            <input type="text" class="form-control" value="{{ $user->lastname }}" disabled>
          </div>

          {{-- Email --}}
          <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
          </div>

          {{-- Edit --}}
          <a href="{{ route('profile.edit') }}" class="btn btn-primary w-100 mt-3">
            {{ __('Edit') }}
          </a>

        </div>
      </div>

      {{-- EDIT PASSWORD --}}
      <div class="card border border-light-subtle shadow" style="width: 320px;">
        <div class="card-header text-center text-primary fs-5 fw-semibold bg-body border-0 mb-0">
          {{ __('Edit password') }}
        </div>

        <div class="card-body">
          <form method="post"
                action="{{ route('profile.update.password') }}">
            @method('put')
            @csrf

            {{-- New password --}}
            <x-common.inputField name="password"
                                 label="{{ __('New password') }}"
                                 type="password"
                                 error="{{ $errors->first('password') }}" />

            {{-- Confirm password --}}
            <x-common.inputField name="password_confirmation"
                                 label="{{ __('Confirm password') }}"
                                 type="password" />

            {{-- Submit --}}
            <button type="submit"
                    class="btn btn-primary w-100 mt-3">
              {{ __('Save') }}
            </button>
          </form>

        </div>
      </div>
    </div>


  </div>
</x-layout.main>
