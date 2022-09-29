<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title . ' | ' . config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts
    @stack('scripts')
</head>

<body class="h-screen bg-white flex overflow-hidden">
    <livewire:components.side-bar />
    <main class="flex flex-col w-full h-screen">
        <!-- Page naviagtion -->
        <livewire:components.page-navigation :needed_roles="$needed_roles" />

        <!-- Page Content -->

        {{ $slot }}
    </main>

    @livewire('notifications')
</body>

</html>
