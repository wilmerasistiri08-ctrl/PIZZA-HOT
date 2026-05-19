@extends('layouts.app')

@section('content')

{{-- =========================================================
NAVBAR
========================================================= --}}

<header class="sticky top-0 z-50 border-b border-white/10 glass">

    <div class="max-w-7xl mx-auto px-6 py-5">

        <div class="flex items-center justify-between">

            {{-- LOGO --}}
            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-3xl bg-orange-500
                            flex items-center justify-center
                            text-2xl glow-orange">

                    🛍️

                </div>

                <div>

                    <h1 class="text-2xl font-black text-white">
                        FoodLink
                    </h1>

                    <p class="text-slate-400 text-sm">
                        Marketplace Commerce
                    </p>

                </div>

            </div>

            {{-- MENU --}}
            <nav class="hidden lg:flex items-center gap-10">

                <a href="#benefits"
                   class="text-slate-300 hover:text-orange-400 transition">

                    Beneficios

                </a>

                <a href="#categories"
                   class="text-slate-300 hover:text-orange-400 transition">

                    Categorías

                </a>

                <a href="#partners"
                   class="text-slate-300 hover:text-orange-400 transition">

                    Partners

                </a>

            </nav>

            {{-- CTA --}}
            <a href="/register"
               class="btn-premium bg-orange-500
                      hover:bg-orange-600
                      px-8 py-4 rounded-2xl
                      font-bold text-white glow-orange">

                Registrar negocio

            </a>

        </div>

    </div>

</header>

{{-- =========================================================
HERO
========================================================= --}}

<section class="relative overflow-hidden">

    <div class="max-w-7xl mx-auto px-6 py-24">

        <div class="grid lg:grid-cols-2 gap-20 items-center">

            {{-- LEFT --}}
            <div class="reveal">

                <div class="inline-flex items-center gap-3
                            glass px-5 py-3 rounded-full">

                    <div class="w-3 h-3 rounded-full
                                bg-emerald-400 animate-pulse">
                    </div>

                    <span class="text-slate-300 font-medium">

                        Plataforma moderna para negocios

                    </span>

                </div>

                <h1 class="hero-title mt-10
                           text-6xl lg:text-8xl
                           font-black tracking-tight">

                    Convierte

                    <span class="text-orange-400">
                        TikTok
                    </span>,

                    Instagram y

                    <span class="text-pink-400">
                        WhatsApp
                    </span>

                    en ventas reales

                </h1>

                <p class="mt-8 text-xl text-slate-300 leading-relaxed max-w-2xl">

                    Diseñado para restaurantes, ropa, cosméticos,
                    tecnología, snacks y cualquier negocio moderno
                    que venda por redes sociales.

                </p>

                <div class="flex flex-wrap gap-5 mt-12">

                    <a href="/register"
                       class="btn-premium bg-orange-500
                              hover:bg-orange-600
                              px-10 py-5 rounded-2xl
                              text-lg font-bold text-white glow-orange">

                        Comenzar ahora

                    </a>

                    <a href="#benefits"
                       class="glass px-10 py-5 rounded-2xl
                              text-lg font-semibold text-white">

                        Ver beneficios

                    </a>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="relative reveal">

                {{-- FLOATING CARD --}}
                <div class="absolute -top-6 -left-6
                            glass rounded-3xl p-5
                            animate-floating">

                    <h3 class="text-2xl font-black">
                        +120 pedidos
                    </h3>

                    <p class="text-slate-400">
                        hoy
                    </p>

                </div>

                {{-- PHONE --}}
                <div class="mx-auto w-96 rounded-[48px]
                            border-10 border-slate-800
                            bg-black overflow-hidden
                            shadow-[0_0_80px_rgba(249,115,22,.25)]">

                    {{-- TOP --}}
                    <div class="flex items-center
                                justify-between
                                p-5 border-b border-white/10">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-2xl
                                        bg-orange-500
                                        flex items-center justify-center">

                                🛒

                            </div>

                            <div>

                                <h3 class="font-bold">
                                    Tienda Moderna
                                </h3>

                                <p class="text-emerald-400 text-sm">

                                    ● Abierto ahora

                                </p>

                            </div>

                        </div>

                        <div class="glass px-4 py-2 rounded-full text-sm">

                            Delivery

                        </div>

                    </div>

                    {{-- IMAGE --}}
                    <img
                        src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1200"
                        class="w-full h-80 object-cover"
                    >

                    {{-- CONTENT --}}
                    <div class="bg-slate-900 p-6">

                        <div class="flex justify-between items-center">

                            <div>

                                <h2 class="text-2xl font-black">

                                    Producto Premium

                                </h2>

                                <p class="text-slate-400">

                                    Compra rápida desde TikTok

                                </p>

                            </div>

                            <div class="text-orange-400
                                        text-3xl font-black">

                                Bs 120

                            </div>

                        </div>

                        <button class="w-full mt-6
                                       bg-orange-500
                                       hover:bg-orange-600
                                       transition
                                       py-5 rounded-2xl
                                       text-lg font-black">

                            + Agregar al carrito

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection