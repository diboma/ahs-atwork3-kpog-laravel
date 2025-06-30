@props(['user' => null, 'action'])

<div class="container mt-3">
  <div class="card border border-light-subtle shadow mx-auto" style="width: 420px">
    <div class="card-body">

      <form method="POST" action="{{ $action }}">
        @csrf

        @if ($user)
          @method('PUT')
        @endif

        {{-- First name --}}
        <x-common.inputField name="firstname"
                             label="{{ __('First name') }}"
                             value="{{ $user ? $user->firstname : old('firstname') }}"
                             autocomplete="given-name"
                             autofocus
                             error="{{ $errors->first('firstname') }}" />

        {{-- Last name --}}
        <x-common.inputField name="lastname"
                             label="{{ __('Last name') }}"
                             value="{{ $user ? $user->lastname : old('lastname') }}"
                             autocomplete="family-name"
                             error="{{ $errors->first('lastname') }}" />

        {{-- Email --}}
        <x-common.inputField name="email"
                             type="email"
                             label="{{ __('Email') }}"
                             value="{{ $user ? $user->email : old('email') }}"
                             autocomplete="email"
                             error="{{ $errors->first('email') }}" />

        {{-- Password --}}
        <x-common.inputField name="password"
                             type="password"
                             label="{{ __('Password') }}"
                             type="password"
                             required="{{ isset($user) ? false : true }}"
                             helperText="{{ isset($user) ? __('Leave empty if you do not want to change the password.') : null }}" />

        {{-- Password confirmation --}}
        <x-common.inputField name="password_confirmation"
                             label="{{ __('Confirm password') }}"
                             type="password"
                             required="{{ isset($user) ? false : true }}" />

        {{-- Role --}}
        <div class="mb-3">
          <label for="role" class="form-label">{{ __('Role') }} <span class="text-danger">*</span></label>
          <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">
            <option value="">{{ __('Pick a role') }}</option>
            <option value="user"
                    {{ (isset($user) && $user->role == 'user') || old('role') == 'user' ? 'selected' : '' }}>
              {{ __('User') }}
            </option>
            <option value="editor"
                    {{ (isset($user) && $user->role == 'editor') || old('role') == 'editor' ? 'selected' : '' }}>
              {{ __('Editor') }}
            </option>
            <option value="admin"
                    {{ (isset($user) && $user->role == 'admin') || old('role') == 'admin' ? 'selected' : '' }}>
              {{ __('Admin') }}
            </option>
          </select>

          @error('role')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        {{-- Buttons --}}
        <x-common.formButtons submitLabel="{{ $user ? __('Save') : __('Add') }}"
                              cancelRoute="{{ route('users.index') }}" />
      </form>

    </div>
  </div>
</div>
