@extends('layouts.app')

@section('content')

<section class="min-h-screen bg-slate-100 py-20">

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            {{-- LEFT --}}
            <div>

                <span class="bg-orange-100 text-orange-600 px-5 py-2 rounded-full text-sm font-bold">
                    FoodLink SaaS
                </span>

                <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 mt-6 leading-tight">

                    Convierte tus visitas de TikTok
                    en pedidos reales

                </h1>

                <p class="text-xl text-slate-500 mt-8 leading-relaxed">

                    Crea tu menú digital, recibe pedidos automáticos por WhatsApp
                    y controla tus productos en tiempo real.

                </p>

                {{-- BENEFITS --}}
                <div class="mt-10 space-y-5">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center text-2xl">
                            📲
                        </div>

                        <div>

                            <h3 class="font-bold text-slate-800">
                                Pedidos automáticos
                            </h3>

                            <p class="text-slate-500">
                                WhatsApp integrado directamente.
                            </p>

                        </div>

                    </div>

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 bg-orange-100 rounded-2xl flex items-center justify-center text-2xl">
                            ⚡
                        </div>

                        <div>

                            <h3 class="font-bold text-slate-800">
                                Activación rápida
                            </h3>

                            <p class="text-slate-500">
                                Tu negocio listo en minutos.
                            </p>

                        </div>

                    </div>

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-2xl">
                            🎨
                        </div>

                        <div>

                            <h3 class="font-bold text-slate-800">
                                Personalización total
                            </h3>

                            <p class="text-slate-500">
                                Diseña tu propia experiencia.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            {{-- FORM --}}
            <div>

                <div class="bg-white rounded-3xl shadow-2xl p-10 border border-slate-200">

                    <h2 class="text-3xl font-bold text-slate-900 mb-2">

                        Registrar mi negocio

                    </h2>

                    <p class="text-slate-500 mb-8">

                        Solicita acceso a FoodLink.

                    </p>

                    <form class="space-y-6">

                        {{-- BUSINESS --}}
                        <div>

                            <label class="block mb-2 font-semibold text-slate-700">

                                Nombre del negocio

                            </label>

                            <input
                                type="text"
                                class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200"
                                placeholder="Ej: Hamburguesas Pro"
                            >

                        </div>

                        {{-- OWNER --}}
                        <div>

                            <label class="block mb-2 font-semibold text-slate-700">

                                Nombre del propietario

                            </label>

                            <input
                                type="text"
                                class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200"
                                placeholder="Tu nombre"
                            >

                        </div>

                        {{-- PHONE --}}
                        <div>

                            <label class="block mb-2 font-semibold text-slate-700">

                                WhatsApp

                            </label>

                            <input
                                type="text"
                                class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200"
                                placeholder="77777777"
                            >

                        </div>

                        {{-- EMAIL --}}
                        <div>

                            <label class="block mb-2 font-semibold text-slate-700">

                                Correo electrónico

                            </label>

                            <input
                                type="email"
                                class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200"
                                placeholder="correo@empresa.com"
                            >

                        </div>

                        {{-- BUTTON --}}
                        <button
                            type="submit"
                            class="w-full bg-orange-500 hover:bg-orange-600 transition text-white py-5 rounded-2xl text-lg font-bold shadow-lg">

                            Solicitar Demo

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection