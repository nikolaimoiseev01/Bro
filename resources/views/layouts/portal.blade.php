<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/fonts/fonts.css">

    <!-- JS Libraries -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @stack('styles')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <livewire:components.header />
    <!-- Page Content -->
    <main class="main_content_wrap"
          x-data="{ mainPage: true }"
          x-init="if (window.location.pathname != '/') { mainPage = false; }"
          :class="{ 'main_page': mainPage }"
    >
        {{ $slot }}
    </main>

    <livewire:components.bottom-player />
    <livewire:components.footer />

@stack('script')
</body>
</html>
