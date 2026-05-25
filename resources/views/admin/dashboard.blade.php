@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-teal-100 via-cyan-50 to-emerald-100">

    {{-- =========================================================
    BARRA SUPERIOR HORIZONTAL AGREGADA (ARRIBA DE TODO)
    ========================================================= --}}
    <div class="bg-white border-b border-teal-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-3">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">🍕</span>
                    <div>
                        <h1 class="text-lg font-bold text-gray-800">FoodLink</h1>
                        <p class="text-xs text-gray-400">TikTok Ordering Platform</p>
                    </div>
                </div>
                <nav class="flex flex-wrap items-center gap-4 text-sm">
                    <a href="#" class="text-gray-600 hover:text-teal-600 transition">Inicio</a>
                    <a href="#" class="text-gray-600 hover:text-teal-600 transition">Partners</a>
                    <a href="#" class="text-gray-600 hover:text-teal-600 transition">Registrar negocio</a>
                    <a href="/admin/dashboard" class="text-teal-600 font-semibold transition">Dashboard</a>
                    <a href="#" class="text-gray-600 hover:text-teal-600 transition">Salir</a>
                </nav>
                <div class="w-8 h-8 bg-teal-500 rounded-full flex items-center justify-center text-white text-sm font-bold">A</div>
            </div>
        </div>
    </div>

    {{-- SIDEBAR + CONTENIDO --}}
    <div class="flex">

        {{-- SIDEBAR ROJO/NARANJA --}}
        <aside class="hidden lg:flex flex-col w-72 min-h-screen bg-gradient-to-b from-red-700 to-orange-700 text-white p-6 shadow-2xl">

            {{-- LOGO CON IMAGEN ROTATIVA 3D --}}
            <div class="mb-10 text-center">

                <div class="flex justify-center mb-3">
                    <div class="relative w-28 h-28">
                        <div class="absolute inset-0 rounded-full border-4 border-yellow-400/50 animate-spin-slow"></div>
                        <div class="absolute inset-2 rounded-full border-2 border-orange-400/30 animate-spin-slow-reverse"></div>
                        
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-7xl cursor-pointer transform transition-all duration-300 hover:scale-125" id="rotatingFoodIcon" style="filter: drop-shadow(0 0 15px rgba(255,215,0,0.5));">
                                🍕
                            </div>
                        </div>
                    </div>
                </div>

                <h1 class="text-3xl font-black tracking-tight bg-gradient-to-r from-yellow-400 to-orange-200 bg-clip-text text-transparent">
                    FoodLink
                </h1>

                <p class="text-orange-200 text-sm mt-1 font-semibold">
                    Panel Administrativo
                </p>

            </div>

            {{-- MENU --}}
            <nav class="flex flex-col gap-2">

                <a href="/admin/dashboard"
                   class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 transition-all duration-300 px-5 py-4 rounded-xl font-bold flex items-center gap-3 shadow-lg transform hover:scale-105">

                    <span class="text-2xl">📊</span> Panel de Control

                </a>

                <a href="/admin/products"
                   class="hover:bg-white/20 transition-all duration-300 px-5 py-4 rounded-xl font-semibold flex items-center gap-3">

                    <span class="text-2xl">🍔</span> Productos

                </a>

                <a href="/admin/orders"
                   class="hover:bg-white/20 transition-all duration-300 px-5 py-4 rounded-xl font-semibold flex items-center gap-3">

                    <span class="text-2xl">🧾</span> Pedidos

                </a>

                <a href="#"
                   class="hover:bg-white/20 transition-all duration-300 px-5 py-4 rounded-xl font-semibold flex items-center gap-3">

                    <span class="text-2xl">⚙️</span> Configuración

                </a>

            </nav>

            {{-- FOOTER --}}
            <div class="mt-auto pt-10">

                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 border-2 border-yellow-400/30">

                    <div class="text-sm text-orange-200 mb-2 font-semibold">
                        🍽 Estado del negocio
                    </div>

                    <div class="flex items-center gap-3">

                        <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>

                        <div class="font-bold text-yellow-300">
                            ¡Abierto! 🎉
                        </div>

                    </div>

                </div>

            </div>

        </aside>

        {{-- CONTENIDO PRINCIPAL --}}
        <main class="flex-1">

            {{-- HEADER ROJO/BLANCO --}}
            <header class="bg-white/95 backdrop-blur-md border-b-4 border-orange-500 px-8 py-6 sticky top-0 z-40 shadow-lg">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>

                        <h2 class="text-4xl font-black bg-gradient-to-r from-red-600 to-orange-600 bg-clip-text text-transparent">
                            🍔 PANEL DE CONTROL
                        </h2>

                        <p class="text-gray-600 mt-1 font-medium">
                            Resumen general de tu negocio de comida
                        </p>

                    </div>

                    <div class="flex gap-3">

                        <button class="bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 transition-all duration-300 text-white px-8 py-3 rounded-xl font-bold shadow-lg transform hover:scale-105 flex items-center gap-2">

                            <span class="text-xl">➕</span> Nuevo Producto

                        </button>

                    </div>

                </div>

            </header>

            {{-- CONTENIDO --}}
            <div class="p-8">

                {{-- SELECTOR DE FECHAS RÁPIDAS --}}
                <div class="flex flex-wrap gap-2 mb-6">
                    <button class="px-4 py-2 bg-white border border-orange-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white transition">Hoy</button>
                    <button class="px-4 py-2 bg-white border border-orange-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white transition">Esta semana</button>
                    <button class="px-4 py-2 bg-orange-500 text-white border border-orange-500 rounded-xl text-sm font-medium shadow-md">Este mes</button>
                    <button class="px-4 py-2 bg-white border border-orange-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white transition">Últimos 3 meses</button>
                    <button class="px-4 py-2 bg-white border border-orange-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-orange-500 hover:text-white transition">Este año</button>
                </div>

                {{-- CARDS ROJO/NARANJA/AMARILLO --}}
                <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

                    {{-- VENTAS --}}
                    <div class="bg-gradient-to-br from-white to-orange-50 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-8 border-red-500">

                        <div class="flex items-center justify-between mb-5">

                            <div class="text-red-600 font-black uppercase text-xs tracking-wider">
                                💵 Ventas Totales
                            </div>

                            <div class="text-5xl bg-gradient-to-br from-yellow-400 to-orange-500 p-3 rounded-2xl shadow-lg">
                                💰
                            </div>

                        </div>

                        <div class="text-4xl font-black text-gray-800 mb-2">
                            Bs 4,520
                        </div>

                        <div class="text-green-600 text-sm font-bold flex items-center gap-1">
                            <span class="text-xl">▲</span> +18% este mes
                        </div>

                    </div>

                    {{-- PEDIDOS --}}
                    <div class="bg-gradient-to-br from-white to-orange-50 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-8 border-orange-500">

                        <div class="flex items-center justify-between mb-5">

                            <div class="text-orange-600 font-black uppercase text-xs tracking-wider">
                                🧾 Pedidos
                            </div>

                            <div class="text-5xl bg-gradient-to-br from-yellow-400 to-orange-500 p-3 rounded-2xl shadow-lg">
                                🍽️
                            </div>

                        </div>

                        <div class="text-4xl font-black text-gray-800 mb-2">
                            128
                        </div>

                        <div class="text-green-600 text-sm font-bold flex items-center gap-1">
                            <span class="text-xl">▲</span> +9 nuevos hoy
                        </div>

                    </div>

                    {{-- PRODUCTOS --}}
                    <div class="bg-gradient-to-br from-white to-orange-50 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-8 border-yellow-500">

                        <div class="flex items-center justify-between mb-5">

                            <div class="text-yellow-700 font-black uppercase text-xs tracking-wider">
                                🍔 Productos
                            </div>

                            <div class="text-5xl bg-gradient-to-br from-yellow-400 to-orange-500 p-3 rounded-2xl shadow-lg">
                                🍕
                            </div>

                        </div>

                        <div class="text-4xl font-black text-gray-800 mb-2">
                            32
                        </div>

                        <div class="text-red-500 text-sm font-bold flex items-center gap-1">
                            <span class="text-xl">⚠️</span> 5 agotados
                        </div>

                    </div>

                    {{-- CONVERSIÓN --}}
                    <div class="bg-gradient-to-br from-white to-orange-50 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-8 border-red-500">

                        <div class="flex items-center justify-between mb-5">

                            <div class="text-red-600 font-black uppercase text-xs tracking-wider">
                                📈 Conversión
                            </div>

                            <div class="text-5xl bg-gradient-to-br from-yellow-400 to-orange-500 p-3 rounded-2xl shadow-lg">
                                🎯
                            </div>

                        </div>

                        <div class="text-4xl font-black text-gray-800 mb-2">
                            32%
                        </div>

                        <div class="text-orange-600 text-sm font-bold flex items-center gap-1">
                            <span class="text-xl">🔥</span> ¡Excelente!
                        </div>

                    </div>

                </div>

                {{-- GRÁFICO DE VENTAS --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-orange-200 mb-8">
                    <div class="p-6 bg-gradient-to-r from-red-50 via-orange-50 to-yellow-50 border-b-4 border-orange-400">
                        <h3 class="text-2xl font-black text-gray-800 flex items-center gap-2">
                            <span class="text-3xl">📈</span> Ventas de la semana
                        </h3>
                        <p class="text-gray-600 text-sm mt-1">Comparativa de ventas de los últimos 7 días</p>
                    </div>
                    <div class="p-6">
                        <div class="flex items-end gap-3 h-48">
                            <div class="flex-1 flex flex-col items-center gap-2">
                                <div class="w-full bg-gradient-to-t from-red-500 to-orange-500 rounded-lg" style="height: 120px;"></div>
                                <span class="text-sm text-gray-600">Lun</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2">
                                <div class="w-full bg-gradient-to-t from-red-500 to-orange-500 rounded-lg" style="height: 80px;"></div>
                                <span class="text-sm text-gray-600">Mar</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2">
                                <div class="w-full bg-gradient-to-t from-red-500 to-orange-500 rounded-lg" style="height: 150px;"></div>
                                <span class="text-sm text-gray-600">Mié</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2">
                                <div class="w-full bg-gradient-to-t from-red-500 to-orange-500 rounded-lg" style="height: 200px;"></div>
                                <span class="text-sm text-gray-600">Jue</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2">
                                <div class="w-full bg-gradient-to-t from-red-500 to-orange-500 rounded-lg" style="height: 170px;"></div>
                                <span class="text-sm text-gray-600">Vie</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2">
                                <div class="w-full bg-gradient-to-t from-red-500 to-orange-500 rounded-lg" style="height: 250px;"></div>
                                <span class="text-sm text-gray-600">Sáb</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2">
                                <div class="w-full bg-gradient-to-t from-red-500 to-orange-500 rounded-lg" style="height: 90px;"></div>
                                <span class="text-sm text-gray-600">Dom</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TABLA DE PEDIDOS --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-orange-200 mb-8">

                    {{-- HEADER TABLA --}}
                    <div class="flex items-center justify-between p-6 bg-gradient-to-r from-red-50 via-orange-50 to-yellow-50 border-b-4 border-orange-400">

                        <div>

                            <h3 class="text-2xl font-black text-gray-800 flex items-center gap-2">
                                <span class="text-3xl">🕒</span> Últimos pedidos
                            </h3>

                            <p class="text-gray-600 text-sm mt-1 font-medium">
                                Pedidos recientes realizados por clientes hambrientos 🍽️
                            </p>

                        </div>

                        <button class="bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 transition-all duration-300 text-white px-6 py-3 rounded-xl font-bold shadow-md flex items-center gap-2">

                            <span class="text-xl">👁️</span> Ver todos

                        </button>

                    </div>

                    {{-- TABLA --}}
                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-gradient-to-r from-red-100 via-orange-100 to-yellow-100">

                                <tr>

                                    <th class="text-left px-6 py-4 text-red-800 font-black text-sm uppercase tracking-wider">
                                        🧑‍🍳 Cliente
                                    </th>

                                    <th class="text-left px-6 py-4 text-red-800 font-black text-sm uppercase tracking-wider">
                                        🍽️ Pedido
                                    </th>

                                    <th class="text-left px-6 py-4 text-red-800 font-black text-sm uppercase tracking-wider">
                                        💵 Total
                                    </th>

                                    <th class="text-left px-6 py-4 text-red-800 font-black text-sm uppercase tracking-wider">
                                        📊 Estado
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                {{-- FILA 1 --}}
                                <tr class="border-t border-orange-100 hover:bg-orange-50 transition-all duration-200 cursor-pointer">

                                    <td class="px-6 py-5">

                                        <div>

                                            <div class="font-black text-gray-800 text-lg">
                                                Juan Pérez
                                            </div>

                                            <div class="text-gray-500 text-sm">
                                                📞 +591 77777777
                                            </div>

                                        </div>

                                    </td>

                                    <td class="px-6 py-5">

                                        <div class="font-bold text-gray-700">
                                            🍔 Hamburguesa Clásica x2
                                        </div>

                                        <div class="text-xs text-orange-600 mt-1">
                                            🔥 Extra queso
                                        </div>

                                    </tr>

                                    <td class="px-6 py-5 font-black text-red-600 text-xl">

                                        Bs 50

                                    </td>

                                    <td class="px-6 py-5">

                                        <span class="bg-yellow-400 text-yellow-900 px-4 py-2 rounded-xl text-sm font-black flex items-center gap-1 w-fit">
                                            ⏳ Pendiente
                                        </span>

                                    </td>

                                </tr>

                                {{-- FILA 2 --}}
                                <tr class="border-t border-orange-100 hover:bg-orange-50 transition-all duration-200 cursor-pointer">

                                    <td class="px-6 py-5">

                                        <div>

                                            <div class="font-black text-gray-800 text-lg">
                                                María López
                                            </div>

                                            <div class="text-gray-500 text-sm">
                                                📞 +591 71234567
                                            </div>

                                        </div>

                                    </td>

                                    <td class="px-6 py-5">

                                        <div class="font-bold text-gray-700">
                                            🍕 Pizza Familiar
                                        </div>

                                        <div class="text-xs text-orange-600 mt-1">
                                            🌶️ Extra pepperoni
                                        </div>

                                    </td>

                                    <td class="px-6 py-5 font-black text-red-600 text-xl">

                                        Bs 85

                                    </td>

                                    <td class="px-6 py-5">

                                        <span class="bg-green-500 text-white px-4 py-2 rounded-xl text-sm font-black flex items-center gap-1 w-fit">
                                            ✅ Entregado
                                        </span>

                                    </td>

                                </tr>

                                {{-- FILA 3 --}}
                                <tr class="border-t border-orange-100 hover:bg-orange-50 transition-all duration-200 cursor-pointer">

                                    <td class="px-6 py-5">

                                        <div>

                                            <div class="font-black text-gray-800 text-lg">
                                                Carlos Rodríguez
                                            </div>

                                            <div class="text-gray-500 text-sm">
                                                📞 +591 79876543
                                            </div>

                                        </div>

                                    </td>

                                    <td class="px-6 py-5">

                                        <div class="font-bold text-gray-700">
                                            🌮 Tacos al Pastor x3
                                        </div>

                                        <div class="text-xs text-orange-600 mt-1">
                                            🧅 Con cebolla y cilantro
                                        </div>

                                    </td>

                                    <td class="px-6 py-5 font-black text-red-600 text-xl">

                                        Bs 45

                                    </td>

                                    <td class="px-6 py-5">

                                        <span class="bg-orange-500 text-white px-4 py-2 rounded-xl text-sm font-black flex items-center gap-1 w-fit">
                                            🚚 En camino
                                        </span>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

                {{-- PRODUCTOS MÁS VENDIDOS Y TOP CLIENTES --}}
                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    
                    {{-- PRODUCTOS MÁS VENDIDOS --}}
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-orange-200">
                        <div class="p-5 bg-gradient-to-r from-red-50 via-orange-50 to-yellow-50 border-b-4 border-orange-400">
                            <h3 class="text-xl font-black text-gray-800 flex items-center gap-2">
                                <span class="text-2xl">🔥</span> Productos más vendidos
                            </h3>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <div class="p-4 flex items-center justify-between hover:bg-orange-50 transition">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🍔</span>
                                    <div>
                                        <p class="font-bold text-gray-800">Hamburguesa Clásica</p>
                                        <p class="text-xs text-gray-400">245 unidades</p>
                                    </div>
                                </div>
                                <span class="text-lg font-bold text-red-600">Bs 11,025</span>
                            </div>
                            <div class="p-4 flex items-center justify-between hover:bg-orange-50 transition">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🍕</span>
                                    <div>
                                        <p class="font-bold text-gray-800">Pizza Pepperoni</p>
                                        <p class="text-xs text-gray-400">189 unidades</p>
                                    </div>
                                </div>
                                <span class="text-lg font-bold text-red-600">Bs 16,065</span>
                            </div>
                            <div class="p-4 flex items-center justify-between hover:bg-orange-50 transition">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🌮</span>
                                    <div>
                                        <p class="font-bold text-gray-800">Tacos al Pastor</p>
                                        <p class="text-xs text-gray-400">156 unidades</p>
                                    </div>
                                </div>
                                <span class="text-lg font-bold text-red-600">Bs 7,020</span>
                            </div>
                        </div>
                    </div>

                    {{-- TOP CLIENTES --}}
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-orange-200">
                        <div class="p-5 bg-gradient-to-r from-red-50 via-orange-50 to-yellow-50 border-b-4 border-orange-400">
                            <h3 class="text-xl font-black text-gray-800 flex items-center gap-2">
                                <span class="text-2xl">👑</span> Top Clientes
                            </h3>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <div class="p-4 flex items-center justify-between hover:bg-orange-50 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-full flex items-center justify-center text-white font-bold">1</div>
                                    <div>
                                        <p class="font-bold text-gray-800">Juan Pérez</p>
                                        <p class="text-xs text-gray-400">12 pedidos</p>
                                    </div>
                                </div>
                                <span class="text-lg font-bold text-red-600">Bs 1,250</span>
                            </div>
                            <div class="p-4 flex items-center justify-between hover:bg-orange-50 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center text-white font-bold">2</div>
                                    <div>
                                        <p class="font-bold text-gray-800">María López</p>
                                        <p class="text-xs text-gray-400">9 pedidos</p>
                                    </div>
                                </div>
                                <span class="text-lg font-bold text-red-600">Bs 980</span>
                            </div>
                            <div class="p-4 flex items-center justify-between hover:bg-orange-50 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-amber-600 to-amber-700 rounded-full flex items-center justify-center text-white font-bold">3</div>
                                    <div>
                                        <p class="font-bold text-gray-800">Carlos Rodríguez</p>
                                        <p class="text-xs text-gray-400">7 pedidos</p>
                                    </div>
                                </div>
                                <span class="text-lg font-bold text-red-600">Bs 670</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- NOTIFICACIONES RECIENTES --}}
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl p-5 border border-orange-200 mb-8">
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white text-xl animate-pulse">🔔</div>
                            <div>
                                <p class="font-bold text-gray-800">¡Nuevo pedido!</p>
                                <p class="text-sm text-gray-500">Juan Pérez acaba de realizar un pedido</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400">Hace 2 minutos</span>
                    </div>
                    <div class="border-t border-orange-200 my-3"></div>
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center text-white text-xl">✅</div>
                            <div>
                                <p class="font-bold text-gray-800">Pedido entregado</p>
                                <p class="text-sm text-gray-500">Pedido #128 entregado con éxito</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400">Hace 15 minutos</span>
                    </div>
                    <div class="border-t border-orange-200 my-3"></div>
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center text-white text-xl">⭐</div>
                            <div>
                                <p class="font-bold text-gray-800">Nueva reseña</p>
                                <p class="text-sm text-gray-500">⭐⭐⭐⭐⭐ "Excelente servicio"</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400">Hace 1 hora</span>
                    </div>
                </div>

                {{-- BANNER PROMOCIONAL --}}
                <div class="mt-8 bg-gradient-to-r from-red-600 via-orange-500 to-yellow-500 rounded-2xl p-6 shadow-xl">

                    <div class="flex items-center justify-between flex-wrap gap-4">

                        <div class="flex items-center gap-4">

                            <div class="text-6xl">
                                🎉
                            </div>

                            <div>

                                <h4 class="text-2xl font-black text-white">
                                    ¡Promoción Especial!
                                </h4>

                                <p class="text-yellow-100 font-semibold">
                                    20% de descuento en pedidos mayores a Bs 100
                                </p>

                            </div>

                        </div>

                        <button class="bg-white text-red-600 px-6 py-3 rounded-xl font-black shadow-lg hover:scale-105 transition-all duration-300">

                            Aprovechar Oferta 🚀

                        </button>

                    </div>

                </div>

            </div>

        </main>

    </div>

</div>

{{-- BOTÓN FLOTANTE DE AYUDA --}}
<div class="fixed bottom-6 right-6 z-50">
    <button class="w-14 h-14 bg-gradient-to-r from-red-500 to-orange-500 rounded-full shadow-2xl hover:scale-110 transition-all duration-300 flex items-center justify-center text-white text-2xl animate-bounce">
        💬
    </button>
</div>

{{-- SCRIPT PARA EFECTO 3D CIRCULAR --}}
<script>
    const foodItems = ['🍕', '🍜', '🍟', '🍔'];
    let currentIndex = 0;
    const iconElement = document.getElementById('rotatingFoodIcon');

    function rotateFoodIcon3D() {
        currentIndex = (currentIndex + 1) % foodItems.length;
        
        iconElement.style.transform = 'rotateY(180deg) scale(0.5)';
        iconElement.style.opacity = '0';
        
        setTimeout(() => {
            iconElement.textContent = foodItems[currentIndex];
            iconElement.style.transform = 'rotateY(360deg) scale(1.2)';
            iconElement.style.opacity = '1';
            iconElement.style.filter = 'drop-shadow(0 0 20px rgba(255,215,0,0.8))';
            
            setTimeout(() => {
                iconElement.style.transform = 'rotateY(0deg) scale(1)';
                iconElement.style.filter = 'drop-shadow(0 0 15px rgba(255,215,0,0.5))';
            }, 300);
        }, 200);
    }

    setInterval(rotateFoodIcon3D, 2500);
</script>

<style>
    #rotatingFoodIcon {
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        display: inline-block;
        transform-style: preserve-3d;
        backface-visibility: visible;
    }
    
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    @keyframes spin-slow-reverse {
        from { transform: rotate(360deg); }
        to { transform: rotate(0deg); }
    }
    
    .animate-spin-slow {
        animation: spin-slow 4s linear infinite;
    }
    
    .animate-spin-slow-reverse {
        animation: spin-slow-reverse 3s linear infinite;
    }
    
    #rotatingFoodIcon:hover {
        transform: rotateY(180deg) scale(1.3) !important;
        filter: drop-shadow(0 0 25px rgba(255,215,0,0.9)) !important;
        cursor: pointer;
    }
</style>

@endsection