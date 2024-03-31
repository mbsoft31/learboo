<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cyberpunk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', "LearnBoo!") }}</title>
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<x-frontend.header :navigation="$navigation" />
<main>
    {{ $slot }}
</main>
<x-frontend.footer />

@stack('modals')
@vite(['resources/js/app.js'])
@stack('scripts')
</body>
</html>
