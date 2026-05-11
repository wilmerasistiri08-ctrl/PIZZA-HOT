@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-black text-white">

    {{-- EFECTOS BACKGROUND --}}
    <div class="absolute top-0 left-0 w-72 h-72 bg-orange-500/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-green-500/10 rounded-full blur-3xl"></div>

    {{-- NAVBAR --}}
    <nav class="relative z-20 max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">

        {{-- LOGO --}}
        <a href="/"
           class="flex items-center gap-3">

            <div class="w-12 h-12 bg-orange-500 rounded-2xl flex items-center justify-center text-2xl shadow-lg">
                🍔
            </div>

            <div>

                <div class="text-2xl font-extrabold tracking-tight">
                    FoodLink
                </div>

                <div class="text-xs text-slate-400">
                    Marketplace Food Delivery
                </div>

            </div>

        </a>

        {{-- MENU --}}
        <div class="hidden lg:flex items-center gap-8 text-sm font-medium">

            <a href="#beneficios"
               class="hover:text-orange-400 transition">
                Beneficios
            </a>

            <a href="#partners"
               class="hover:text-orange-400 transition">
                Partners
            </a>

            <a href="#demo"
               class="hover:text-orange-400 transition">
                Demo
            </a>

            <a href="/register"
               class="bg-orange-500 hover:bg-orange-600 transition px-6 py-3 rounded-2xl font-bold shadow-xl">
                Registrar negocio
            </a>

        </div>

    </nav>

    {{-- HERO --}}
    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 lg:py-28 grid lg:grid-cols-2 gap-16 items-center">

        {{-- TEXTO --}}
        <div>

            {{-- BADGE --}}
            <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/10 rounded-full px-5 py-3 mb-8">

                <span class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></span>

                <span class="text-sm font-medium text-slate-200">
                    Convierte visitas de TikTok en pedidos reales
                </span>

            </div>

            {{-- TITULO --}}
            <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight mb-8 tracking-tight">

                Lleva tu menú de TikTok al carrito de compras en un clic

            </h1>

            {{-- DESCRIPCION --}}
            <p class="text-slate-300 text-xl leading-relaxed mb-10 max-w-2xl">

                Crea una experiencia moderna tipo Uber Eats para tu negocio y recibe pedidos automáticos por WhatsApp con un catálogo optimizado para móviles.

            </p>

            {{-- BOTONES --}}
            <div class="flex flex-wrap gap-5 mb-10">

                <a href="/register"
                   class="bg-orange-500 hover:bg-orange-600 transition px-8 py-5 rounded-2xl font-bold text-lg shadow-2xl hover:scale-105 duration-300">

                    🚀 Registrar mi negocio

                </a>

                <a href="#demo"
                   class="bg-white/10 hover:bg-white/20 transition border border-white/10 backdrop-blur-md px-8 py-5 rounded-2xl font-bold text-lg">

                    ▶ Solicitar demo

                </a>

            </div>

            {{-- FEATURES --}}
            <div class="grid sm:grid-cols-3 gap-5 text-sm">

                <div class="bg-white/5 border border-white/10 rounded-2xl p-5 backdrop-blur-md">

                    <div class="text-3xl mb-3">
                        📲
                    </div>

                    <div class="font-semibold">
                        WhatsApp Automático
                    </div>

                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl p-5 backdrop-blur-md">

                    <div class="text-3xl mb-3">
                        ⚡
                    </div>

                    <div class="font-semibold">
                        Checkout Rápido
                    </div>

                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl p-5 backdrop-blur-md">

                    <div class="text-3xl mb-3">
                        💰
                    </div>

                    <div class="font-semibold">
                        Sin Comisiones
                    </div>

                </div>

            </div>

        </div>

        {{-- MOCKUP --}}
        <div class="relative">

            {{-- EFECTOS --}}
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-orange-500 rounded-full blur-3xl opacity-30"></div>

            <div class="absolute bottom-0 right-0 w-56 h-56 bg-green-500 rounded-full blur-3xl opacity-20"></div>

            {{-- CARD PRINCIPAL --}}
            <div class="relative bg-white rounded-[40px] overflow-hidden shadow-2xl border border-white/10">

                {{-- HEADER APP --}}
                <div class="bg-black text-white p-5 flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <div class="w-12 h-12 bg-orange-500 rounded-2xl flex items-center justify-center text-xl">
                            🍔
                        </div>

                        <div>

                            <div class="font-bold text-lg">
                                Hamburguesas Pro
                            </div>

                            <div class="text-sm text-green-400">
                                ● Abierto ahora
                            </div>

                        </div>

                    </div>

                    <div class="text-sm bg-white/10 px-4 py-2 rounded-full">
                        Delivery
                    </div>

                </div>

                {{-- IMAGEN --}}
                <img
                    src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1200&auto=format&fit=crop"
                    class="w-full h-[500px] object-cover">

                {{-- FOOTER CARD --}}
                <div class="p-6">

                    <div class="flex items-center justify-between mb-4">

                        <div>

                            <div class="text-2xl font-extrabold text-slate-900">
                                Hamburguesa Clásica
                            </div>

                            <div class="text-slate-500">
                                Carne premium + papas
                            </div>

                        </div>

                        <div class="text-orange-500 text-3xl font-extrabold">
                            Bs 25
                        </div>

                    </div>

                    <button
                        class="w-full bg-black hover:bg-orange-500 transition text-white py-5 rounded-2xl font-bold text-lg">

                        + Agregar al carrito

                    </button>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- BENEFICIOS --}}
<section id="beneficios" class="py-28 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        {{-- TITULO --}}
        <div class="text-center mb-20">

            <div class="text-orange-500 font-bold uppercase tracking-widest mb-4">
                Beneficios
            </div>

            <h2 class="text-5xl font-extrabold text-slate-900 mb-6">

                Diseñado para aumentar ventas

            </h2>

            <p class="text-slate-500 text-xl max-w-3xl mx-auto leading-relaxed">

                Todo optimizado para convertir tráfico de TikTok, Instagram y Facebook en pedidos reales.

            </p>

        </div>

        {{-- GRID --}}
        <div class="grid md:grid-cols-3 gap-8">

            {{-- CARD --}}
            <div class="bg-slate-50 rounded-[32px] p-8 border border-slate-100 hover:shadow-2xl transition duration-300">

                <div class="w-20 h-20 bg-orange-100 rounded-3xl flex items-center justify-center text-4xl mb-8">
                    📲
                </div>

                <h3 class="text-3xl font-extrabold text-slate-900 mb-5">
                    WhatsApp Ordenado
                </h3>

                <p class="text-slate-500 text-lg leading-relaxed">

                    Recibe pedidos estructurados automáticamente con dirección, productos y total.

                </p>

            </div>

            {{-- CARD --}}
            <div class="bg-slate-50 rounded-[32px] p-8 border border-slate-100 hover:shadow-2xl transition duration-300">

                <div class="w-20 h-20 bg-green-100 rounded-3xl flex items-center justify-center text-4xl mb-8">
                    🎨
                </div>

                <h3 class="text-3xl font-extrabold text-slate-900 mb-5">
                    Marca Personalizada
                </h3>

                <p class="text-slate-500 text-lg leading-relaxed">

                    Personaliza colores, logo, imágenes y categorías para tu negocio.

                </p>

            </div>

            {{-- CARD --}}
            <div class="bg-slate-50 rounded-[32px] p-8 border border-slate-100 hover:shadow-2xl transition duration-300">

                <div class="w-20 h-20 bg-blue-100 rounded-3xl flex items-center justify-center text-4xl mb-8">
                    💰
                </div>

                <h3 class="text-3xl font-extrabold text-slate-900 mb-5">
                    Sin Comisiones
                </h3>

                <p class="text-slate-500 text-lg leading-relaxed">

                    Vende directamente sin perder ganancias en plataformas externas.

                </p>

            </div>

        </div>

    </div>

</section>

{{-- PARTNERS --}}
<section id="partners" class="py-24 bg-slate-100">

    <div class="max-w-7xl mx-auto px-6">

        {{-- TITULO --}}
        <div class="text-center mb-16">

            <div class="text-orange-500 font-bold uppercase tracking-widest mb-4">
                Partners
            </div>

            <h2 class="text-5xl font-extrabold text-slate-900 mb-6">

                Negocios que ya usan FoodLink

            </h2>

        </div>

        {{-- GRID --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @for($i = 1; $i <= 4; $i++)

                <div class="bg-white rounded-[32px] overflow-hidden shadow-sm hover:shadow-2xl transition duration-300">

                    <img
                        src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=1200&auto=format&fit=crop"
                        class="w-full h-52 object-cover">

                    <div class="p-6">

                        <div class="text-2xl font-extrabold text-slate-900 mb-2">
                            Burger House
                        </div>

                        <div class="text-slate-500">
                            Delivery • Fast Food
                        </div>

                    </div>

                </div>

            @endfor

        </div>

    </div>

</section>

{{-- CTA FINAL --}}
<section id="demo" class="py-28 bg-black text-white relative overflow-hidden">

    <div class="absolute inset-0 bg-gradient-to-r from-orange-500/20 to-green-500/10"></div>

    <div class="relative max-w-5xl mx-auto px-6 text-center">

        <div class="text-orange-400 font-bold uppercase tracking-widest mb-6">
            Empieza hoy
        </div>

        <h2 class="text-5xl lg:text-6xl font-extrabold mb-8 leading-tight">

            Convierte tu negocio en una experiencia moderna de pedidos

        </h2>

        <p class="text-slate-300 text-xl leading-relaxed mb-12 max-w-3xl mx-auto">

            Lleva tráfico de TikTok, Instagram y Facebook directamente a pedidos reales mediante un catálogo interactivo optimizado para móviles.

        </p>

        <div class="flex flex-wrap justify-center gap-5">

            <a href="/register"
               class="bg-orange-500 hover:bg-orange-600 transition px-10 py-5 rounded-2xl font-bold text-xl shadow-2xl">

                🚀 Registrar mi negocio

            </a>

            <a href="/partners"
               class="bg-white/10 hover:bg-white/20 transition border border-white/10 px-10 py-5 rounded-2xl font-bold text-xl">

                Ver negocios

            </a>

        </div>

    </div>

</section>

{{-- FOOTER --}}
<footer class="bg-slate-950 text-slate-400 py-10 border-t border-white/5">

    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-5">

        <div>

            <div class="text-white text-2xl font-extrabold mb-2">
                FoodLink
            </div>

            <div class="text-sm">
                Marketplace Food Delivery © {{ date('Y') }}
            </div>

        </div>

        <div class="flex gap-6 text-sm">

            <a href="#"
               class="hover:text-white transition">
                Términos
            </a>

            <a href="#"
               class="hover:text-white transition">
                Privacidad
            </a>

            <a href="#"
               class="hover:text-white transition">
                Contacto
            </a>

        </div>

    </div>

</footer>

@endsection