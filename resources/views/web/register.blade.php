@extends('layouts.app')

@section('content')

<section class="relative min-h-screen overflow-hidden bg-[#050816]">

    {{-- BACKGROUND --}}
    <div class="absolute inset-0 overflow-hidden">

        <div class="absolute top-0 left-0 w-125 h-125 bg-orange-500/20 blur-3xl rounded-full animate-pulse"></div>

        <div class="absolute bottom-0 right-0 w-125 h-125 bg-pink-500/20 blur-3xl rounded-full animate-pulse"></div>

        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-175 h-175 bg-blue-500/10 blur-3xl rounded-full"></div>

    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20">

        <div class="grid lg:grid-cols-2 gap-20 items-center">

            {{-- LEFT --}}
            <div>

                {{-- BADGE --}}
                <div class="inline-flex items-center gap-3 px-5 py-3 rounded-full border border-white/10 bg-white/5 backdrop-blur-xl shadow-2xl mb-8">

                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>

                    <span class="text-sm text-white font-semibold">
                        Plataforma moderna para negocios digitales
                    </span>

                </div>

                {{-- TITLE --}}
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black leading-tight text-white">

                    Convierte tus
                    redes sociales

                    <span class="block mt-2 bg-linear-to-r from-orange-400 via-pink-500 to-rose-500 bg-clip-text text-transparent">

                        en ventas reales

                    </span>

                </h1>

                {{-- DESCRIPTION --}}
                <p class="mt-10 text-xl text-slate-300 leading-relaxed max-w-2xl">

                    Crea catálogos modernos para comida, ropa, snacks,
                    cosméticos, tecnología y cualquier negocio.
                    Recibe pedidos automáticos desde TikTok y WhatsApp.

                </p>

                {{-- FEATURES --}}
                <div class="grid sm:grid-cols-2 gap-5 mt-14">

                    {{-- FEATURE --}}
                    <div class="group rounded-3xl border border-emerald-400/20 bg-emerald-500/10 backdrop-blur-xl p-6 hover:-translate-y-2 transition duration-500">

                        <div class="w-14 h-14 rounded-2xl bg-emerald-400/20 flex items-center justify-center text-3xl mb-5">

                            📲

                        </div>

                        <h3 class="text-white font-bold text-xl mb-2">
                            Pedidos automáticos
                        </h3>

                        <p class="text-slate-300">
                            WhatsApp integrado para ventas rápidas.
                        </p>

                    </div>

                    {{-- FEATURE --}}
                    <div class="group rounded-3xl border border-orange-400/20 bg-orange-500/10 backdrop-blur-xl p-6 hover:-translate-y-2 transition duration-500">

                        <div class="w-14 h-14 rounded-2xl bg-orange-400/20 flex items-center justify-center text-3xl mb-5">

                            ⚡

                        </div>

                        <h3 class="text-white font-bold text-xl mb-2">
                            Activación rápida
                        </h3>

                        <p class="text-slate-300">
                            Publica tu tienda en minutos.
                        </p>

                    </div>

                    {{-- FEATURE --}}
                    <div class="group rounded-3xl border border-cyan-400/20 bg-cyan-500/10 backdrop-blur-xl p-6 hover:-translate-y-2 transition duration-500">

                        <div class="w-14 h-14 rounded-2xl bg-cyan-400/20 flex items-center justify-center text-3xl mb-5">

                            🎨

                        </div>

                        <h3 class="text-white font-bold text-xl mb-2">
                            Diseño profesional
                        </h3>

                        <p class="text-slate-300">
                            Optimizado para móviles y TikTok.
                        </p>

                    </div>

                    {{-- FEATURE --}}
                    <div class="group rounded-3xl border border-pink-400/20 bg-pink-500/10 backdrop-blur-xl p-6 hover:-translate-y-2 transition duration-500">

                        <div class="w-14 h-14 rounded-2xl bg-pink-400/20 flex items-center justify-center text-3xl mb-5">

                            🚀

                        </div>

                        <h3 class="text-white font-bold text-xl mb-2">
                            Link personalizado
                        </h3>

                        <p class="text-slate-300">
                            Comparte tu tienda en redes sociales.
                        </p>

                    </div>

                </div>

            </div>

            {{-- FORM --}}
            <div class="relative">

                <div class="absolute -inset-1 bg-linear-to-r from-orange-500 via-pink-500 to-purple-600 rounded-[40px] blur opacity-40 animate-pulse"></div>

                <div class="relative bg-white/10 backdrop-blur-2xl border border-white/10 rounded-[40px] p-10 shadow-[0_20px_80px_rgba(0,0,0,0.45)]">

                    {{-- SUCCESS --}}
                    @if(session('success'))

                        <div class="mb-6 bg-green-500/20 border border-green-400/20 text-green-300 px-5 py-4 rounded-2xl">

                            {{ session('success') }}

                        </div>

                    @endif

                    {{-- ERRORS --}}
                    @if($errors->any())

                        <div class="mb-6 bg-red-500/20 border border-red-400/20 text-red-300 px-5 py-4 rounded-2xl">

                            <ul class="space-y-2">

                                @foreach($errors->all() as $error)

                                    <li>
                                        • {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    {{-- TITLE --}}
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-3">

                        Registrar negocio

                    </h2>

                    <p class="text-slate-300 text-lg mb-10">

                        Crea tu tienda digital y empieza a vender hoy.

                    </p>

                    {{-- FORM --}}
                    <form
                        action="{{ route('register.business') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="space-y-7">

                        @csrf

                        {{-- NAME --}}
                        <div>

                            <label class="block text-white font-semibold mb-3">
                                Nombre del negocio
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Ej: Hamburguesas Pro"
                                required
                                class="w-full rounded-2xl bg-white/10 border border-white/10 text-white px-6 py-5 placeholder:text-slate-400 focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/20 transition">

                        </div>

                        {{-- SLUG --}}
                        <div>

                            <label class="block text-white font-semibold mb-3">
                                URL personalizada
                            </label>

                            <input
                                type="text"
                                name="slug"
                                value="{{ old('slug') }}"
                                placeholder="hamburguesas-pro"
                                required
                                class="w-full rounded-2xl bg-white/10 border border-white/10 text-white px-6 py-5 placeholder:text-slate-400 focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/20 transition">

                        </div>

                        {{-- WHATSAPP --}}
                        <div>

                            <label class="block text-white font-semibold mb-3">
                                WhatsApp
                            </label>

                            <input
                                type="text"
                                name="whatsapp_number"
                                value="{{ old('whatsapp_number') }}"
                                placeholder="77777777"
                                required
                                class="w-full rounded-2xl bg-white/10 border border-white/10 text-white px-6 py-5 placeholder:text-slate-400 focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/20 transition">

                        </div>

                        {{-- ADDRESS --}}
                        <div>

                            <label class="block text-white font-semibold mb-3">
                                Dirección
                            </label>

                            <input
                                type="text"
                                name="address"
                                value="{{ old('address') }}"
                                placeholder="Av Busch"
                                class="w-full rounded-2xl bg-white/10 border border-white/10 text-white px-6 py-5 placeholder:text-slate-400 focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/20 transition">

                        </div>

                        {{-- MAPS --}}
                        <div>

                            <label class="block text-white font-semibold mb-3">
                                Google Maps
                            </label>

                            <input
                                type="text"
                                name="google_maps"
                                value="{{ old('google_maps') }}"
                                placeholder="https://maps.google.com/"
                                class="w-full rounded-2xl bg-white/10 border border-white/10 text-white px-6 py-5 placeholder:text-slate-400 focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/20 transition">

                        </div>

                        {{-- TIKTOK --}}
                        <div>

                            <label class="block text-white font-semibold mb-3">
                                TikTok
                            </label>

                            <input
                                type="text"
                                name="tiktok"
                                value="{{ old('tiktok') }}"
                                placeholder="@burgerpro"
                                class="w-full rounded-2xl bg-white/10 border border-white/10 text-white px-6 py-5 placeholder:text-slate-400 focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/20 transition">

                        </div>

                        {{-- LOGO --}}
                        <div>

                            <label class="block text-white font-semibold mb-3">
                                Logo del negocio
                            </label>

                            <input
                                type="file"
                                name="logo"
                                class="w-full rounded-2xl bg-white/10 border border-dashed border-white/20 text-slate-300 px-6 py-5 file:bg-orange-500 file:border-0 file:text-white file:px-5 file:py-3 file:rounded-xl file:mr-4 hover:file:bg-orange-600 transition">

                        </div>

                        {{-- BUTTON --}}
                        <button
                            type="submit"
                            class="group relative overflow-hidden w-full rounded-2xl py-5 text-xl font-black text-white bg-linear-to-r from-orange-500 via-pink-500 to-rose-500 shadow-[0_15px_50px_rgba(249,115,22,0.4)] hover:scale-[1.02] transition duration-300">

                            <span class="relative z-10">

                                Crear mi tienda

                            </span>

                            <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition"></div>

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection