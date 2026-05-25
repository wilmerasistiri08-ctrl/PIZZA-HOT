@extends('layouts.app')

@section('content')

@php
    $totalCategories = $categories->count();
    $activeCategories = $categories->where('is_active', true)->count();
    $inactiveCategories = $categories->where('is_active', false)->count();
@endphp

<div class="min-h-screen bg-slate-950 text-white overflow-x-hidden">

    {{-- BACKGROUND --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden">

        <div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-orange-500/20 rounded-full blur-3xl"></div>

        <div class="absolute top-40 -right-40 w-[500px] h-[500px] bg-pink-500/20 rounded-full blur-3xl"></div>

        <div class="absolute bottom-0 left-1/3 w-[500px] h-[500px] bg-purple-500/10 rounded-full blur-3xl"></div>

    </div>

    <main class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER --}}
        <section class="mb-8 rounded-[2rem] border border-white/10 bg-white/5 backdrop-blur-2xl p-6 shadow-2xl">

            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-center gap-4">

                    <div class="relative shrink-0">

                        <div class="absolute inset-0 bg-orange-500 rounded-3xl blur-xl opacity-40"></div>

                        <div class="relative w-16 h-16 rounded-3xl bg-gradient-to-br from-orange-500 to-rose-500 flex items-center justify-center text-4xl shadow-2xl">
                            🗂️
                        </div>

                    </div>

                    <div>

                        <h1 class="text-3xl md:text-4xl font-black">
                            Categorías
                        </h1>

                        <p class="text-slate-400 text-sm mt-1">
                            Administra las secciones de productos de tu negocio.
                        </p>

                    </div>

                </div>

                <div class="flex flex-wrap items-center gap-3">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-slate-200 hover:bg-white/10 transition">

                        <span>🏠</span>
                        Dashboard

                    </a>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl border border-cyan-400/20 bg-cyan-500/10 px-5 py-3 text-sm font-bold text-cyan-200 hover:bg-cyan-500/20 transition">

                        <span>📦</span>
                        Productos

                    </a>

                    <a
                        href="{{ route('admin.categories.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-orange-500 to-rose-500 px-5 py-3 text-sm font-black text-white shadow-[0_15px_40px_rgba(249,115,22,0.35)] hover:scale-[1.02] transition">

                        <span>➕</span>
                        Nueva categoría

                    </a>

                </div>

            </div>

        </section>

        {{-- ALERTAS --}}
        @if(session('success'))

            <div class="mb-8 rounded-3xl border border-emerald-400/20 bg-emerald-500/10 px-6 py-5 text-emerald-200">
                {{ session('success') }}
            </div>

        @endif

        @if(session('error'))

            <div class="mb-8 rounded-3xl border border-red-400/20 bg-red-500/10 px-6 py-5 text-red-200">
                {{ session('error') }}
            </div>

        @endif

        {{-- STATS --}}
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="rounded-[2rem] border border-white/10 bg-white/5 backdrop-blur-2xl p-6 shadow-2xl">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-slate-400 text-sm font-semibold">
                            Total categorías
                        </p>

                        <h2 class="text-4xl font-black mt-2">
                            {{ $totalCategories }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-orange-500/20 flex items-center justify-center text-3xl">
                        🗂️
                    </div>

                </div>

            </div>

            <div class="rounded-[2rem] border border-white/10 bg-white/5 backdrop-blur-2xl p-6 shadow-2xl">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-slate-400 text-sm font-semibold">
                            Activas
                        </p>

                        <h2 class="text-4xl font-black mt-2 text-emerald-300">
                            {{ $activeCategories }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 flex items-center justify-center text-3xl">
                        ✅
                    </div>

                </div>

            </div>

            <div class="rounded-[2rem] border border-white/10 bg-white/5 backdrop-blur-2xl p-6 shadow-2xl">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-slate-400 text-sm font-semibold">
                            Inactivas
                        </p>

                        <h2 class="text-4xl font-black mt-2 text-red-300">
                            {{ $inactiveCategories }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-red-500/20 flex items-center justify-center text-3xl">
                        ⛔
                    </div>

                </div>

            </div>

        </section>

        {{-- CONTENT --}}
        <section class="rounded-[2rem] border border-white/10 bg-white/5 backdrop-blur-2xl shadow-2xl overflow-hidden">

            <div class="p-6 border-b border-white/10">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>

                        <h2 class="text-2xl font-black">
                            Listado de categorías
                        </h2>

                        <p class="text-slate-400 text-sm mt-1">
                            Cada categoría agrupa productos dentro de la tienda pública.
                        </p>

                    </div>

                    <div class="relative w-full md:w-80">

                        <input
                            type="text"
                            id="searchCategory"
                            placeholder="Buscar categoría..."
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 text-white placeholder:text-slate-500 focus:outline-none focus:ring-4 focus:ring-orange-500/20 focus:border-orange-400">

                    </div>

                </div>

            </div>

            @if($categories->count() > 0)

                {{-- DESKTOP TABLE --}}
                <div class="hidden lg:block overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-slate-900/80">

                            <tr class="text-left text-xs uppercase tracking-wider text-slate-400">

                                <th class="px-6 py-5">
                                    Categoría
                                </th>

                                <th class="px-6 py-5">
                                    Slug
                                </th>

                                <th class="px-6 py-5">
                                    Productos
                                </th>

                                <th class="px-6 py-5">
                                    Estado
                                </th>

                                <th class="px-6 py-5 text-right">
                                    Acciones
                                </th>

                            </tr>

                        </thead>

                        <tbody id="categoriesTable" class="divide-y divide-white/10">

                            @foreach($categories as $category)

                                <tr class="category-row hover:bg-white/5 transition">

                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-4">

                                            <div class="w-14 h-14 rounded-2xl overflow-hidden bg-slate-900 border border-white/10 shrink-0">

                                                @if($category->image)

                                                    <img
                                                        src="{{ asset('storage/' . $category->image) }}"
                                                        alt="{{ $category->name }}"
                                                        class="w-full h-full object-cover">

                                                @else

                                                    <div class="w-full h-full flex items-center justify-center text-2xl">
                                                        🗂️
                                                    </div>

                                                @endif

                                            </div>

                                            <div class="min-w-0">

                                                <h3 class="category-name font-black text-white truncate">
                                                    {{ $category->name }}
                                                </h3>

                                                <p class="text-sm text-slate-400">
                                                    ID: {{ $category->id }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>

                                    <td class="px-6 py-5">

                                        <span class="inline-flex rounded-full border border-white/10 bg-white/5 px-3 py-1 text-sm text-slate-300">
                                            {{ $category->slug }}
                                        </span>

                                    </td>

                                    <td class="px-6 py-5">

                                        <span class="inline-flex items-center gap-2 rounded-full bg-cyan-500/10 px-3 py-1 text-sm font-bold text-cyan-200">
                                            📦 {{ $category->products_count ?? 0 }}
                                        </span>

                                    </td>

                                    <td class="px-6 py-5">

                                        @if($category->is_active)

                                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 px-3 py-1 text-sm font-bold text-emerald-300">
                                                ● Activa
                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-2 rounded-full bg-red-500/10 px-3 py-1 text-sm font-bold text-red-300">
                                                ● Inactiva
                                            </span>

                                        @endif

                                    </td>

                                    <td class="px-6 py-5">

                                        <div class="flex justify-end gap-2">

                                            <a
                                                href="{{ route('admin.categories.edit', $category) }}"
                                                class="inline-flex items-center justify-center rounded-xl border border-blue-400/20 bg-blue-500/10 px-4 py-2 text-sm font-bold text-blue-200 hover:bg-blue-500/20 transition">

                                                Editar

                                            </a>

                                            <form
                                                action="{{ route('admin.categories.destroy', $category) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?');">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center justify-center rounded-xl border border-red-400/20 bg-red-500/10 px-4 py-2 text-sm font-bold text-red-200 hover:bg-red-500/20 transition">

                                                    Eliminar

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- MOBILE CARDS --}}
                <div id="categoriesCards" class="lg:hidden p-5 space-y-4">

                    @foreach($categories as $category)

                        <article class="category-card rounded-3xl border border-white/10 bg-slate-900/70 p-5">

                            <div class="flex items-start gap-4">

                                <div class="w-16 h-16 rounded-2xl overflow-hidden bg-slate-950 border border-white/10 shrink-0">

                                    @if($category->image)

                                        <img
                                            src="{{ asset('storage/' . $category->image) }}"
                                            alt="{{ $category->name }}"
                                            class="w-full h-full object-cover">

                                    @else

                                        <div class="w-full h-full flex items-center justify-center text-3xl">
                                            🗂️
                                        </div>

                                    @endif

                                </div>

                                <div class="flex-1 min-w-0">

                                    <h3 class="category-name font-black text-lg truncate">
                                        {{ $category->name }}
                                    </h3>

                                    <p class="text-sm text-slate-400 mt-1">
                                        {{ $category->slug }}
                                    </p>

                                    <div class="flex flex-wrap gap-2 mt-4">

                                        <span class="rounded-full bg-cyan-500/10 px-3 py-1 text-xs font-bold text-cyan-200">
                                            📦 {{ $category->products_count ?? 0 }} productos
                                        </span>

                                        @if($category->is_active)

                                            <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-bold text-emerald-300">
                                                Activa
                                            </span>

                                        @else

                                            <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-bold text-red-300">
                                                Inactiva
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                            <div class="grid grid-cols-2 gap-3 mt-5">

                                <a
                                    href="{{ route('admin.categories.edit', $category) }}"
                                    class="rounded-2xl border border-blue-400/20 bg-blue-500/10 px-4 py-3 text-center text-sm font-bold text-blue-200 hover:bg-blue-500/20 transition">

                                    Editar

                                </a>

                                <form
                                    action="{{ route('admin.categories.destroy', $category) }}"
                                    method="POST"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?');">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="w-full rounded-2xl border border-red-400/20 bg-red-500/10 px-4 py-3 text-center text-sm font-bold text-red-200 hover:bg-red-500/20 transition">

                                        Eliminar

                                    </button>

                                </form>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                {{-- EMPTY STATE --}}
                <div class="p-12 text-center">

                    <div class="mx-auto w-24 h-24 rounded-[2rem] bg-orange-500/10 flex items-center justify-center text-5xl mb-6">
                        🗂️
                    </div>

                    <h3 class="text-3xl font-black">
                        Todavía no tienes categorías
                    </h3>

                    <p class="text-slate-400 mt-3 max-w-xl mx-auto">
                        Crea categorías para organizar tus productos. Por ejemplo: destacados, promociones, tecnología, belleza, moda, alimentos, accesorios y más.
                    </p>

                    <a
                        href="{{ route('admin.categories.create') }}"
                        class="mt-8 inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-orange-500 to-rose-500 px-6 py-4 text-sm font-black text-white shadow-[0_15px_40px_rgba(249,115,22,0.35)] hover:scale-[1.02] transition">

                        <span>➕</span>
                        Crear primera categoría

                    </a>

                </div>

            @endif

        </section>

    </main>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchCategory');

        if (!searchInput) {
            return;
        }

        searchInput.addEventListener('input', function () {
            const search = this.value.toLowerCase().trim();

            const rows = document.querySelectorAll('.category-row');
            const cards = document.querySelectorAll('.category-card');

            rows.forEach(function (row) {
                const name = row.querySelector('.category-name')?.textContent.toLowerCase() || '';
                row.style.display = name.includes(search) ? '' : 'none';
            });

            cards.forEach(function (card) {
                const name = card.querySelector('.category-name')?.textContent.toLowerCase() || '';
                card.style.display = name.includes(search) ? '' : 'none';
            });
        });
    });
</script>

@endsection