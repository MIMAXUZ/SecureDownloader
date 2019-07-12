<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="{{ asset('theme/img/fav.png') }}" />

    <!-- Title -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="{{ asset('theme/fonts/style.css') }}" />
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('theme/css/main.css') }}" />
  </head>

  <body>

    <!-- Loading starts -->
    <div id="loading-wrapper">
      <div class="spinner-border text-apex-green" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <!-- Loading ends -->

    @include('layouts.navbar')
    @yield('content')

    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('theme/js/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/js/nav.min.js') }}"></script>
    <script src="{{ asset('theme/js/moment.js') }}"></script>
    <!-- Main Js Required -->
    <script src="{{ asset('theme/js/file_upload.js') }}"></script>
    <script src="{{ asset('theme/js/main.js') }}"></script>

  </body>

</html>