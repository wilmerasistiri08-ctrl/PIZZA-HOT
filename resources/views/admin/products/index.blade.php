@extends('layouts.app')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATOS SEGUROS
    |--------------------------------------------------------------------------
    */

    $productCollection = method_exists($products, 'getCollection')
        ? $products->getCollection()
        : collect($products ?? []);

    $categoryOptions = collect($categories ?? []);

    $totalProducts = method_exists($products, 'total')
        ? $products->total()
        : $productCollection->count();

    $availableProducts = $productCollection->where('is_available', true)->count();
    $unavailableProducts = $productCollection->where('is_available', false)->count();
    $featuredProducts = $productCollection->where('featured', true)->count();

    $tenantName = $tenant->name ?? 'Mi negocio';
    $tenantSlug = $tenant->slug ?? null;

    $selectedCategoryId = request('category_id');

    $selectedCategory = $categoryOptions->first(function ($category) use ($selectedCategoryId) {
        return (string) $category->id === (string) $selectedCategoryId;
    });

    $statusLabels = [
        '' => 'Todos los estados',
        'available' => 'Disponibles',
        'unavailable' => 'Agotados',
        'featured' => 'Destacados',
        'out_stock' => 'Sin stock',
    ];

    $selectedStatus = request('status', '');
    $selectedStatusLabel = $statusLabels[$selectedStatus] ?? 'Todos los estados';

    $placeholderImage = 'https://placehold.co/900x650/0f172a/f97316?text=Producto';
@endphp

<style>
    .fl-admin-products {
        isolation: isolate;
    }

    .fl-admin-products * {
        box-sizing: border-box;
    }

    .fl-card {
        box-shadow:
            0 24px 90px rgba(0, 0, 0, .38),
            inset 0 1px 0 rgba(255, 255, 255, .07);
    }

    .fl-scroll::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .fl-scroll::-webkit-scrollbar-track {
        background: rgba(15, 23, 42, .8);
        border-radius: 999px;
    }

    .fl-scroll::-webkit-scrollbar-thumb {
        background: rgba(249, 115, 22, .7);
        border-radius: 999px;
    }

    .fl-dropdown summary::-webkit-details-marker {
        display: none;
    }

    .fl-dropdown[open] summary {
        border-color: rgba(249, 115, 22, .75);
        box-shadow: 0 0 0 4px rgba(249, 115, 22, .16);
    }

    .fl-soft-grid {
        background-image:
            linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
        background-size: 42px 42px;
    }
</style>

