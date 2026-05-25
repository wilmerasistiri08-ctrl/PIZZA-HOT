@extends('layouts.app')

@section('content')

<section class="relative min-h-screen overflow-hidden bg-[#050816] text-white">

    {{-- =========================================================
    BACKGROUND EFFECTS
    ========================================================= --}}

    <div class="absolute inset-0 overflow-hidden pointer-events-none">

        <div class="absolute -top-20 -left-20 w-[520px] h-[520px] bg-orange-500/20 blur-3xl rounded-full"></div>

        <div class="absolute -bottom-20 -right-20 w-[520px] h-[520px] bg-pink-500/20 blur-3xl rounded-full"></div>

        <div class="absolute top-1/2 left-1/2 w-[760px] h-[760px] -translate-x-1/2 -translate-y-1/2 bg-blue-500/10 blur-3xl rounded-full"></div>

        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.08),transparent_35%)]"></div>

    </div>

    {{-- =========================================================
    NAVBAR
    ========================================================= --}}

    <header class="relative z-50 border-b border-white/10 bg-black/20 backdrop-blur-xl">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-center justify-between h-20">

                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-3xl bg-gradient-to-br from-orange-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg shadow-orange-500/30">
                        🛍️
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

                {{-- NAV --}}
                <nav class="hidden lg:flex items-center gap-10">

                    <a href="{{ route('home') }}"
                       class="text-slate-300 hover:text-orange-400 transition duration-300">
                        Inicio
                    </a>

                    <a href="{{ route('partners') }}"
                       class="text-slate-300 hover:text-orange-400 transition duration-300">
                        Partners
                    </a>

                    <a href="{{ route('login') }}"
                       class="text-slate-300 hover:text-orange-400 transition duration-300">
                        Iniciar sesión
                    </a>

                </nav>

                {{-- CTA --}}
                <a href="{{ route('login') }}"
                   class="hidden md:inline-flex px-6 py-3 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 text-sm font-bold transition">
                    Ya tengo cuenta
                </a>

            </div>

        </div>

    </header>

    {{-- =========================================================
    CONTENT
    ========================================================= --}}

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20">

        <div class="grid lg:grid-cols-2 gap-20 items-start">

            {{-- =========================================================
            LEFT CONTENT
            ========================================================= --}}

            <div class="lg:sticky lg:top-28">

                {{-- BADGE --}}
                <div class="inline-flex items-center gap-3 px-5 py-3 rounded-full border border-white/10 bg-white/5 backdrop-blur-xl mb-8 shadow-2xl">

                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>

                    <span class="text-sm font-semibold text-white">
                        Crea tu tienda digital en minutos
                    </span>

                </div>

                {{-- TITLE --}}
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black leading-tight">

                    Registra tu negocio

                    <span class="block mt-3 bg-gradient-to-r from-orange-400 via-pink-500 to-rose-500 bg-clip-text text-transparent">

                        y empieza a vender

                    </span>

                </h1>

                {{-- DESCRIPTION --}}
                <p class="mt-10 text-xl text-slate-300 leading-relaxed max-w-2xl">

                    Crea un catálogo moderno para comida, ropa, tecnología,
                    belleza, snacks o cualquier producto de consumo.
                    Recibe pedidos ordenados por WhatsApp y comparte tu link
                    en TikTok, Instagram o Facebook.

                </p>

                {{-- BENEFIT CARDS --}}
                <div class="grid sm:grid-cols-2 gap-5 mt-14">

                    <div class="group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6 hover:-translate-y-1 hover:bg-white/10 transition duration-300">

                        <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 border border-emerald-400/20 flex items-center justify-center text-3xl mb-5">
                            📲
                        </div>

                        <h3 class="text-xl font-black mb-2">
                            Pedidos por WhatsApp
                        </h3>

                        <p class="text-slate-300 leading-relaxed">
                            Tus clientes compran desde el carrito y el pedido llega ordenado.
                        </p>

                    </div>

                    <div class="group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6 hover:-translate-y-1 hover:bg-white/10 transition duration-300">

                        <div class="w-14 h-14 rounded-2xl bg-orange-500/20 border border-orange-400/20 flex items-center justify-center text-3xl mb-5">
                            ⚡
                        </div>

                        <h3 class="text-xl font-black mb-2">
                            Activación rápida
                        </h3>

                        <p class="text-slate-300 leading-relaxed">
                            Tu tienda se genera automáticamente con un enlace personalizado.
                        </p>

                    </div>

                    <div class="group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6 hover:-translate-y-1 hover:bg-white/10 transition duration-300">

                        <div class="w-14 h-14 rounded-2xl bg-cyan-500/20 border border-cyan-400/20 flex items-center justify-center text-3xl mb-5">
                            🛒
                        </div>

                        <h3 class="text-xl font-black mb-2">
                            Catálogo profesional
                        </h3>

                        <p class="text-slate-300 leading-relaxed">
                            Productos, categorías, precios, disponibilidad y carrito flotante.
                        </p>

                    </div>

                    <div class="group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6 hover:-translate-y-1 hover:bg-white/10 transition duration-300">

                        <div class="w-14 h-14 rounded-2xl bg-pink-500/20 border border-pink-400/20 flex items-center justify-center text-3xl mb-5">
                            🚀
                        </div>

                        <h3 class="text-xl font-black mb-2">
                            Link para redes
                        </h3>

                        <p class="text-slate-300 leading-relaxed">
                            Comparte tu tienda en TikTok, Instagram, Facebook o WhatsApp.
                        </p>

                    </div>

                </div>

            </div>

            {{-- =========================================================
            REGISTER FORM
            ========================================================= --}}

            <div class="relative">

                {{-- GLOW --}}
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-500 via-pink-500 to-purple-600 rounded-[42px] blur opacity-40"></div>

                {{-- CARD --}}
                <div class="relative rounded-[42px] border border-white/10 bg-white/10 backdrop-blur-2xl shadow-[0_20px_80px_rgba(0,0,0,0.45)] overflow-hidden">

                    {{-- FORM HEADER --}}
                    <div class="p-8 md:p-10 border-b border-white/10">

                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-500/15 border border-orange-400/20 text-orange-300 text-sm font-bold mb-6">
                            Nuevo negocio
                        </div>

                        <h2 class="text-4xl md:text-5xl font-black">
                            Completa tus datos
                        </h2>

                        <p class="mt-4 text-slate-300 leading-relaxed">
                            Estos datos se usarán para crear tu tienda pública y tu acceso al panel.
                        </p>

                    </div>

                    {{-- ALERTS --}}
                    <div class="px-8 md:px-10 pt-8">

                        @if(session('success'))

                            <div class="mb-6 rounded-2xl border border-green-400/20 bg-green-500/20 px-5 py-4 text-green-300">
                                {{ session('success') }}
                            </div>

                        @endif

                        @if($errors->any())

                            <div class="mb-6 rounded-2xl border border-red-400/20 bg-red-500/20 px-5 py-4 text-red-300">

                                <p class="font-bold mb-3">
                                    Revisa los siguientes campos:
                                </p>

                                <ul class="space-y-2 text-sm">

                                    @foreach($errors->all() as $error)

                                        <li>
                                            • {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif

                    </div>

                    {{-- FORM --}}
                    <form
                        action="{{ route('register.business') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="px-8 md:px-10 pb-10 space-y-8">

                        @csrf

                        {{-- BUSINESS DATA --}}
                        <div>

                            <h3 class="text-xl font-black mb-5 flex items-center gap-3">
                                <span class="w-10 h-10 rounded-2xl bg-orange-500/20 flex items-center justify-center">
                                    🏪
                                </span>
                                Datos del negocio
                            </h3>

                            <div class="grid md:grid-cols-2 gap-5">

                                {{-- NAME --}}
                                <div class="md:col-span-2">

                                    <label for="name" class="block text-sm font-bold text-slate-200 mb-3">
                                        Nombre del negocio
                                    </label>

                                    <input
                                        id="name"
                                        type="text"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Ej: Pizza Imperial"
                                        required
                                        class="w-full rounded-2xl border border-white/10 bg-white/10 px-6 py-5 text-white placeholder:text-slate-400 focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20 transition">

                                </div>

                                {{-- SLUG --}}
                                <div class="md:col-span-2">

                                    <label for="slug" class="block text-sm font-bold text-slate-200 mb-3">
                                        Enlace personalizado
                                    </label>

                                    <div class="flex items-center rounded-2xl border border-white/10 bg-white/10 overflow-hidden focus-within:border-orange-400 focus-within:ring-4 focus-within:ring-orange-500/20 transition">

                                        <span class="px-5 text-slate-400 text-sm whitespace-nowrap border-r border-white/10">
                                            {{ url('/') }}/
                                        </span>

                                        <input
                                            id="slug"
                                            type="text"
                                            name="slug"
                                            value="{{ old('slug') }}"
                                            placeholder="pizza-imperial"
                                            required
                                            class="w-full bg-transparent px-4 py-5 text-white placeholder:text-slate-400 focus:outline-none">

                                    </div>

                                    <p class="mt-2 text-xs text-slate-400">
                                        Usa solo letras, números y guiones. Ejemplo: pizza-imperial
                                    </p>

                                </div>

                                {{-- WHATSAPP --}}
                                <div>

                                    <label for="whatsapp_number" class="block text-sm font-bold text-slate-200 mb-3">
                                        WhatsApp del negocio
                                    </label>

                                    <div class="flex items-center rounded-2xl border border-white/10 bg-white/10 overflow-hidden focus-within:border-orange-400 focus-within:ring-4 focus:ring-orange-500/20 transition">

                                        <span class="px-5 text-slate-400 border-r border-white/10">
                                            +591
                                        </span>

                                        <input
                                            id="whatsapp_number"
                                            type="text"
                                            name="whatsapp_number"
                                            value="{{ old('whatsapp_number') }}"
                                            placeholder="77777777"
                                            required
                                            class="w-full bg-transparent px-4 py-5 text-white placeholder:text-slate-400 focus:outline-none">

                                    </div>

                                </div>

                                {{-- SCHEDULE --}}
                                <div>

                                    <label for="schedule" class="block text-sm font-bold text-slate-200 mb-3">
                                        Horario
                                    </label>

                                    <input
                                        id="schedule"
                                        type="text"
                                        name="schedule"
                                        value="{{ old('schedule') }}"
                                        placeholder="10:00 - 22:00"
                                        class="w-full rounded-2xl border border-white/10 bg-white/10 px-6 py-5 text-white placeholder:text-slate-400 focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20 transition">

                                </div>

                                {{-- ADDRESS --}}
                                <div class="md:col-span-2">

                                    <label for="address" class="block text-sm font-bold text-slate-200 mb-3">
                                        Dirección
                                    </label>

                                    <input
                                        id="address"
                                        type="text"
                                        name="address"
                                        value="{{ old('address') }}"
                                        placeholder="Ej: Av. Busch #120"
                                        required
                                        class="w-full rounded-2xl border border-white/10 bg-white/10 px-6 py-5 text-white placeholder:text-slate-400 focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20 transition">

                                </div>

                                {{-- GOOGLE MAPS --}}
                                <div class="md:col-span-2">

                                    <label for="google_maps" class="block text-sm font-bold text-slate-200 mb-3">
                                        Enlace exacto de Google Maps
                                    </label>

                                    <input
                                        id="google_maps"
                                        type="url"
                                        name="google_maps"
                                        value="{{ old('google_maps') }}"
                                        placeholder="https://maps.google.com/..."
                                        required
                                        class="w-full rounded-2xl border border-white/10 bg-white/10 px-6 py-5 text-white placeholder:text-slate-400 focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20 transition">

                                </div>

                                {{-- TIKTOK --}}
                                <div>

                                    <label for="tiktok" class="block text-sm font-bold text-slate-200 mb-3">
                                        Usuario TikTok
                                    </label>

                                    <input
                                        id="tiktok"
                                        type="text"
                                        name="tiktok"
                                        value="{{ old('tiktok') }}"
                                        placeholder="@pizzaimperial"
                                        class="w-full rounded-2xl border border-white/10 bg-white/10 px-6 py-5 text-white placeholder:text-slate-400 focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20 transition">

                                </div>

                                {{-- LOGO --}}
                                <div>

                                    <label for="logo" class="block text-sm font-bold text-slate-200 mb-3">
                                        Logo del negocio
                                    </label>

                                    <div class="rounded-2xl border border-dashed border-white/20 bg-white/5 p-4 hover:bg-white/10 transition">

                                        <input
                                            id="logo"
                                            type="file"
                                            name="logo"
                                            accept="image/png,image/jpeg,image/jpg,image/webp"
                                            class="w-full text-sm text-slate-300 file:mr-4 file:rounded-xl file:border-0 file:bg-orange-500 file:px-5 file:py-3 file:font-bold file:text-white hover:file:bg-orange-600">

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- OWNER DATA --}}
                        <div class="pt-4 border-t border-white/10">

                            <h3 class="text-xl font-black mb-5 flex items-center gap-3">
                                <span class="w-10 h-10 rounded-2xl bg-pink-500/20 flex items-center justify-center">
                                    👤
                                </span>
                                Acceso del propietario
                            </h3>

                            <div class="grid md:grid-cols-2 gap-5">

                                {{-- OWNER NAME --}}
                                <div class="md:col-span-2">

                                    <label for="owner_name" class="block text-sm font-bold text-slate-200 mb-3">
                                        Nombre del propietario
                                    </label>

                                    <input
                                        id="owner_name"
                                        type="text"
                                        name="owner_name"
                                        value="{{ old('owner_name') }}"
                                        placeholder="Ej: Juan Pérez"
                                        class="w-full rounded-2xl border border-white/10 bg-white/10 px-6 py-5 text-white placeholder:text-slate-400 focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20 transition">

                                </div>

                                {{-- EMAIL --}}
                                <div class="md:col-span-2">

                                    <label for="email" class="block text-sm font-bold text-slate-200 mb-3">
                                        Correo de acceso
                                    </label>

                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="correo@negocio.com"
                                        required
                                        class="w-full rounded-2xl border border-white/10 bg-white/10 px-6 py-5 text-white placeholder:text-slate-400 focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20 transition">

                                </div>

                                {{-- PASSWORD --}}
                                <div>

                                    <label for="password" class="block text-sm font-bold text-slate-200 mb-3">
                                        Contraseña
                                    </label>

                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        placeholder="Mínimo 8 caracteres"
                                        class="w-full rounded-2xl border border-white/10 bg-white/10 px-6 py-5 text-white placeholder:text-slate-400 focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20 transition">

                                    <p class="mt-2 text-xs text-slate-400">
                                        Si lo dejas vacío, se usará: 12345678
                                    </p>

                                </div>

                                {{-- PASSWORD CONFIRMATION --}}
                                <div>

                                    <label for="password_confirmation" class="block text-sm font-bold text-slate-200 mb-3">
                                        Confirmar contraseña
                                    </label>

                                    <input
                                        id="password_confirmation"
                                        type="password"
                                        name="password_confirmation"
                                        placeholder="Repite la contraseña"
                                        class="w-full rounded-2xl border border-white/10 bg-white/10 px-6 py-5 text-white placeholder:text-slate-400 focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20 transition">

                                </div>

                            </div>

                        </div>

                        {{-- SUBMIT --}}
                        <button
                            type="submit"
                            class="group relative w-full overflow-hidden rounded-2xl bg-gradient-to-r from-orange-500 via-pink-500 to-rose-500 py-5 text-xl font-black text-white shadow-[0_15px_50px_rgba(249,115,22,0.4)] transition duration-300 hover:scale-[1.02]">

                            <span class="relative z-10">
                                Crear mi tienda digital
                            </span>

                            <div class="absolute inset-0 bg-white/10 opacity-0 transition group-hover:opacity-100"></div>

                        </button>

                        {{-- FOOTER NOTE --}}
                        <p class="text-center text-sm text-slate-400 leading-relaxed">

                            Al registrar tu negocio se creará automáticamente tu tienda,
                            tu usuario propietario y categorías iniciales.

                        </p>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection