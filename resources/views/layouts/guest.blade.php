<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Prasi')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/icon.jpg') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/icon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-brand-sand text-brand-navy">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-9 h-9 bg-brand-radial flex items-center justify-center">
            <span class="text-xl tracking-widest font-semibold text-brand-gold">PRASI</span>
         </div>

        {{-- Slot (isi halaman) --}}
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
    @stack('scripts')
</body>
</html>