<div class="fl-admin-products min-h-screen overflow-x-hidden bg-slate-950 text-white">

    {{-- BACKGROUND --}}
    <div class="fixed inset-0 -z-10 overflow-hidden bg-slate-950 fl-soft-grid">

        <div class="absolute -top-40 -left-40 h-[520px] w-[520px] rounded-full bg-orange-500/20 blur-3xl"></div>

        <div class="absolute top-20 -right-40 h-[520px] w-[520px] rounded-full bg-pink-500/20 blur-3xl"></div>

        <div class="absolute bottom-0 left-1/3 h-[520px] w-[520px] rounded-full bg-purple-500/10 blur-3xl"></div>

        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.07),transparent_36%)]"></div>

    </div>

    <main class="relative mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <section class="fl-card mb-8 rounded-[2rem] border border-white/10 bg-white/5 p-6 backdrop-blur-2xl">

            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-center gap-4">

                    <div class="relative shrink-0">

                        <div class="absolute inset-0 rounded-3xl bg-orange-500 opacity-40 blur-xl"></div>

                        <div class="relative flex h-16 w-16 items-center justify-center rounded-3xl bg-gradient-to-br from-orange-500 to-rose-500 text-3xl shadow-2xl">
                            🛍️
                        </div>

                    </div>

                    <div>

                        <p class="text-xs font-black uppercase tracking-[0.35em] text-orange-300">
                            Panel del negocio
                        </p>

                        <h1 class="mt-1 text-3xl font-black md:text-4xl">
                            Productos
                        </h1>

                        <p class="mt-1 text-sm text-slate-400">
                            Catálogo administrativo de {{ $tenantName }}
                        </p>

                    </div>

                </div>

                <div class="flex flex-wrap items-center gap-3">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-slate-200 transition hover:bg-white/10">

                        ⬅️ Dashboard

                    </a>

                    @if($tenantSlug)

                        <a
                            href="{{ route('tenant.show', $tenantSlug) }}"
                            target="_blank"
                            class="inline-flex items-center gap-2 rounded-2xl border border-cyan-400/20 bg-cyan-500/10 px-5 py-3 text-sm font-bold text-cyan-200 transition hover:bg-cyan-500/20">

                            🌐 Ver tienda

                        </a>

                    @endif

                    <a
                        href="{{ route('admin.products.create') }}"
                        class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-orange-500 to-rose-500 px-6 py-3 text-sm font-black text-white shadow-[0_15px_40px_rgba(249,115,22,0.35)] transition hover:scale-[1.02]">

                        ➕ Nuevo producto

                    </a>

                </div>

            </div>

        </section>

        {{-- ALERTAS --}}
        @if(session('success'))

            <div class="mb-8 rounded-3xl border border-emerald-400/20 bg-emerald-500/10 px-6 py-5 text-emerald-200 shadow-xl">

                <div class="flex items-center gap-3">

                    <span class="text-2xl">✅</span>

                    <p class="font-bold">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif

        @if($errors->any())

            <div class="mb-8 rounded-3xl border border-red-400/20 bg-red-500/10 px-6 py-5 text-red-200 shadow-xl">

                <div class="flex items-start gap-3">

                    <span class="text-2xl">⚠️</span>

                    <div>

                        <p class="mb-2 font-black">
                            Revisa los siguientes errores:
                        </p>

                        <ul class="list-inside list-disc space-y-1 text-sm">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif

        {{-- STATS --}}
        <section class="mb-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

            <div class="fl-card rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur-xl">

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold text-slate-400">
                            Total productos
                        </p>

                        <h3 class="mt-2 text-4xl font-black">
                            {{ $totalProducts }}
                        </h3>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-500/20 text-3xl">
                        📦
                    </div>

                </div>

            </div>

            <div class="fl-card rounded-3xl border border-emerald-400/20 bg-emerald-500/10 p-6 backdrop-blur-xl">

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold text-emerald-200/80">
                            Disponibles
                        </p>

                        <h3 class="mt-2 text-4xl font-black text-emerald-300">
                            {{ $availableProducts }}
                        </h3>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-500/20 text-3xl">
                        ✅
                    </div>

                </div>

            </div>

            <div class="fl-card rounded-3xl border border-red-400/20 bg-red-500/10 p-6 backdrop-blur-xl">

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold text-red-200/80">
                            Agotados
                        </p>

                        <h3 class="mt-2 text-4xl font-black text-red-300">
                            {{ $unavailableProducts }}
                        </h3>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-500/20 text-3xl">
                        ❌
                    </div>

                </div>

            </div>

            <div class="fl-card rounded-3xl border border-purple-400/20 bg-purple-500/10 p-6 backdrop-blur-xl">

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold text-purple-200/80">
                            Destacados
                        </p>

                        <h3 class="mt-2 text-4xl font-black text-purple-300">
                            {{ $featuredProducts }}
                        </h3>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-500/20 text-3xl">
                        ⭐
                    </div>

                </div>

            </div>

        </section>

        {{-- FILTROS --}}
        <section class="fl-card mb-8 rounded-[2rem] border border-white/10 bg-white/5 p-6 backdrop-blur-2xl">

            <form
                method="GET"
                action="{{ route('admin.products.index') }}"
                class="grid gap-5 lg:grid-cols-12">

                {{-- SEARCH --}}
                <div class="lg:col-span-5">

                    <label for="productSearch" class="mb-2 block text-sm font-bold text-slate-300">
                        Buscar producto
                    </label>

                    <div class="relative">

                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            🔎
                        </span>

                        <input
                            type="text"
                            name="search"
                            id="productSearch"
                            value="{{ request('search') }}"
                            placeholder="Nombre, descripción, categoría o slug..."
                            autocomplete="off"
                            class="h-14 w-full rounded-2xl border border-white/10 bg-slate-900/90 pl-12 pr-5 text-sm font-semibold text-white placeholder:text-slate-500 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/20">

                    </div>

                </div>

                {{-- CATEGORY --}}
                <div class="lg:col-span-3">

                    <label class="mb-2 block text-sm font-bold text-slate-300">
                        Categoría
                    </label>

                    <input
                        type="hidden"
                        name="category_id"
                        id="categoryFilter"
                        value="{{ request('category_id') }}">

                    <details class="fl-dropdown relative">

                        <summary class="flex h-14 cursor-pointer list-none items-center justify-between rounded-2xl border border-white/10 bg-slate-900/90 px-5 text-sm font-bold text-white transition hover:bg-slate-900">

                            <span id="categorySelected" class="truncate">
                                {{ $selectedCategory?->name ?? 'Todas las categorías' }}
                            </span>

                            <span class="ml-3 text-slate-400">
                                ⌄
                            </span>

                        </summary>

                        <div class="fl-scroll absolute left-0 right-0 top-[calc(100%+8px)] z-40 max-h-72 overflow-y-auto rounded-2xl border border-white/10 bg-slate-950 p-2 shadow-2xl">

                            <button
                                type="button"
                                data-select-target="categoryFilter"
                                data-select-label="categorySelected"
                                data-select-value=""
                                data-select-text="Todas las categorías"
                                class="w-full rounded-xl px-4 py-3 text-left text-sm font-bold text-slate-200 transition hover:bg-orange-500/20">

                                Todas las categorías

                            </button>

                            @forelse($categoryOptions as $category)

                                <button
                                    type="button"
                                    data-select-target="categoryFilter"
                                    data-select-label="categorySelected"
                                    data-select-value="{{ $category->id }}"
                                    data-select-text="{{ $category->name }}"
                                    class="w-full rounded-xl px-4 py-3 text-left text-sm font-bold text-slate-200 transition hover:bg-orange-500/20">

                                    {{ $category->name }}

                                </button>

                            @empty

                                <div class="px-4 py-4 text-sm font-semibold text-slate-400">
                                    No existen categorías todavía.
                                </div>

                            @endforelse

                        </div>

                    </details>

                </div>

                {{-- STATUS --}}
                <div class="lg:col-span-2">

                    <label class="mb-2 block text-sm font-bold text-slate-300">
                        Estado
                    </label>

                    <input
                        type="hidden"
                        name="status"
                        id="statusFilter"
                        value="{{ request('status') }}">

                    <details class="fl-dropdown relative">

                        <summary class="flex h-14 cursor-pointer list-none items-center justify-between rounded-2xl border border-white/10 bg-slate-900/90 px-5 text-sm font-bold text-white transition hover:bg-slate-900">

                            <span id="statusSelected" class="truncate">
                                {{ $selectedStatusLabel }}
                            </span>

                            <span class="ml-3 text-slate-400">
                                ⌄
                            </span>

                        </summary>

                        <div class="absolute left-0 right-0 top-[calc(100%+8px)] z-40 rounded-2xl border border-white/10 bg-slate-950 p-2 shadow-2xl">

                            @foreach($statusLabels as $statusValue => $statusText)

                                <button
                                    type="button"
                                    data-select-target="statusFilter"
                                    data-select-label="statusSelected"
                                    data-select-value="{{ $statusValue }}"
                                    data-select-text="{{ $statusText }}"
                                    class="w-full rounded-xl px-4 py-3 text-left text-sm font-bold text-slate-200 transition hover:bg-orange-500/20">

                                    {{ $statusText }}

                                </button>

                            @endforeach

                        </div>

                    </details>

                </div>

                {{-- SUBMIT --}}
                <div class="flex items-end lg:col-span-2">

                    <button
                        type="submit"
                        class="h-14 w-full rounded-2xl bg-gradient-to-r from-orange-500 to-rose-500 px-5 text-sm font-black text-white shadow-lg transition hover:scale-[1.02]">

                        Filtrar

                    </button>

                </div>

                {{-- EXTRA ACTIONS --}}
                <div class="flex flex-wrap gap-3 lg:col-span-12">

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-slate-300 transition hover:bg-white/10">

                        Limpiar filtros

                    </a>

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="rounded-2xl border border-purple-400/20 bg-purple-500/10 px-5 py-3 text-sm font-bold text-purple-200 transition hover:bg-purple-500/20">

                        Gestionar categorías

                    </a>

                </div>

            </form>

        </section>

        {{-- PRODUCTOS --}}
        <section class="fl-card overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 backdrop-blur-2xl">

            {{-- SECTION HEADER --}}
            <div class="border-b border-white/10 px-6 py-6">

                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <h2 class="text-2xl font-black md:text-3xl">
                            Catálogo de {{ $tenantName }}
                        </h2>

                        <p class="mt-1 text-sm text-slate-400">
                            Administra imágenes, precios, stock, disponibilidad y productos destacados.
                        </p>

                    </div>

                    <div class="rounded-2xl border border-white/10 bg-slate-900/70 px-5 py-3 text-sm text-slate-300">

                        Mostrando:

                        <span id="visibleProductsCounter" class="font-black text-white">
                            {{ $productCollection->count() }}
                        </span>

                        @if(method_exists($products, 'total'))

                            de

                            <span class="font-black text-white">
                                {{ $products->total() }}
                            </span>

                        @endif

                    </div>

                </div>

            </div>

            @if($productCollection->count() > 0)

                <div id="productsGrid" class="grid gap-5 p-5 xl:grid-cols-2">

                    @foreach($productCollection as $product)

                        @php
                            $imageUrl = $product->image_url ?? null;

                            if (!$imageUrl && !empty($product->image)) {
                                $imageUrl = \Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://'])
                                    ? $product->image
                                    : asset('storage/' . ltrim($product->image, '/'));
                            }

                            $imageUrl = $imageUrl ?: $placeholderImage;

                            $hasDiscount = !is_null($product->discount_price)
                                && (float) $product->discount_price > 0
                                && (float) $product->discount_price < (float) $product->price;

                            $searchText = strtolower(trim(
                                ($product->name ?? '') . ' ' .
                                ($product->description ?? '') . ' ' .
                                ($product->slug ?? '') . ' ' .
                                ($product->category?->name ?? '')
                            ));
                        @endphp

                        <article
                            class="product-item overflow-hidden rounded-3xl border border-white/10 bg-slate-900/75 shadow-xl transition hover:-translate-y-1 hover:border-orange-400/30 hover:bg-slate-900"
                            data-search="{{ $searchText }}">

                            <div class="grid gap-0 md:grid-cols-[220px_1fr]">

                                {{-- IMAGE --}}
                                <div class="relative h-64 bg-slate-800 md:h-full">

                                    <img
                                        src="{{ $imageUrl }}"
                                        alt="{{ $product->name }}"
                                        class="h-full w-full object-cover"
                                        loading="lazy"
                                        onerror="this.src='{{ $placeholderImage }}'">

                                    <div class="absolute left-4 top-4 flex flex-wrap gap-2">

                                        <span class="rounded-full px-3 py-1 text-xs font-black {{ $product->is_available ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white' }}">
                                            {{ $product->is_available ? 'Disponible' : 'Agotado' }}
                                        </span>

                                        @if($product->featured)

                                            <span class="rounded-full bg-purple-500 px-3 py-1 text-xs font-black text-white">
                                                ⭐ Destacado
                                            </span>

                                        @endif

                                    </div>

                                </div>

                                {{-- CONTENT --}}
                                <div class="flex flex-col p-5">

                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                                        <div class="min-w-0">

                                            <p class="mb-2 inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-bold text-slate-300">
                                                {{ $product->category?->name ?? 'Sin categoría' }}
                                            </p>

                                            <h3 class="text-2xl font-black text-white">
                                                {{ $product->name }}
                                            </h3>

                                            <p class="mt-2 text-sm leading-relaxed text-slate-400">
                                                {{ $product->description ?? 'Sin descripción' }}
                                            </p>

                                            <p class="mt-2 text-xs text-slate-500">
                                                Slug: {{ $product->slug ?? 'sin-slug' }}
                                            </p>

                                        </div>

                                        <div class="shrink-0 text-left sm:text-right">

                                            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                                                Precio
                                            </p>

                                            @if($hasDiscount)

                                                <p class="text-sm font-bold text-slate-500 line-through">
                                                    Bs {{ number_format((float) $product->price, 2) }}
                                                </p>

                                                <p class="text-3xl font-black text-emerald-300">
                                                    Bs {{ number_format((float) $product->discount_price, 2) }}
                                                </p>

                                            @else

                                                <p class="text-3xl font-black text-orange-300">
                                                    Bs {{ number_format((float) $product->price, 2) }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                    {{-- INFO --}}
                                    <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-4">

                                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">

                                            <p class="text-xs font-bold text-slate-500">
                                                Stock
                                            </p>

                                            <p class="mt-1 text-xl font-black">
                                                {{ $product->stock ?? 0 }}
                                            </p>

                                        </div>

                                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">

                                            <p class="text-xs font-bold text-slate-500">
                                                Estado
                                            </p>

                                            <p class="mt-1 text-sm font-black {{ $product->is_available ? 'text-emerald-300' : 'text-red-300' }}">
                                                {{ $product->is_available ? 'Activo' : 'Agotado' }}
                                            </p>

                                        </div>

                                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">

                                            <p class="text-xs font-bold text-slate-500">
                                                Destacado
                                            </p>

                                            <p class="mt-1 text-sm font-black {{ $product->featured ? 'text-purple-300' : 'text-slate-300' }}">
                                                {{ $product->featured ? 'Sí' : 'No' }}
                                            </p>

                                        </div>

                                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">

                                            <p class="text-xs font-bold text-slate-500">
                                                ID
                                            </p>

                                            <p class="mt-1 text-sm font-black text-slate-300">
                                                #{{ $product->id }}
                                            </p>

                                        </div>

                                    </div>

                                    {{-- QUICK ACTIONS --}}
                                    <div class="mt-5 grid gap-3 sm:grid-cols-2">

                                        {{-- TOGGLE DISPONIBILIDAD --}}
                                        <form method="POST" action="{{ route('admin.products.update', $product) }}">

                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="category_id" value="{{ $product->category_id }}">
                                            <input type="hidden" name="name" value="{{ $product->name }}">
                                            <input type="hidden" name="description" value="{{ $product->description }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <input type="hidden" name="discount_price" value="{{ $product->discount_price }}">
                                            <input type="hidden" name="stock" value="{{ $product->stock }}">
                                            <input type="hidden" name="featured" value="{{ $product->featured ? 1 : 0 }}">
                                            <input type="hidden" name="is_available" value="{{ $product->is_available ? 0 : 1 }}">

                                            <button
                                                type="submit"
                                                class="w-full rounded-2xl px-4 py-3 text-sm font-black transition {{ $product->is_available ? 'bg-red-500/10 text-red-300 hover:bg-red-500/20' : 'bg-emerald-500/10 text-emerald-300 hover:bg-emerald-500/20' }}">

                                                {{ $product->is_available ? 'Marcar agotado' : 'Marcar disponible' }}

                                            </button>

                                        </form>

                                        {{-- TOGGLE DESTACADO --}}
                                        <form method="POST" action="{{ route('admin.products.update', $product) }}">

                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="category_id" value="{{ $product->category_id }}">
                                            <input type="hidden" name="name" value="{{ $product->name }}">
                                            <input type="hidden" name="description" value="{{ $product->description }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <input type="hidden" name="discount_price" value="{{ $product->discount_price }}">
                                            <input type="hidden" name="stock" value="{{ $product->stock }}">
                                            <input type="hidden" name="is_available" value="{{ $product->is_available ? 1 : 0 }}">
                                            <input type="hidden" name="featured" value="{{ $product->featured ? 0 : 1 }}">

                                            <button
                                                type="submit"
                                                class="w-full rounded-2xl px-4 py-3 text-sm font-black transition {{ $product->featured ? 'bg-slate-700/60 text-slate-200 hover:bg-slate-700' : 'bg-purple-500/10 text-purple-300 hover:bg-purple-500/20' }}">

                                                {{ $product->featured ? 'Quitar destacado' : 'Destacar producto' }}

                                            </button>

                                        </form>

                                    </div>

                                    {{-- MAIN ACTIONS SEGURAS --}}
                                    <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">

                                        {{-- EDITAR: SIEMPRE ENLACE, NUNCA FORM --}}
                                        <a
                                            href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                                            class="inline-flex items-center justify-center rounded-2xl bg-orange-500/10 px-5 py-3 text-sm font-black text-orange-300 transition hover:bg-orange-500/20">

                                            ✏️ Editar

                                        </a>

                                        {{-- ELIMINAR: FORM AISLADO Y BOTÓN NO SUBMIT DIRECTO --}}
                                        <form
                                            id="delete-product-{{ $product->id }}"
                                            method="POST"
                                            action="{{ route('admin.products.destroy', ['product' => $product->id]) }}"
                                            class="inline-flex">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                onclick="confirmDeleteProduct({{ $product->id }})"
                                                class="inline-flex w-full items-center justify-center rounded-2xl bg-red-500/10 px-5 py-3 text-sm font-black text-red-300 transition hover:bg-red-500/20 sm:w-auto">

                                                🗑️ Eliminar

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

                {{-- SIN RESULTADOS EN BUSQUEDA LIVE --}}
                <div id="noLiveResults" class="hidden px-6 py-16 text-center">

                    <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-[2rem] bg-orange-500/10 text-4xl">
                        🔎
                    </div>

                    <h3 class="text-2xl font-black">
                        No encontramos productos
                    </h3>

                    <p class="mt-2 text-slate-400">
                        Prueba con otro nombre, categoría, descripción o slug.
                    </p>

                </div>

                {{-- PAGINACIÓN --}}
                @if(method_exists($products, 'links'))

                    <div class="border-t border-white/10 px-6 py-6">

                        <div class="rounded-2xl border border-white/10 bg-slate-900/70 p-4 text-slate-200">
                            {{ $products->appends(request()->query())->links() }}
                        </div>

                    </div>

                @endif

            @else

                {{-- EMPTY --}}
                <div class="px-6 py-20 text-center">

                    <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-[2rem] bg-orange-500/10 text-5xl">
                        📦
                    </div>

                    <h3 class="text-3xl font-black">
                        Aún no tienes productos
                    </h3>

                    <p class="mx-auto mt-3 max-w-xl text-slate-400">
                        Crea tu primer producto para empezar a vender desde tu tienda digital.
                    </p>

                    <a
                        href="{{ route('admin.products.create') }}"
                        class="mt-8 inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-orange-500 to-rose-500 px-8 py-4 font-black text-white shadow-xl transition hover:scale-[1.02]">

                        ➕ Crear primer producto

                    </a>

                </div>

            @endif

        </section>

    </main>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        /*
        |--------------------------------------------------------------------------
        | DROPDOWNS PERSONALIZADOS
        |--------------------------------------------------------------------------
        */

        document.querySelectorAll('[data-select-target]').forEach(function (button) {
            button.addEventListener('click', function () {
                const targetId = this.dataset.selectTarget;
                const labelId = this.dataset.selectLabel;
                const value = this.dataset.selectValue ?? '';
                const text = this.dataset.selectText ?? 'Seleccionar';

                const input = document.getElementById(targetId);
                const label = document.getElementById(labelId);

                if (input) {
                    input.value = value;
                }

                if (label) {
                    label.textContent = text;
                }

                const details = this.closest('details');

                if (details) {
                    details.removeAttribute('open');
                }
            });
        });

        document.addEventListener('click', function (event) {
            document.querySelectorAll('details.fl-dropdown[open]').forEach(function (details) {
                if (!details.contains(event.target)) {
                    details.removeAttribute('open');
                }
            });
        });

        /*
        |--------------------------------------------------------------------------
        | BUSCADOR LIVE
        |--------------------------------------------------------------------------
        */

        const searchInput = document.getElementById('productSearch');
        const noLiveResults = document.getElementById('noLiveResults');
        const visibleCounter = document.getElementById('visibleProductsCounter');

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const search = this.value.toLowerCase().trim();
                let visibleCount = 0;

                document.querySelectorAll('.product-item').forEach(function (item) {
                    const text = item.dataset.search || '';

                    if (text.includes(search)) {
                        item.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        item.classList.add('hidden');
                    }
                });

                if (visibleCounter) {
                    visibleCounter.textContent = visibleCount;
                }

                if (noLiveResults) {
                    if (visibleCount === 0 && search.length > 0) {
                        noLiveResults.classList.remove('hidden');
                    } else {
                        noLiveResults.classList.add('hidden');
                    }
                }
            });
        }
    });

    /*
    |--------------------------------------------------------------------------
    | ELIMINACIÓN SEGURA
    |--------------------------------------------------------------------------
    | El botón eliminar ya no es submit directo.
    | Primero confirma y recién envía el formulario DELETE.
    |--------------------------------------------------------------------------
    */

    function confirmDeleteProduct(productId) {
        const confirmed = confirm('¿Seguro que deseas eliminar este producto? Esta acción no se puede deshacer.');

        if (!confirmed) {
            return false;
        }

        const form = document.getElementById('delete-product-' + productId);

        if (form) {
            form.submit();
        }

        return true;
    }
</script>

@endsection