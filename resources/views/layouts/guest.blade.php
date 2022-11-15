<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/intlTelInput.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @livewireStyles
</head>

<body class="h-screen overflow-hidden">
    {{-- padding is passed in the slot if the view requires some padding --}}
    <div class="p-{{ $padding }} grid grid-cols-8 place-items-start font-sans antialiased h-full bg-gray-100 gap-2">
        {{ $slot }}
    </div>
    @livewireScripts
</body>

</html>
