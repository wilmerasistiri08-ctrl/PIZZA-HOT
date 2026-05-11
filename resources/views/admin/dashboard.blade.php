@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-100">

    {{-- SIDEBAR + CONTENIDO --}}
    <div class="flex">

        {{-- SIDEBAR --}}
        <aside class="hidden lg:flex flex-col w-72 min-h-screen bg-slate-900 text-white p-6">

            {{-- LOGO --}}
            <div class="mb-10">

                <h1 class="text-3xl font-extrabold tracking-tight">
                    FoodLink
                </h1>

                <p class="text-slate-400 text-sm mt-1">
                    Panel Administrativo
                </p>

            </div>

            {{-- MENU --}}
            <nav class="flex flex-col gap-3">

                <a href="/admin/dashboard"
                   class="bg-orange-500 hover:bg-orange-600 transition px-5 py-4 rounded-2xl font-semibold flex items-center gap-3">

                    📊 Dashboard

                </a>

                <a href="/admin/products"
                   class="hover:bg-slate-800 transition px-5 py-4 rounded-2xl font-medium flex items-center gap-3">

                    🍔 Productos

                </a>

                <a href="/admin/orders"
                   class="hover:bg-slate-800 transition px-5 py-4 rounded-2xl font-medium flex items-center gap-3">

                    🧾 Pedidos

                </a>

                <a href="#"
                   class="hover:bg-slate-800 transition px-5 py-4 rounded-2xl font-medium flex items-center gap-3">

                    ⚙ Configuración

                </a>

            </nav>

            {{-- FOOTER --}}
            <div class="mt-auto pt-10">

                <div class="bg-slate-800 rounded-2xl p-5">

                    <div class="text-sm text-slate-400 mb-2">
                        Estado del negocio
                    </div>

                    <div class="flex items-center gap-3">

                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>

                        <div class="font-semibold">
                            Abierto
                        </div>

                    </div>

                </div>

            </div>

        </aside>

        {{-- CONTENIDO PRINCIPAL --}}
        <main class="flex-1">

            {{-- HEADER --}}
            <header class="bg-white border-b border-slate-200 px-6 py-5 sticky top-0 z-40">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>

                        <h2 class="text-3xl font-extrabold text-slate-900">
                            Dashboard
                        </h2>

                        <p class="text-slate-500 mt-1">
                            Resumen general del negocio
                        </p>

                    </div>

                    <div class="flex gap-3">

                        <button class="bg-black hover:bg-slate-800 transition text-white px-6 py-3 rounded-2xl font-bold">

                            + Nuevo Producto

                        </button>

                    </div>

                </div>

            </header>

            {{-- CONTENIDO --}}
            <div class="p-6">

                {{-- CARDS --}}
                <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

                    {{-- VENTAS --}}
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">

                        <div class="flex items-center justify-between mb-5">

                            <div class="text-slate-500 font-medium">
                                Ventas Totales
                            </div>

                            <div class="text-3xl">
                                💰
                            </div>

                        </div>

                        <div class="text-4xl font-extrabold text-slate-900 mb-2">
                            Bs 4,520
                        </div>

                        <div class="text-green-500 text-sm font-semibold">
                            +18% este mes
                        </div>

                    </div>

                    {{-- PEDIDOS --}}
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">

                        <div class="flex items-center justify-between mb-5">

                            <div class="text-slate-500 font-medium">
                                Pedidos
                            </div>

                            <div class="text-3xl">
                                🧾
                            </div>

                        </div>

                        <div class="text-4xl font-extrabold text-slate-900 mb-2">
                            128
                        </div>

                        <div class="text-green-500 text-sm font-semibold">
                            +9 nuevos hoy
                        </div>

                    </div>

                    {{-- PRODUCTOS --}}
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">

                        <div class="flex items-center justify-between mb-5">

                            <div class="text-slate-500 font-medium">
                                Productos
                            </div>

                            <div class="text-3xl">
                                🍔
                            </div>

                        </div>

                        <div class="text-4xl font-extrabold text-slate-900 mb-2">
                            32
                        </div>

                        <div class="text-slate-500 text-sm font-semibold">
                            5 agotados
                        </div>

                    </div>

                    {{-- CONVERSIÓN --}}
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">

                        <div class="flex items-center justify-between mb-5">

                            <div class="text-slate-500 font-medium">
                                Conversión
                            </div>

                            <div class="text-3xl">
                                📈
                            </div>

                        </div>

                        <div class="text-4xl font-extrabold text-slate-900 mb-2">
                            32%
                        </div>

                        <div class="text-green-500 text-sm font-semibold">
                            Excelente rendimiento
                        </div>

                    </div>

                </div>

                {{-- TABLA DE PEDIDOS --}}
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

                    {{-- HEADER TABLA --}}
                    <div class="flex items-center justify-between p-6 border-b border-slate-100">

                        <div>

                            <h3 class="text-2xl font-bold text-slate-900">
                                Últimos pedidos
                            </h3>

                            <p class="text-slate-500 text-sm mt-1">
                                Pedidos recientes realizados por clientes
                            </p>

                        </div>

                        <button class="bg-orange-500 hover:bg-orange-600 transition text-white px-5 py-3 rounded-2xl font-bold">

                            Ver todos

                        </button>

                    </div>

                    {{-- TABLA --}}
                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-slate-50">

                                <tr>

                                    <th class="text-left px-6 py-4 text-slate-500 font-semibold">
                                        Cliente
                                    </th>

                                    <th class="text-left px-6 py-4 text-slate-500 font-semibold">
                                        Pedido
                                    </th>

                                    <th class="text-left px-6 py-4 text-slate-500 font-semibold">
                                        Total
                                    </th>

                                    <th class="text-left px-6 py-4 text-slate-500 font-semibold">
                                        Estado
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                {{-- FILA --}}
                                <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                                    <td class="px-6 py-5">

                                        <div>

                                            <div class="font-bold text-slate-900">
                                                Juan Pérez
                                            </div>

                                            <div class="text-slate-500 text-sm">
                                                +591 77777777
                                            </div>

                                        </div>

                                    </td>

                                    <td class="px-6 py-5">

                                        <div class="font-medium text-slate-700">
                                            Hamburguesa Clásica x2
                                        </div>

                                    </td>

                                    <td class="px-6 py-5 font-bold text-slate-900">

                                        Bs 50

                                    </td>

                                    <td class="px-6 py-5">

                                        <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-bold">

                                            Pendiente

                                        </span>

                                    </td>

                                </tr>

                                {{-- FILA --}}
                                <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                                    <td class="px-6 py-5">

                                        <div>

                                            <div class="font-bold text-slate-900">
                                                María López
                                            </div>

                                            <div class="text-slate-500 text-sm">
                                                +591 71234567
                                            </div>

                                        </div>

                                    </td>

                                    <td class="px-6 py-5">

                                        <div class="font-medium text-slate-700">
                                            Pizza Familiar
                                        </div>

                                    </td>

                                    <td class="px-6 py-5 font-bold text-slate-900">

                                        Bs 85

                                    </td>

                                    <td class="px-6 py-5">

                                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">

                                            Entregado

                                        </span>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </main>

    </div>

</div>

@endsection