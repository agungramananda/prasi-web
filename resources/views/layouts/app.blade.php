<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Home') | Prasi</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.jpg') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/icon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icon.png') }}">


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-brand-sand text-brand-navy antialiased">
    <!-- Navigation -->
    <x-nav />

    <!-- Main Content -->
    <main class="min-h-[60vh]">
        @yield('content')
    </main>

    <x-footer />
    @stack('scripts')
</body>
</html>