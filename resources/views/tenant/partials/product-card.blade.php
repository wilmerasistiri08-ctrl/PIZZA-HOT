@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-100 pb-32">

    <div class="relative h-72 overflow-hidden">

        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1400&auto=format&fit=crop"
             class="w-full h-full object-cover">

        <div class="absolute inset-0 bg-black/40"></div>

        <div class="absolute bottom-6 left-6 text-white">

            <h1 class="text-4xl font-extrabold mb-2">
                {{ $tenant->name }}
            </h1>

            <div class="flex gap-3 items-center text-sm">
                <span class="bg-green-500 px-3 py-1 rounded-full">
                    Abierto
                </span>

                <span>⏰ 10:00 - 23:00</span>
            </div>

        </div>

    </div>

    <div class="sticky top-0 z-40 bg-white border-b overflow-x-auto whitespace-nowrap px-4 py-4 flex gap-3 shadow-sm">

        @foreach($categories as $category)
            <button class="bg-slate-100 hover:bg-orange-500 hover:text-white transition px-5 py-2 rounded-full font-medium">
                {{ $category->name }}
            </button>
        @endforeach

    </div>

    <div class="max-w-6xl mx-auto px-4 py-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($products as $product)
            @include('tenant.partials.product-card')
        @endforeach

    </div>

    @include('tenant.partials.cart-floating')

</div>

@endsection