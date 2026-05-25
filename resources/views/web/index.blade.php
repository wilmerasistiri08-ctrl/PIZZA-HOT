@extends('layouts.app')

@section('content')

{{-- =========================================================
HERO SECTION
========================================================= --}}

<section class="relative min-h-screen overflow-hidden bg-[#050816] pt-32">

    {{-- AGREGADO: PARTÍCULAS DE FONDO ANIMADAS --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute w-2 h-2 bg-orange-400 rounded-full animate-float-random" style="top: 10%; left: 20%;"></div>
        <div class="absolute w-3 h-3 bg-pink-400 rounded-full animate-float-random" style="top: 30%; left: 70%; animation-delay: 2s;"></div>
        <div class="absolute w-2 h-2 bg-cyan-400 rounded-full animate-float-random" style="top: 60%; left: 15%; animation-delay: 4s;"></div>
        <div class="absolute w-4 h-4 bg-emerald-400 rounded-full animate-float-random" style="top: 80%; left: 50%; animation-delay: 1s;"></div>
        <div class="absolute w-2 h-2 bg-purple-400 rounded-full animate-float-random" style="top: 40%; left: 85%; animation-delay: 3s;"></div>
    </div>

    {{-- BACKGROUND EFFECTS --}}
    <div class="absolute inset-0 overflow-hidden">

        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-500/20 blur-3xl rounded-full animate-pulse"></div>

        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-pink-500/20 blur-3xl rounded-full animate-pulse"></div>

        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-blue-500/10 blur-3xl rounded-full"></div>

    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20">

        <div class="grid lg:grid-cols-2 gap-24 items-center">

            {{-- LEFT CONTENT --}}
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

                        <span class="relative z-10">Registrar negocio</span>

                        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition"></div>

                    </a>

                    <a
                        href="#benefits"
                        class="px-10 py-5 rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl text-white text-lg font-semibold hover:bg-white/10 transition">

                        Ver beneficios

                    </a>

                </div>

                {{-- BENEFITS --}}
                <div id="benefits" class="grid sm:grid-cols-2 gap-5 mt-16">

                    <div class="group rounded-3xl border border-emerald-400/20 bg-emerald-500/10 backdrop-blur-xl p-6 hover:-translate-y-2 transition duration-500">

                        <div class="w-14 h-14 rounded-2xl bg-emerald-400/20 flex items-center justify-center text-3xl mb-5">📲</div>

                        <h3 class="text-white font-bold text-xl mb-2">Pedidos automáticos</h3>

                        <p class="text-slate-300 leading-relaxed">WhatsApp integrado para cerrar ventas rápidamente.</p>

                    </div>

                    <div class="group rounded-3xl border border-orange-400/20 bg-orange-500/10 backdrop-blur-xl p-6 hover:-translate-y-2 transition duration-500">

                        <div class="w-14 h-14 rounded-2xl bg-orange-400/20 flex items-center justify-center text-3xl mb-5">⚡</div>

                        <h3 class="text-white font-bold text-xl mb-2">Activación rápida</h3>

                        <p class="text-slate-300 leading-relaxed">Tu tienda lista para compartir en minutos.</p>

                    </div>

                    <div class="group rounded-3xl border border-cyan-400/20 bg-cyan-500/10 backdrop-blur-xl p-6 hover:-translate-y-2 transition duration-500">

                        <div class="w-14 h-14 rounded-2xl bg-cyan-400/20 flex items-center justify-center text-3xl mb-5">🎨</div>

                        <h3 class="text-white font-bold text-xl mb-2">Diseño profesional</h3>

                        <p class="text-slate-300 leading-relaxed">Catálogo premium optimizado para móviles.</p>

                    </div>

                    <div class="group rounded-3xl border border-pink-400/20 bg-pink-500/10 backdrop-blur-xl p-6 hover:-translate-y-2 transition duration-500">

                        <div class="w-14 h-14 rounded-2xl bg-pink-400/20 flex items-center justify-center text-3xl mb-5">🚀</div>

                        <h3 class="text-white font-bold text-xl mb-2">Link personalizado</h3>

                        <p class="text-slate-300 leading-relaxed">Comparte tu tienda en TikTok e Instagram.</p>

                    </div>

                </div>

            </div>

            {{-- RIGHT PHONE MOCKUP --}}
            <div class="relative flex justify-center">

                {{-- FLOATING CARD --}}
                <div class="absolute -top-8 -left-2 lg:-left-10 z-20 bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl p-5 shadow-2xl animate-bounce">

                    {{-- AGREGADO: Badge NUEVO --}}
                    <div class="absolute -top-2 -right-2 bg-gradient-to-r from-orange-500 to-pink-500 text-white text-xs px-2 py-0.5 rounded-full shadow-lg animate-bounce">🔥 NUEVO</div>

                    <h3 class="text-2xl font-black text-white">+120 pedidos</h3>

                    <p class="text-emerald-400 text-sm">hoy</p>

                </div>

                {{-- PHONE --}}
                <div class="relative w-[360px] rounded-[50px] border-[10px] border-slate-800 bg-black overflow-hidden shadow-[0_0_80px_rgba(249,115,22,.25)]">

                    <div class="flex items-center justify-between p-5 border-b border-white/10 bg-slate-900">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-2xl bg-orange-500 flex items-center justify-center text-2xl">🍔</div>

                            <div>

                                <h3 class="font-bold text-white">Burger Pro</h3>

                                <p class="text-emerald-400 text-sm">● Abierto ahora</p>

                            </div>

                        </div>

                        <div class="bg-white/10 px-4 py-2 rounded-full text-sm text-white">Delivery</div>

                    </div>

                    {{-- AGREGADO: Efecto parallax en imagen --}}
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1200" class="w-full h-80 object-cover group-hover:scale-105 transition duration-700" alt="FoodLink">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    </div>

                    <div class="bg-slate-900 p-6">

                        <div class="flex justify-between items-center">

                            <div>

                                <h2 class="text-2xl font-black text-white">Hamburguesa Doble</h2>

                                <p class="text-slate-400">Compra rápida desde TikTok</p>

                                {{-- AGREGADO: Badges de estadísticas --}}
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="bg-orange-500/20 text-orange-300 text-xs px-2 py-1 rounded-full">🔥 245 vendidas</span>
                                    <span class="bg-emerald-500/20 text-emerald-300 text-xs px-2 py-1 rounded-full">⭐ 4.9 (128)</span>
                                </div>

                            </div>

                            <div class="text-orange-400 text-3xl font-black">Bs 45</div>

                        </div>

                        <button class="w-full mt-6 bg-gradient-to-r from-orange-500 to-pink-500 hover:opacity-90 transition py-5 rounded-2xl text-lg font-black text-white">+ Agregar al carrito</button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- =========================================================
CONTENIDO ADICIONAL - MISMO FONDO OSCURO
========================================================= --}}

