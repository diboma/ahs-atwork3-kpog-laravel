<x-layout.main>
  <div class="container my-5">

    <div class="card border border-light-subtle shadow mx-auto" style="width: 320px">
      <div class="card-header text-center text-primary fs-5 fw-semibold bg-body border-0">
        {{ __('Register') }}
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
          @csrf

          {{-- First name --}}
          <x-common.inputField name="firstname"
                               label="{{ __('First name') }}"
                               value="{{ old('firstname') }}"
                               autocomplete="given-name"
                               autofocus={{ true }}
                               error="{{ $errors->first('firstname') }}" />

          {{-- Last name --}}
          <x-common.inputField name="lastname"
                               label="{{ __('Last name') }}"
                               value="{{ old('lastname') }}"
                               autocomplete="family-name"
                               error="{{ $errors->first('lastname') }}" />

          {{-- Email --}}
          <x-common.inputField name="email"
                               label="{{ __('Email Address') }}"
                               type="email"
                               value="{{ old('email') }}"
                               autocomplete="email"
                               error="{{ $errors->first('email') }}" />

          {{-- Password --}}
          <x-common.inputField name="password"
                               label="{{ __('Password') }}"
                               type="password"
                               autocomplete="new-password"
                               error="{{ $errors->first('password') }}" />

          {{-- Confirm password --}}
          <x-common.inputField name="password_confirmation"
                               label="{{ __('Confirm Password') }}"
                               type="password"
                               autocomplete="new-password"
                               error="{{ $errors->first('password_confirmation') }}" />

          {{-- Submit --}}
          <div class="mb-0">
            <button type="submit" class="btn btn-primary w-100 mt-4">
              {{ __('Register') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-layout.main>
