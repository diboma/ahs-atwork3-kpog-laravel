<x-layout.main>

  <div class="container my-4">

    <h1 class="mb-4 text-center">{{ __('Edit profile') }}</h1>

    <div class="card border border-light-subtle shadow mx-auto" style="width: 375px">

      <div class="card-body">
        <form method="post"
              action="{{ route('profile.update') }}"
              enctype="multipart/form-data">
          @method('put')
          @csrf

          {{-- First name --}}
          <x-common.inputField name="firstname"
                               label="{{ __('First name') }}"
                               value="{{ old('firstname') ?? $user->firstname }}"
                               autocomplete="given-name"
                               autofocus
                               error="{{ $errors->first('firstname') }}" />

          {{-- Last name --}}
          <x-common.inputField name="lastname"
                               label="{{ __('Last name') }}"
                               value="{{ old('lastname') ?? $user->lastname }}"
                               autocomplete="family-name"
                               error="{{ $errors->first('lastname') }}" />

          {{-- Email --}}
          <x-common.inputField name="email"
                               label="{{ __('Email') }}"
                               type="email"
                               value="{{ old('email') ?? $user->email }}"
                               autocomplete="email"
                               error="{{ $errors->first('email') }}" />

          {{-- Avatar --}}
          <x-common.inputField type="file"
                               accept="image/jpeg, image/png, image/jpg, image/svg"
                               name="avatar"
                               label="{{ __('Avatar') }}"
                               required="{{ false }}"
                               error="{{ $errors->first('avatar') }}"
                               helperText="{{ __('Leave empty if you do not want to change your avatar.') }}" />

          {{-- Submit --}}
          <button type="submit" class="btn btn-primary w-100 mt-3">
            {{ __('Save') }}
          </button>

          {{-- Cancel --}}
          <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary w-100 mt-3">
            {{ __('Cancel') }}
          </a>

      </div>
    </div>
  </div>
</x-layout.main>
