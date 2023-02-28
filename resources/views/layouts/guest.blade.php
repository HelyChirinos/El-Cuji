<!DOCTYPE html>
	<!--favicon-->
	<link rel="icon" href="{{asset('assets/images/elcuji.png')}}" type="image/png" />
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'El Cují') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <!-- Scripts -->
    </head>
    <body class="bg-light font-sans antialiased">
        {{ $slot }}
    </body>
</html>