<div class="relative bg-[#050816] overflow-hidden">

    {{-- AGREGADO: Partículas de fondo --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute w-2 h-2 bg-orange-400 rounded-full animate-float-random" style="top: 15%; left: 10%; animation-delay: 1s;"></div>
        <div class="absolute w-2 h-2 bg-pink-400 rounded-full animate-float-random" style="top: 50%; left: 85%; animation-delay: 3s;"></div>
        <div class="absolute w-3 h-3 bg-cyan-400 rounded-full animate-float-random" style="top: 70%; left: 25%; animation-delay: 2s;"></div>
    </div>

    {{-- BACKGROUND EFFECTS IGUALES AL HERO --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-500/10 blur-3xl rounded-full"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-pink-500/10 blur-3xl rounded-full"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-blue-500/5 blur-3xl rounded-full"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-16">


        {{-- SECCIÓN 1: Historias de Éxito --}}
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-white mb-6">Historias de Éxito</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-orange-400/50 transition">

                    {{-- AGREGADO: Indicador de nuevo --}}
                    <div class="flex justify-end -mt-2 -mr-2 mb-2">
                        <span class="bg-green-500/20 text-green-400 text-xs px-2 py-0.5 rounded-full">✨ Destacado</span>
                    </div>

                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-3xl">📲</span>
                        <h3 class="font-bold text-xl text-white">Pedidos automáticos</h3>
                    </div>
                    <p class="text-slate-300">Pedidos automatizados para restaurantes, hamburguesas, cafeterías, snacks y negocios modernos que venden desde redes sociales.</p>

                    {{-- AGREGADO: Barra de progreso animada --}}
                    <div class="mt-4 w-full bg-white/5 rounded-full h-1">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-1 rounded-full w-0 group-hover:w-full transition-all duration-1000"></div>
                    </div>
                </div>
                <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-amber-400/50 transition">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-3xl">📊</span>
                        <h3 class="font-bold text-xl text-white">Estímulos de Título y Consumo Real</h3>
                    </div>
                    <div class="flex gap-6 mt-3">
                        <div><p class="text-3xl font-bold text-orange-400">7.000+</p><p class="text-sm text-slate-400">de ventas</p></div>
                        <div><p class="text-3xl font-bold text-orange-400">10k</p><p class="text-sm text-slate-400">nuevos seguidores</p></div>
                    </div>

                    {{-- AGREGADO: Barra de progreso animada --}}
                    <div class="mt-4 w-full bg-white/5 rounded-full h-1">
                        <div class="bg-gradient-to-r from-orange-500 to-amber-500 h-1 rounded-full w-0 group-hover:w-full transition-all duration-1000"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECCIÓN 2: Restaurantes destacados --}}
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-orange-400/50 transition">
                <div class="flex items-center gap-3 mb-3"><span class="text-4xl">☕</span><h3 class="font-bold text-xl text-white">Café Central</h3></div>
                <p class="text-3xl font-bold text-green-400">+25%</p><p class="text-sm text-slate-400">de ventas</p>
                <p class="text-sm text-orange-400 mt-2">📈 10k nuevos seguidores</p>

                {{-- AGREGADO: Barra de progreso animada --}}
                <div class="mt-3 w-full bg-white/5 rounded-full h-1">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-1 rounded-full w-0 group-hover:w-full transition-all duration-1000"></div>
                </div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-orange-400/50 transition">
                <div class="flex items-center gap-3 mb-3"><span class="text-4xl">🍽️</span><h3 class="font-bold text-xl text-white">Restaurantes</h3></div>
                <p class="text-3xl font-bold text-green-400">+50%</p><p class="text-sm text-slate-400">de ventas</p>
                <p class="text-sm text-orange-400 mt-2">📈 10k nuevos seguidores</p>

                {{-- AGREGADO: Barra de progreso animada --}}
                <div class="mt-3 w-full bg-white/5 rounded-full h-1">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-1 rounded-full w-0 group-hover:w-full transition-all duration-1000"></div>
                </div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-orange-400/50 transition">
                <div class="flex items-center gap-3 mb-3"><span class="text-4xl">🍔</span><h3 class="font-bold text-xl text-white">Hamburguesa Tik Tok</h3></div>
                <p class="text-slate-300">Comprar o cuarto en minutos</p>
                <div class="mt-3 flex gap-2"><span class="bg-orange-500/20 text-orange-300 text-xs px-2 py-1 rounded-full">🔥 Tendencia</span><span class="bg-pink-500/20 text-pink-300 text-xs px-2 py-1 rounded-full">🎵 Viral</span></div>
            </div>
        </div>

        {{-- SECCIÓN 3: Integración de Redes Sociales --}}
        <div class="bg-gradient-to-r from-orange-500/20 to-pink-500/20 backdrop-blur-xl rounded-2xl p-8 border border-white/10 mb-12 relative overflow-hidden">
            
            {{-- AGREGADO: Efecto glow al hacer hover --}}
            <div class="absolute -inset-0.5 bg-gradient-to-r from-orange-500 to-pink-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-30 transition duration-700"></div>
            
            <h2 class="text-3xl font-bold text-white mb-6">Integración de Redes Sociales</h2>
            <div class="flex flex-wrap gap-8">
                <div class="flex items-center gap-3 bg-white/10 rounded-full px-5 py-2 hover:shadow-[0_0_20px_rgba(255,255,255,0.1)] transition"><span class="text-3xl">🎵</span><span class="font-bold text-white">TikTok</span></div>
                <div class="flex items-center gap-3 bg-white/10 rounded-full px-5 py-2 hover:shadow-[0_0_20px_rgba(255,255,255,0.1)] transition"><span class="text-3xl">📷</span><span class="font-bold text-white">Instagram</span></div>
                <div class="flex items-center gap-3 bg-white/10 rounded-full px-5 py-2 hover:shadow-[0_0_20px_rgba(255,255,255,0.1)] transition"><span class="text-3xl">💬</span><span class="font-bold text-white">WhatsApp</span></div>
            </div>
        </div>

        {{-- SECCIÓN 4: Historias de Éxito 2 --}}
        <div class="grid md:grid-cols-2 gap-6 mb-12">
            <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-red-400/50 transition">
                <div class="flex items-center gap-3 mb-3"><span class="text-3xl">⭐</span><h3 class="font-bold text-xl text-white">El Tío Julio</h3></div>
                <div class="flex gap-6"><div><p class="text-3xl font-bold text-green-400">100%</p><p class="text-sm text-slate-400">de ventas</p></div><div><p class="text-3xl font-bold text-orange-400">10k</p><p class="text-sm text-slate-400">nuevos seguidores</p></div></div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-orange-400/50 transition">
                <div class="flex items-center gap-3 mb-3"><span class="text-3xl">📲</span><h3 class="font-bold text-xl text-white">Pedidos automáticos</h3></div>
                <p class="text-slate-300">Ventas automatizadas para restaurantes, hamburguesas, cafeterías, snacks y negocios modernos que venden desde redes sociales.</p>
            </div>
        </div>

        {{-- SECCIÓN 5: Características --}}
        <div class="grid md:grid-cols-2 gap-6 mb-12">
            <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-orange-400/50 transition">
                <div class="flex items-center gap-3 mb-3"><span class="text-4xl">⚡</span><h3 class="font-bold text-xl text-white">Actividad rápida</h3></div>
                <p class="text-slate-300">Actividades rápidas para restaurantes, hamburguesas, cafeterías, snacks y negocios modernos que venden desde redes sociales.</p>
            </div>
            <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-orange-400/50 transition">
                <div class="flex items-center gap-3 mb-3"><span class="text-4xl">🎨</span><h3 class="font-bold text-xl text-white">Diseño profesional</h3></div>
                <p class="text-slate-300">Diseño profesional con un diseño personalizado para cada negocio.</p>
            </div>
        </div>

        {{-- SECCIÓN 6: Integración de Redes Sociales 2 --}}
        <div class="bg-gradient-to-r from-amber-500/20 to-orange-500/20 backdrop-blur-xl rounded-2xl p-8 border border-white/10 mb-12">
            <h2 class="text-3xl font-bold text-white mb-6">Integración de Redes Sociales</h2>
            <div class="flex flex-wrap gap-8">
                <div class="flex items-center gap-3 bg-white/10 rounded-full px-5 py-2 hover:shadow-[0_0_20px_rgba(255,255,255,0.1)] transition"><span class="text-3xl">📘</span><span class="font-bold text-white">Facebook</span></div>
                <div class="flex items-center gap-3 bg-white/10 rounded-full px-5 py-2 hover:shadow-[0_0_20px_rgba(255,255,255,0.1)] transition"><span class="text-3xl">📷</span><span class="font-bold text-white">Instagram</span></div>
                <div class="flex items-center gap-3 bg-white/10 rounded-full px-5 py-2 hover:shadow-[0_0_20px_rgba(255,255,255,0.1)] transition"><span class="text-3xl">👻</span><span class="font-bold text-white">Snapchat</span></div>
            </div>
        </div>

        {{-- SECCIÓN 7: Contact Center --}}
        <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-8 border border-white/10 mb-12">
            <h2 class="text-3xl font-bold text-white mb-6">Contact Center</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div><p class="text-slate-300"><span class="font-semibold text-white">📞 Nombre:</span> +1 739 638 7887</p><p class="text-slate-300 mt-3"><span class="font-semibold text-white">📱 Contacto:</span> +1 739 638 5888</p></div>
                <div><p class="text-slate-300"><span class="font-semibold text-white">✉️ Email:</span> info@foodlink.com</p><p class="text-slate-300 mt-3"><span class="font-semibold text-white">📜 Aviso legal:</span> <a href="#" class="text-orange-400 hover:underline">Política de privacidad</a></p><p class="text-slate-300 mt-1"><span class="font-semibold text-white">📋 Términos de servicio:</span> <a href="#" class="text-orange-400 hover:underline">ver más</a></p></div>
            </div>
        </div>

        {{-- SECCIÓN 8: Estadísticas en Tiempo Real --}}
        <div class="bg-gradient-to-r from-red-500/20 to-orange-500/20 backdrop-blur-xl rounded-2xl p-8 border border-white/10 mb-12">
            <h2 class="text-3xl font-bold text-white mb-6">Estadísticas en Tiempo Real</h2>
            <div class="flex flex-wrap gap-8 mb-6">
                <div class="flex items-center gap-3 bg-white/10 rounded-full px-5 py-2"><span class="text-3xl">🎵</span><span class="font-bold text-white">TikTok</span></div>
                <div class="flex items-center gap-3 bg-white/10 rounded-full px-5 py-2"><span class="text-3xl">📷</span><span class="font-bold text-white">Instagram</span></div>
                <div class="flex items-center gap-3 bg-white/10 rounded-full px-5 py-2"><span class="text-3xl">💬</span><span class="font-bold text-white">WhatsApp</span></div>
            </div>
            <div class="grid grid-cols-3 gap-4 text-center">
                <div class="bg-white/10 backdrop-blur rounded-xl p-3"><p class="text-2xl font-bold text-white">+150%</p><p class="text-sm text-slate-300">Engagement</p></div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-3"><p class="text-2xl font-bold text-white">+200%</p><p class="text-sm text-slate-300">Alcance</p></div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-3"><p class="text-2xl font-bold text-white">+85%</p><p class="text-sm text-slate-300">Conversión</p></div>
            </div>
        </div>

        {{-- SECCIÓN 9: Zonas de Mayor Crecimiento --}}
        <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-8 border border-white/10 mb-12">
            <h2 class="text-3xl font-bold text-white mb-6">Zonas de Mayor Crecimiento</h2>
            <div class="space-y-4 mb-8">
                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl"><span class="text-3xl">🍔</span><span class="text-slate-300 font-medium">Hamburguesa Doble vendida en TikTok</span><span class="ml-auto text-orange-400 text-sm font-bold">🔥 +235%</span></div>
                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl"><span class="text-3xl">☕</span><span class="text-slate-300 font-medium">Café Latte pedido en Instagram</span><span class="ml-auto text-orange-400 text-sm font-bold">📈 +189%</span></div>
            </div>
            <h3 class="text-2xl font-bold text-white mb-4">Últimas Tiendas Creadas</h3>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="bg-white/5 rounded-xl p-4 border border-white/10 hover:border-orange-400/50 transition"><div class="flex items-center gap-2 mb-2"><span class="text-2xl">🌮</span><h4 class="font-bold text-white">Taco Palace</h4></div><p class="text-xs text-slate-400">Compra tapa deliciosa</p><p class="text-xs text-orange-400 mt-2">🕒 Abierto ahora</p></div>
                <div class="bg-white/5 rounded-xl p-4 border border-white/10 hover:border-orange-400/50 transition"><div class="flex items-center gap-2 mb-2"><span class="text-2xl">🍕</span><h4 class="font-bold text-white">Pizzeria del Sol</h4></div><p class="text-xs text-slate-400">Compra tapa deliciosa</p><p class="text-xs text-orange-400 mt-2">🔥 100+ pedidos</p></div>
                <div class="bg-white/5 rounded-xl p-4 border border-white/10 hover:border-orange-400/50 transition"><div class="flex items-center gap-2 mb-2"><span class="text-2xl">🍕</span><h4 class="font-bold text-white">Pizzeria del Sol II</h4></div><p class="text-xs text-slate-400">Compra tapa deliciosa</p><p class="text-xs text-orange-400 mt-2">✨ Nueva sucursal</p></div>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="border-t border-white/10 pt-6 text-center">
            <p class="text-sm text-slate-400">© 2025 FoodLink. Todos los derechos reservados.</p>

            {{-- AGREGADO: Redes sociales en footer --}}
            <div class="flex justify-center gap-6 mt-4">
                <a href="#" class="text-slate-400 hover:text-orange-400 transition">Twitter</a>
                <a href="#" class="text-slate-400 hover:text-orange-400 transition">LinkedIn</a>
                <a href="#" class="text-slate-400 hover:text-orange-400 transition">Facebook</a>
                <a href="#" class="text-slate-400 hover:text-orange-400 transition">Instagram</a>
            </div>
        </div>

    </div>

</div>

{{-- AGREGADO: Estilos para las nuevas animaciones --}}
<style>
    @keyframes float-random {
        0%, 100% { transform: translateY(0px) translateX(0px); opacity: 0; }
        50% { transform: translateY(-20px) translateX(10px); opacity: 1; }
    }
    .animate-float-random {
        animation: float-random 6s ease-in-out infinite;
    }
    
    /* Para que las barras de progreso funcionen con hover */
    .group:hover .group-hover\:w-full {
        width: 100%;
    }
</style>

@endsection