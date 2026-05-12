<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-100 min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="fixed left-0 top-0 w-64 h-full bg-slate-900 text-white p-6">

        <h2 class="text-3xl font-bold mb-10">
            FoodLink
        </h2>

        <nav class="space-y-4">

            <a href="/admin/dashboard"
               class="block px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                Dashboard

            </a>

            <a href="/admin/products"
               class="block px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                Productos

            </a>

            <a href="/admin/orders"
               class="block px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                Pedidos

            </a>

        </nav>

    </aside>

    {{-- CONTENT --}}
    <main class="ml-64">

        @yield('content')

    </main>

</body>

</html>