<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Z Shop' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-slate-200 dark:bg-slate-700 flex flex-col min-h-screen">
        @livewire('partials.navbar')
        <main class="flex-1 container mx-auto">
            {{ $slot }}
        </main>
        
        @livewire('partials.footer')
        @livewireScripts
    </body>
</html>
