@extends('layouts.app')

@section('content')

<section class="min-h-screen bg-slate-950 text-white">

    {{-- HEADER --}}
    <header class="border-b border-white/10 bg-white/5 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row md:items-center md:justify-between gap-5">

            <div>
                <span class="inline-flex items-center gap-2 rounded-full bg-orange-500/20 px-4 py-2 text-sm font-bold text-orange-300">
                    🔐 Super Admin
                </span>

                <h1 class="mt-4 text-4xl font-black">
                    Panel principal
                </h1>

                <p class="mt-2 text-slate-400">
                    Administración global de negocios, usuarios, productos y pedidos.
                </p>
            </div>

            <div class="flex flex-wrap gap-3">

                <a href="{{ route('home') }}"
                   class="rounded-2xl border border-white/10 px-5 py-3 text-sm font-bold text-slate-300 hover:bg-white/10 transition">
                    Inicio
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                            class="rounded-2xl bg-red-500 px-5 py-3 text-sm font-bold text-white hover:bg-red-600 transition">
                        Cerrar sesión
                    </button>
                </form>

            </div>

        </div>
    </header>

    {{-- CONTENT --}}
    <main class="max-w-7xl mx-auto px-6 py-10">

        {{-- WELCOME --}}
        <div class="relative overflow-hidden rounded-[32px] border border-white/10 bg-white/10 p-8 shadow-2xl mb-10">

            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-orange-500/20 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-pink-500/20 blur-3xl"></div>

            <div class="relative z-10 grid lg:grid-cols-2 gap-8 items-center">

                <div>
                    <h2 class="text-3xl md:text-4xl font-black">
                        Centro de control de FoodLink
                    </h2>

                    <p class="mt-4 text-slate-300 leading-relaxed">
                        Este panel permite supervisar el estado general del sistema.
                        Más adelante aquí se agregará gestión avanzada de negocios,
                        usuarios, reportes, planes y métricas globales.
                    </p>
                </div>

                <div class="rounded-3xl bg-gradient-to-br from-orange-500 to-pink-600 p-8 shadow-xl">
                    <p class="text-orange-100 text-sm font-bold">
                        Plataforma SaaS
                    </p>

                    <h3 class="mt-2 text-4xl font-black">
                        FoodLink
                    </h3>

                    <p class="mt-2 text-orange-100">
                        Marketplace para negocios digitales
                    </p>
                </div>

            </div>

        </div>

        {{-- STATS --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            <div class="rounded-3xl border border-white/10 bg-white/10 p-6 hover:-translate-y-1 transition">
                <div class="text-4xl mb-5">🏪</div>
                <p class="text-sm text-slate-400">Negocios registrados</p>
                <h3 class="mt-2 text-4xl font-black">
                    {{ \App\Models\Tenant::count() }}
                </h3>
            </div>

            <div class="rounded-3xl border border-white/10 bg-white/10 p-6 hover:-translate-y-1 transition">
                <div class="text-4xl mb-5">👥</div>
                <p class="text-sm text-slate-400">Usuarios registrados</p>
                <h3 class="mt-2 text-4xl font-black">
                    {{ \App\Models\User::count() }}
                </h3>
            </div>

            <div class="rounded-3xl border border-white/10 bg-white/10 p-6 hover:-translate-y-1 transition">
                <div class="text-4xl mb-5">📦</div>
                <p class="text-sm text-slate-400">Productos publicados</p>
                <h3 class="mt-2 text-4xl font-black">
                    {{ \App\Models\Product::count() }}
                </h3>
            </div>

            <div class="rounded-3xl border border-white/10 bg-white/10 p-6 hover:-translate-y-1 transition">
                <div class="text-4xl mb-5">🧾</div>
                <p class="text-sm text-slate-400">Pedidos registrados</p>
                <h3 class="mt-2 text-4xl font-black">
                    {{ \App\Models\Order::count() }}
                </h3>
            </div>

        </div>

        {{-- MODULES --}}
        <div class="grid lg:grid-cols-3 gap-6">

            <a href="{{ route('super.admin.businesses') }}"
               class="group rounded-[32px] border border-white/10 bg-white/10 p-8 hover:bg-white/15 transition">

                <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-3xl bg-orange-500/20 text-4xl">
                    🏪
                </div>

                <h3 class="text-2xl font-black">
                    Negocios
                </h3>

                <p class="mt-3 text-slate-400">
                    Ver todos los negocios registrados en la plataforma.
                </p>

                <div class="mt-6 font-bold text-orange-400 group-hover:translate-x-2 transition">
                    Ver negocios →
                </div>

            </a>

            <a href="{{ route('super.admin.users') }}"
               class="group rounded-[32px] border border-white/10 bg-white/10 p-8 hover:bg-white/15 transition">

                <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-3xl bg-cyan-500/20 text-4xl">
                    👥
                </div>

                <h3 class="text-2xl font-black">
                    Usuarios
                </h3>

                <p class="mt-3 text-slate-400">
                    Supervisar propietarios, administradores y empleados.
                </p>

                <div class="mt-6 font-bold text-cyan-400 group-hover:translate-x-2 transition">
                    Ver usuarios →
                </div>

            </a>

            <a href="{{ route('super.admin.reports') }}"
               class="group rounded-[32px] border border-white/10 bg-white/10 p-8 hover:bg-white/15 transition">

                <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-3xl bg-pink-500/20 text-4xl">
                    📊
                </div>

                <h3 class="text-2xl font-black">
                    Reportes
                </h3>

                <p class="mt-3 text-slate-400">
                    Revisar métricas generales del sistema.
                </p>

                <div class="mt-6 font-bold text-pink-400 group-hover:translate-x-2 transition">
                    Ver reportes →
                </div>

            </a>

        </div>

    </main>

</section>

@endsection