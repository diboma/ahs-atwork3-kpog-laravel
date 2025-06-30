<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ isset($title) ? $title . ' | ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Icons -->
  <link rel="icon" type="image/svg+xml" href="{{ url('icons/favicon.svg') }}" />
  <link rel="icon" type="image/png" href="{{ url('icons/favicon-96x96.png') }}" sizes="96x96" />
  <meta name="apple-mobile-web-app-title" content="KPOG" />
  <link rel="apple-touch-icon" sizes="180x180" href="{{ url('icons/apple-touch-icon.png') }}" />
  <link rel="manifest" href="{{ url('site.webmanifest') }}" />

  <!-- Styles / Scripts -->
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  @endif
</head>

<body class="bg-light min-vh-100 d-flex flex-column">
  @include('partials.navbar')

  @if (request()->routeIs('home'))
    <x-common.hero image="{{ url('logo.png') }}"
                   imageWidth="300" />
  @endif

  <main>
    <x-common.alerts />
    {{ $slot }}
  </main>

  @include('partials.footer')
</body>

</html>
