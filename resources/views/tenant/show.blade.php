@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- HEADER --}}
    <div class="bg-white rounded-3xl shadow-lg p-6 mb-10">

        <h1 class="text-4xl font-bold mb-2">
            {{ $tenant->name }}
        </h1>

        <p class="text-gray-500">
            Horario: {{ $tenant->schedule }}
        </p>

    </div>

    {{-- CATEGORÍAS --}}
    <div class="flex gap-3 overflow-x-auto mb-10">

        @foreach($categories as $category)

            <button class="bg-orange-500 text-white px-5 py-2 rounded-full whitespace-nowrap">
                {{ $category->name }}
            </button>

        @endforeach

    </div>

    {{-- PRODUCTOS --}}
    <div class="grid md:grid-cols-3 gap-6">

        @foreach($products as $product)

            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

                <div class="p-6">

                    <h2 class="text-2xl font-bold mb-3">
                        {{ $product->name }}
                    </h2>

                    <p class="text-gray-500 mb-4">
                        {{ $product->description }}
                    </p>

                    <div class="flex items-center justify-between">

                        <span class="text-2xl font-bold text-orange-500">
                            Bs {{ $product->price }}
                        </span>

                        <button
                            class="bg-black text-white px-4 py-2 rounded-xl">
                            +
                        </button>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection