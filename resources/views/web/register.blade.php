@extends('layouts.app')

@section('content')

{{-- =========================================================
BACKGROUND
========================================================= --}}

<section class="relative min-h-screen overflow-hidden bg-[#050816] text-white">

    {{-- GRADIENTS --}}
    <div class="absolute inset-0 overflow-hidden">

        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-500/20 blur-3xl rounded-full"></div>

        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-pink-500/20 blur-3xl rounded-full"></div>

        <div class="absolute top-1/2 left-1/2 w-[700px] h-[700px] -translate-x-1/2 -translate-y-1/2 bg-blue-500/10 blur-3xl rounded-full"></div>

    </div>

    {{-- NAVBAR --}}
    <header class="relative z-50 border-b border-white/10 bg-black/20 backdrop-blur-xl">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-center justify-between h-20">

                {{-- LOGO --}}
                <a href="/" class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-3xl bg-gradient-to-br from-orange-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg shadow-orange-500/30">

                        🚀

                    </div>

                    <div>

                        <h1 class="text-2xl font-black tracking-tight">
                            FoodLink
                        </h1>

                        <p class="text-xs text-slate-400">
                            Marketplace Commerce
                        </p>

                    </div>

                </a>

                {{-- MENU --}}
                <nav class="hidden lg:flex items-center gap-10">

                    <a href="/"
                       class="text-slate-300 hover:text-orange-400 transition duration-300">

                        Inicio

                    </a>

                    <a href="#benefits"
                       class="text-slate-300 hover:text-orange-400 transition duration-300">

                        Beneficios

                    </a>

                    <a href="#features"
                       class="text-slate-300 hover:text-orange-400 transition duration-300">

                        Funciones

                    </a>

                </nav>

                {{-- BUTTONS --}}
                <div class="flex items-center gap-4">

                    <a href="/login"
                       class="hidden md:flex px-5 py-3 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 text-sm font-semibold transition">

                        Iniciar sesión

                    </a>

                    <a href="/register-business"
                       class="px-6 py-3 rounded-2xl bg-gradient-to-r from-orange-500 via-pink-500 to-rose-500 hover:scale-105 transition duration-300 font-bold shadow-lg shadow-orange-500/30">

                        Registrar negocio

                    </a>

                </div>

            </div>

        </div>

    </header>

    {{-- CONTENT --}}
    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20">

        <div class="grid lg:grid-cols-2 gap-20 items-center">

            {{-- LEFT --}}
            <div>

                {{-- BADGE --}}
                <div class="inline-flex items-center gap-3 px-5 py-3 rounded-full border border-white/10 bg-white/5 backdrop-blur-xl mb-8 shadow-2xl">

                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>

                    <span class="text-sm font-semibold text-white">
                        Plataforma moderna para negocios digitales
                    </span>

                </div>

                {{-- TITLE --}}
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black leading-tight">

                    Convierte tus
                    redes sociales

                    <span class="block mt-3 bg-gradient-to-r from-orange-400 via-pink-500 to-rose-500 bg-clip-text text-transparent">

                        en ventas reales

                    </span>

                </h1>

                {{-- DESCRIPTION --}}
                <p class="mt-10 text-xl text-slate-300 leading-relaxed max-w-2xl">

                    Crea catálogos modernos para comida, ropa, snacks,
                    cosméticos, tecnología y cualquier negocio.
                    Recibe pedidos automáticos desde TikTok y WhatsApp.

                </p>

                {{-- STATS --}}
                <div class="grid grid-cols-3 gap-5 mt-14">

                    <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6">

                        <h3 class="text-4xl font-black text-orange-400">
                            +500
                        </h3>

                        <p class="mt-2 text-slate-300">
                            Negocios
                        </p>

                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6">

                        <h3 class="text-4xl font-black text-pink-400">
                            +10K
                        </h3>

                        <p class="mt-2 text-slate-300">
                            Pedidos
                        </p>

                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6">

                        <h3 class="text-4xl font-black text-cyan-400">
                            24/7
                        </h3>

                        <p class="mt-2 text-slate-300">
                            Disponible
                        </p>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="relative">

                {{-- GLOW --}}
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-500 via-pink-500 to-purple-600 rounded-[40px] blur opacity-40"></div>

                {{-- CARD --}}
                <div class="relative rounded-[40px] border border-white/10 bg-white/10 backdrop-blur-2xl shadow-[0_20px_80px_rgba(0,0,0,0.45)] overflow-hidden">

                    {{-- TOP --}}
                    <div class="flex items-center justify-between p-6 border-b border-white/10">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-orange-500 to-pink-500 flex items-center justify-center text-2xl">

                                🍔

                            </div>

                            <div>

                                <h3 class="font-black text-xl">
                                    Burger Pro
                                </h3>

                                <p class="text-green-400 text-sm">
                                    ● Abierto ahora
                                </p>

                            </div>

                        </div>

                        <div class="px-4 py-2 rounded-full bg-green-500/20 border border-green-400/20 text-green-300 text-sm">

                            Delivery

                        </div>

                    </div>

                    {{-- IMAGE --}}
                    <img
                        src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1200"
                        class="w-full h-80 object-cover"
                    >

                    {{-- PRODUCT --}}
                    <div class="p-8">

                        <div class="flex items-start justify-between gap-5">

                            <div>

                                <h2 class="text-3xl font-black">
                                    Hamburguesa Premium
                                </h2>

                                <p class="mt-3 text-slate-300 leading-relaxed">
                                    Compra rápida desde TikTok, Instagram y WhatsApp.
                                </p>

                            </div>

                            <div class="text-3xl font-black text-orange-400 whitespace-nowrap">

                                Bs 45

                            </div>

                        </div>

                        {{-- BUTTON --}}
                        <button
                            class="w-full mt-8 rounded-2xl bg-gradient-to-r from-orange-500 via-pink-500 to-rose-500 py-5 text-lg font-black text-white hover:scale-[1.02] transition duration-300 shadow-lg shadow-orange-500/30">

                            + Agregar al carrito

                        </button>

                    </div>

                </div>

            </div>

        </div>

        {{-- FEATURES --}}
        <div id="features" class="grid md:grid-cols-3 gap-8 mt-32">

            {{-- CARD --}}
            <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8 hover:-translate-y-2 transition duration-500">

                <div class="w-16 h-16 rounded-2xl bg-orange-500/20 flex items-center justify-center text-3xl mb-6">

                    📲

                </div>

                <h3 class="text-2xl font-black mb-4">
                    Pedidos automáticos
                </h3>

                <p class="text-slate-300 leading-relaxed">

                    Tus clientes pueden ordenar directamente desde redes sociales.

                </p>

            </div>

            {{-- CARD --}}
            <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8 hover:-translate-y-2 transition duration-500">

                <div class="w-16 h-16 rounded-2xl bg-pink-500/20 flex items-center justify-center text-3xl mb-6">

                    ⚡

                </div>

                <h3 class="text-2xl font-black mb-4">
                    Activación rápida
                </h3>

                <p class="text-slate-300 leading-relaxed">

                    Publica tu tienda en minutos con un enlace personalizado.

                </p>

            </div>

            {{-- CARD --}}
            <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8 hover:-translate-y-2 transition duration-500">

                <div class="w-16 h-16 rounded-2xl bg-cyan-500/20 flex items-center justify-center text-3xl mb-6">

                    🚀

                </div>

                <h3 class="text-2xl font-black mb-4">
                    Diseño moderno
                </h3>

                <p class="text-slate-300 leading-relaxed">

                    Experiencia optimizada para móviles y plataformas sociales.

                </p>

            </div>

        </div>

    </div>

</section>

@endsection