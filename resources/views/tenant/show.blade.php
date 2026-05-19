@extends('layouts.app')

@section('content')

<section class="min-h-screen bg-[#0f172a] text-white overflow-hidden">

    {{-- BACKGROUND --}}
    <div class="fixed inset-0 -z-10">

        <div class="absolute top-0 left-0 w-125 h-125 bg-orange-500/20 blur-3xl rounded-full"></div>

        <div class="absolute bottom-0 right-0 w-125 h-125 bg-pink-500/20 blur-3xl rounded-full"></div>

    </div>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-8">

        {{-- HEADER --}}
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-[35px] p-6 md:p-10 mb-10 shadow-2xl">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                {{-- LEFT --}}
                <div class="flex items-center gap-5">

                    {{-- LOGO --}}
                    <div>

                        @if($tenant->logo)

                            <img
                                src="{{ asset('storage/' . $tenant->logo) }}"
                                class="w-24 h-24 rounded-3xl object-cover border border-white/10 shadow-2xl"
                            >

                        @else

                            <div class="w-24 h-24 rounded-3xl bg-orange-500 flex items-center justify-center text-4xl font-black">

                                {{ strtoupper(substr($tenant->name, 0, 1)) }}

                            </div>

                        @endif

                    </div>

                    {{-- INFO --}}
                    <div>

                        <div class="flex items-center gap-3 flex-wrap">

                            <h1 class="text-4xl md:text-5xl font-black">

                                {{ $tenant->name }}

                            </h1>

                            {{-- STATUS --}}
                            @if($tenant->is_open)

                                <div class="bg-green-500/20 text-green-300 border border-green-500/20 px-4 py-2 rounded-full text-sm font-bold">

                                    ● Abierto

                                </div>

                            @else

                                <div class="bg-red-500/20 text-red-300 border border-red-500/20 px-4 py-2 rounded-full text-sm font-bold">

                                    ● Cerrado

                                </div>

                            @endif

                        </div>

                        {{-- SCHEDULE --}}
                        <p class="text-slate-300 mt-3 text-lg">

                            🕒 {{ $tenant->schedule }}

                        </p>

                        {{-- ADDRESS --}}
                        <p class="text-slate-400 mt-2">

                            📍 {{ $tenant->address }}

                        </p>

                        {{-- SOCIAL --}}
                        <div class="flex gap-3 mt-5 flex-wrap">

                            @if($tenant->tiktok)

                                <a
                                    href="https://tiktok.com/{{ $tenant->tiktok }}"
                                    target="_blank"
                                    class="bg-white/10 hover:bg-white/20 transition px-5 py-3 rounded-2xl text-sm font-semibold"
                                >

                                    🎵 {{ $tenant->tiktok }}

                                </a>

                            @endif

                            @if($tenant->google_maps)

                                <a
                                    href="{{ $tenant->google_maps }}"
                                    target="_blank"
                                    class="bg-orange-500 hover:bg-orange-600 transition px-5 py-3 rounded-2xl text-sm font-bold"
                                >

                                    📍 Ver ubicación

                                </a>

                            @endif

                        </div>

                    </div>

                </div>

                {{-- DELIVERY --}}
                <div class="bg-linear-to-r from-orange-500 to-pink-500 rounded-3xl p-6 min-w-64 shadow-2xl">

                    <div class="text-sm font-semibold opacity-80">

                        Delivery promedio

                    </div>

                    <div class="text-5xl font-black mt-2">

                        30m

                    </div>

                    <div class="mt-4 text-sm">

                        ⚡ Pedidos rápidos por WhatsApp

                    </div>

                </div>

            </div>

        </div>

        {{-- CATEGORIES --}}
        <div class="flex gap-4 overflow-x-auto scrollbar-hide pb-4 mb-10">

            @foreach($categories as $category)

                <button
                    class="category-btn whitespace-nowrap"
                >

                    {{ $category->name }}

                </button>

            @endforeach

        </div>

        {{-- PRODUCTS --}}
        <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-8">

            @foreach($products as $product)

                <div class="product-card group">

                    {{-- IMAGE --}}
                    <div class="relative overflow-hidden">

                        @if($product->image)

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                class="w-full h-64 object-cover group-hover:scale-110 transition duration-700"
                            >

                        @else

                            <div class="w-full h-64 bg-linear-to-br from-orange-500 to-pink-500 flex items-center justify-center text-7xl">

                                🍔

                            </div>

                        @endif

                        {{-- BADGE --}}
                        @if(!$product->is_available)

                            <div class="absolute top-4 left-4 bg-red-500 text-white px-4 py-2 rounded-full font-bold text-sm">

                                Agotado

                            </div>

                        @endif

                    </div>

                    {{-- CONTENT --}}
                    <div class="p-6">

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <h2 class="text-2xl font-black mb-2">

                                    {{ $product->name }}

                                </h2>

                                <p class="text-slate-400 leading-relaxed">

                                    {{ $product->description }}

                                </p>

                            </div>

                        </div>

                        {{-- FOOTER --}}
                        <div class="flex items-center justify-between mt-8">

                            <div>

                                <div class="text-slate-400 text-sm">

                                    Precio

                                </div>

                                <div class="text-3xl font-black text-orange-400">

                                    Bs {{ $product->price }}

                                </div>

                            </div>

                            @if($product->is_available)

                                <button
                                    onclick="addToCart(
                                        '{{ $product->id }}',
                                        '{{ $product->name }}',
                                        '{{ $product->price }}'
                                    )"
                                    class="w-16 h-16 rounded-2xl bg-orange-500 hover:bg-orange-600 transition text-3xl font-black shadow-2xl hover:scale-110"
                                >

                                    +

                                </button>

                            @endif

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

    {{-- FLOATING CART --}}
    <div
        id="cartBar"
        class="fixed bottom-6 left-1/2 -translate-x-1/2
               bg-orange-500 shadow-2xl
               px-8 py-5 rounded-3xl
               display: flex; items-center gap-6
               z-50 hidden"
    >

        <div>

            <div class="text-sm opacity-80">

                Productos agregados

            </div>

            <div
                id="cartTotal"
                class="font-black text-2xl"
            >

                Bs 0

            </div>

        </div>

        <a
            href="/checkout"
            class="bg-black text-white px-6 py-3 rounded-2xl font-bold"
        >

            Ver carrito

        </a>

    </div>

</section>

{{-- STYLES --}}
<style>

.product-card{
    @apply bg-white/10 backdrop-blur-2xl border border-white/10 rounded-[35px] overflow-hidden shadow-2xl hover:scale-[1.02] transition-all duration-500;
}

.category-btn{
    @apply bg-white/10 border border-white/10 hover:bg-orange-500 hover:border-orange-500 transition-all duration-300 px-6 py-3 rounded-2xl font-bold;
}

</style>

{{-- JS --}}
<script>

let cart = [];
let total = 0;

function addToCart(id, name, price)
{
    cart.push({
        id,
        name,
        price
    });

    total += parseFloat(price);

    document
        .getElementById('cartBar')
        .classList
        .remove('hidden');

    document
        .getElementById('cartTotal')
        .innerHTML = `Bs ${total}`;

    localStorage.setItem(
        'foodlink_cart',
        JSON.stringify(cart)
    );
}

</script>

@endsection