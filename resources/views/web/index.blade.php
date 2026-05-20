@extends('layouts.app')

@section('content')

{{-- =========================================================
HERO SECTION
========================================================= --}}

<section class="relative min-h-screen overflow-hidden bg-[#050816] pt-32">

    {{-- BACKGROUND EFFECTS --}}
    <div class="absolute inset-0 overflow-hidden">

        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-500/20 blur-3xl rounded-full animate-pulse"></div>

        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-pink-500/20 blur-3xl rounded-full animate-pulse"></div>

        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-blue-500/10 blur-3xl rounded-full"></div>

    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20">

        <div class="grid lg:grid-cols-2 gap-24 items-center">

            {{-- =========================================================
            LEFT CONTENT
            ========================================================= --}}
            <div>

                {{-- BADGE --}}
                <div class="inline-flex items-center gap-3 px-5 py-3 rounded-full border border-white/10 bg-white/5 backdrop-blur-xl shadow-2xl">

                    <div class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></div>

                    <span class="text-sm font-semibold text-slate-200">

                        Plataforma moderna para negocios digitales

                    </span>

                </div>

                {{-- TITLE --}}
                <h1 class="mt-10 text-5xl md:text-6xl lg:text-7xl font-black leading-[1.05] tracking-tight text-white">

                    Convierte

                    <span class="text-orange-400">
                        TikTok
                    </span>,

                    Instagram y

                    <span class="text-pink-400">
                        WhatsApp
                    </span>

                    <span class="block mt-4 bg-gradient-to-r from-orange-400 via-pink-500 to-rose-500 bg-clip-text text-transparent">

                        en ventas reales

                    </span>

                </h1>

                {{-- DESCRIPTION --}}
                <p class="mt-10 text-xl text-slate-300 leading-relaxed max-w-2xl">

                    Diseñado para restaurantes, hamburgueserías,
                    cafeterías, snacks y negocios modernos
                    que venden desde redes sociales.

                </p>

                {{-- BUTTONS --}}
                <div class="flex flex-wrap gap-5 mt-12">

                    <a
                        href="{{ route('register.business.form') }}"
                        class="group relative overflow-hidden px-10 py-5 rounded-2xl bg-gradient-to-r from-orange-500 via-pink-500 to-rose-500 text-white text-lg font-black shadow-[0_15px_50px_rgba(249,115,22,0.35)] hover:scale-105 transition duration-300">

                        <span class="relative z-10">

                            Registrar negocio

                        </span>

                        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition"></div>

                    </a>

                    <a
                        href="#benefits"
                        class="px-10 py-5 rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl text-white text-lg font-semibold hover:bg-white/10 transition">

                        Ver beneficios

                    </a>

                </div>

                {{-- BENEFITS --}}
                <div
                    id="benefits"
                    class="grid sm:grid-cols-2 gap-5 mt-16">

                    {{-- CARD --}}
                    <div class="group rounded-3xl border border-emerald-400/20 bg-emerald-500/10 backdrop-blur-xl p-6 hover:-translate-y-2 transition duration-500">

                        <div class="w-14 h-14 rounded-2xl bg-emerald-400/20 flex items-center justify-center text-3xl mb-5">

                            📲

                        </div>

                        <h3 class="text-white font-bold text-xl mb-2">

                            Pedidos automáticos

                        </h3>

                        <p class="text-slate-300 leading-relaxed">

                            WhatsApp integrado para cerrar ventas rápidamente.

                        </p>

                    </div>

                    {{-- CARD --}}
                    <div class="group rounded-3xl border border-orange-400/20 bg-orange-500/10 backdrop-blur-xl p-6 hover:-translate-y-2 transition duration-500">

                        <div class="w-14 h-14 rounded-2xl bg-orange-400/20 flex items-center justify-center text-3xl mb-5">

                            ⚡

                        </div>

                        <h3 class="text-white font-bold text-xl mb-2">

                            Activación rápida

                        </h3>

                        <p class="text-slate-300 leading-relaxed">

                            Tu tienda lista para compartir en minutos.

                        </p>

                    </div>

                    {{-- CARD --}}
                    <div class="group rounded-3xl border border-cyan-400/20 bg-cyan-500/10 backdrop-blur-xl p-6 hover:-translate-y-2 transition duration-500">

                        <div class="w-14 h-14 rounded-2xl bg-cyan-400/20 flex items-center justify-center text-3xl mb-5">

                            🎨

                        </div>

                        <h3 class="text-white font-bold text-xl mb-2">

                            Diseño profesional

                        </h3>

                        <p class="text-slate-300 leading-relaxed">

                            Catálogo premium optimizado para móviles.

                        </p>

                    </div>

                    {{-- CARD --}}
                    <div class="group rounded-3xl border border-pink-400/20 bg-pink-500/10 backdrop-blur-xl p-6 hover:-translate-y-2 transition duration-500">

                        <div class="w-14 h-14 rounded-2xl bg-pink-400/20 flex items-center justify-center text-3xl mb-5">

                            🚀

                        </div>

                        <h3 class="text-white font-bold text-xl mb-2">

                            Link personalizado

                        </h3>

                        <p class="text-slate-300 leading-relaxed">

                            Comparte tu tienda en TikTok e Instagram.

                        </p>

                    </div>

                </div>

            </div>

            {{-- =========================================================
            RIGHT PHONE MOCKUP
            ========================================================= --}}
            <div class="relative flex justify-center">

                {{-- FLOATING CARD --}}
                <div class="absolute -top-8 -left-2 lg:-left-10 z-20 bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl p-5 shadow-2xl animate-bounce">

                    <h3 class="text-2xl font-black text-white">

                        +120 pedidos

                    </h3>

                    <p class="text-emerald-400 text-sm">

                        hoy

                    </p>

                </div>

                {{-- PHONE --}}
                <div class="relative w-[360px] rounded-[50px] border-[10px] border-slate-800 bg-black overflow-hidden shadow-[0_0_80px_rgba(249,115,22,.25)]">

                    {{-- TOP --}}
                    <div class="flex items-center justify-between p-5 border-b border-white/10 bg-slate-900">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-2xl bg-orange-500 flex items-center justify-center text-2xl">

                                🍔

                            </div>

                            <div>

                                <h3 class="font-bold text-white">

                                    Burger Pro

                                </h3>

                                <p class="text-emerald-400 text-sm">

                                    ● Abierto ahora

                                </p>

                            </div>

                        </div>

                        <div class="bg-white/10 px-4 py-2 rounded-full text-sm text-white">

                            Delivery

                        </div>

                    </div>

                    {{-- IMAGE --}}
                    <img
                        src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1200"
                        class="w-full h-80 object-cover"
                        alt="FoodLink">

                    {{-- CONTENT --}}
                    <div class="bg-slate-900 p-6">

                        <div class="flex justify-between items-center">

                            <div>

                                <h2 class="text-2xl font-black text-white">

                                    Hamburguesa Doble

                                </h2>

                                <p class="text-slate-400">

                                    Compra rápida desde TikTok

                                </p>

                            </div>

                            <div class="text-orange-400 text-3xl font-black">

                                Bs 45

                            </div>

                        </div>

                        <button
                            class="w-full mt-6 bg-gradient-to-r from-orange-500 to-pink-500 hover:opacity-90 transition py-5 rounded-2xl text-lg font-black text-white">

                            + Agregar al carrito

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection