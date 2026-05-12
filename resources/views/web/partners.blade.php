@extends('layouts.app')

@section('content')

<section class="min-h-screen bg-slate-100 py-20">

    <div class="max-w-7xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="text-center mb-16">

            <span class="bg-orange-100 text-orange-600 px-5 py-2 rounded-full text-sm font-bold">
                Partners Oficiales
            </span>

            <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 mt-6 leading-tight">

                Negocios que ya venden
                <span class="text-orange-500">
                    con FoodLink
                </span>

            </h1>

            <p class="text-slate-500 text-xl mt-6 max-w-3xl mx-auto">

                Restaurantes, hamburgueserías y negocios de comida
                que transforman visitas de TikTok en pedidos reales.

            </p>

        </div>

        {{-- GRID --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($tenants as $tenant)

                <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 border border-slate-200">

                    {{-- IMAGE --}}
                    <div class="h-56 bg-gradient-to-br from-orange-400 to-red-500 relative">

                        @if($tenant->logo)

                            <img
                                src="{{ asset('storage/' . $tenant->logo) }}"
                                class="w-full h-full object-cover"
                                alt="{{ $tenant->name }}"
                            >

                        @else

                            <div class="flex items-center justify-center h-full">

                                <span class="text-white text-5xl font-black">
                                    🍔
                                </span>

                            </div>

                        @endif

                    </div>

                    {{-- CONTENT --}}
                    <div class="p-8">

                        <div class="flex items-center justify-between mb-4">

                            <h2 class="text-2xl font-bold text-slate-800">
                                {{ $tenant->name }}
                            </h2>

                            @if($tenant->is_open)

                                <span class="bg-green-100 text-green-600 text-sm font-bold px-3 py-1 rounded-full">
                                    Abierto
                                </span>

                            @else

                                <span class="bg-red-100 text-red-600 text-sm font-bold px-3 py-1 rounded-full">
                                    Cerrado
                                </span>

                            @endif

                        </div>

                        <p class="text-slate-500 mb-6">

                            Horario:
                            {{ $tenant->schedule ?? 'No definido' }}

                        </p>

                        {{-- BUTTON --}}
                        <a href="/{{ $tenant->slug }}"
                           class="block text-center bg-orange-500 hover:bg-orange-600 text-white py-4 rounded-2xl font-bold transition">

                            Ver Tienda

                        </a>

                    </div>

                </div>

            @empty

                <div class="col-span-3">

                    <div class="bg-white rounded-3xl p-16 text-center shadow-lg">

                        <h2 class="text-3xl font-bold text-slate-800 mb-4">

                            No existen partners todavía

                        </h2>

                        <p class="text-slate-500">

                            Los negocios registrados aparecerán aquí.

                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>

@endsection