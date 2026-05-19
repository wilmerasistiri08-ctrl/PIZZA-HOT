<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FoodLink</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="min-h-screen text-white antialiased">

    {{-- BACKGROUND GLOBAL --}}
    <div class="fixed inset-0 -z-50 overflow-hidden">

        {{-- BASE --}}
        <div class="absolute inset-0 bg-slate-950"></div>

        {{-- GLOW TOP --}}
        <div
            class="absolute top-0 left-0 w-[600px] h-[600px]
                   bg-orange-500/20 rounded-full blur-3xl">
        </div>

        {{-- GLOW BOTTOM --}}
        <div
            class="absolute bottom-0 right-0 w-[500px] h-[500px]
                   bg-pink-500/20 rounded-full blur-3xl">
        </div>

        {{-- GRID --}}
        <div class="absolute inset-0 opacity-[0.04]"
             style="
                background-image:
                linear-gradient(to right, white 1px, transparent 1px),
                linear-gradient(to bottom, white 1px, transparent 1px);
                background-size: 60px 60px;
             ">
        </div>

    </div>

    {{-- CONTENT --}}
    <main class="relative z-10">

        @yield('content')

    </main>

</body>

</html>