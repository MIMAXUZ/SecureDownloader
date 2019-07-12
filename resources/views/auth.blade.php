<!doctype html>
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

        <!-- Title {{ asset('theme/') }} -->
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}" />

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('theme/css/main.css') }}" />

    </head>

    <body class="authentication">
        @yield('content')
    </body>

</html>