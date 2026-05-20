<nav class="fixed top-0 left-0 w-full z-50 border-b border-white/10 bg-[#050816]/80 backdrop-blur-2xl">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between h-20">

            {{-- LOGO --}}
            <a
                href="{{ route('home') }}"
                class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-2xl bg-gradient-to-r from-orange-500 via-pink-500 to-rose-500 flex items-center justify-center text-white font-black text-xl shadow-lg">

                    F

                </div>

                <div>

                    <h1 class="text-2xl font-black text-white leading-none">

                        FoodLink

                    </h1>

                    <p class="text-xs text-slate-400">

                        TikTok Ordering Platform

                    </p>

                </div>

            </a>

            {{-- MENU DESKTOP --}}
            <div class="hidden lg:flex items-center gap-10">

                <a
                    href="{{ route('home') }}"
                    class="text-slate-300 hover:text-white transition font-medium">

                    Inicio

                </a>

                <a
                    href="{{ route('partners') }}"
                    class="text-slate-300 hover:text-white transition font-medium">

                    Partners

                </a>

                <a
                    href="{{ route('register.business.form') }}"
                    class="text-slate-300 hover:text-white transition font-medium">

                    Registrar negocio

                </a>

            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-4">

                @auth

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="hidden md:flex items-center gap-2 px-6 py-3 rounded-2xl bg-white/10 border border-white/10 text-white hover:bg-white/20 transition font-semibold">

                        Dashboard

                    </a>

                    <form
                        method="POST"
                        action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="submit"
                            class="px-6 py-3 rounded-2xl bg-gradient-to-r from-red-500 to-pink-500 text-white font-bold hover:scale-105 transition">

                            Salir

                        </button>

                    </form>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="hidden md:flex items-center gap-2 px-6 py-3 rounded-2xl border border-white/10 bg-white/5 text-white hover:bg-white/10 transition font-semibold">

                        Iniciar sesión

                    </a>

                    <a
                        href="{{ route('register.business.form') }}"
                        class="px-6 py-3 rounded-2xl bg-gradient-to-r from-orange-500 via-pink-500 to-rose-500 text-white font-black shadow-[0_10px_40px_rgba(249,115,22,0.35)] hover:scale-105 transition duration-300">

                        Crear tienda

                    </a>

                @endauth

            </div>

        </div>

    </div>

</nav>