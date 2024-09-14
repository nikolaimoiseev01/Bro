<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="/fonts/fonts.css">

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/scss/portal.scss', 'resources/js/app.js'])
</head>
<body class="antialiased">

<div class="min-h-screen flex flex-col">
    <livewire:components.header/>

    <!-- Page Content -->
    <main class="main_content_wrap relative overflow-hidden">
        <livewire:components.account.add-track/>
        <div class="flex flex-row gap-16 content">
            <livewire:components.account.menu/>
            <div class="flex-1 relative">
                {{ $slot }}
            </div>
        </div>
    </main>

    <livewire:components.bottom-player/>
    <livewire:components.footer/>

    <script>

    </script>

    @stack('script')

</div>

<script>
    function toast(param) {
        var notyf = new Notyf();
        notyf.open({
            ripple: false,
            duration: 200000,
            position: {
                x: 'center',
                y: 'bottom'
            },
            type: param.type,
            message: param.message
        });
    }
</script>
@if(session('toast'))
    <script>
        toast(@json(session('toast')))
    </script>
@endif


</body>
</html>
