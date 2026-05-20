<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FoodLink') }}</title>

    {{-- FONTS --}}
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap"
        rel="stylesheet"
    />

    {{-- VITE --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="font-sans antialiased bg-[#050816] text-white overflow-x-hidden">

    <div class="min-h-screen">

        {{-- NAVIGATION --}}
        @include('layouts.navigation')

        {{-- HEADER --}}
        @isset($header)

            <header class="bg-white/5 backdrop-blur-xl border-b border-white/10 shadow-lg">

                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

                    {{ $header }}

                </div>

            </header>

        @endisset

        {{-- CONTENT --}}
        <main>

            @yield('content')

        </main>

    </div>

</body>

</html>