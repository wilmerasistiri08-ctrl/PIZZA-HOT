@extends('layouts.app')

@section('content')

@php
    $tenantName = $tenant->name ?? 'Mi negocio';
    $tenantSlug = $tenant->slug ?? null;

    $hasCategories = isset($categories) && $categories->count() > 0;

    $productsIndexUrl = \Illuminate\Support\Facades\Route::has('admin.products.index')
        ? route('admin.products.index')
        : (\Illuminate\Support\Facades\Route::has('products.index')
            ? route('products.index')
            : url('/admin/products'));

    $productsCreateUrl = \Illuminate\Support\Facades\Route::has('admin.products.create')
        ? route('admin.products.create')
        : (\Illuminate\Support\Facades\Route::has('products.create')
            ? route('products.create')
            : url('/admin/products/create'));

    $storeProductUrl = \Illuminate\Support\Facades\Route::has('admin.products.store')
        ? route('admin.products.store')
        : (\Illuminate\Support\Facades\Route::has('products.store')
            ? route('products.store')
            : url('/admin/products'));

    $categoryCreateRoute = \Illuminate\Support\Facades\Route::has('admin.categories.create')
        ? 'admin.categories.create'
        : (\Illuminate\Support\Facades\Route::has('categories.create')
            ? 'categories.create'
            : null);

    $createCategoryUrl = $categoryCreateRoute
        ? route($categoryCreateRoute, [
            'redirect_to' => $productsCreateUrl,
            'return_to' => 'product_create',
        ])
        : '#';

    $tenantPublicUrl = null;

    if ($tenantSlug && \Illuminate\Support\Facades\Route::has('tenant.show')) {
        $tenantPublicUrl = route('tenant.show', $tenantSlug);
    }

    $selectedCategoryId = old(
        'category_id',
        request('category_id', session('created_category_id'))
    );

    if ($selectedCategoryId === '__create_new__') {
        $selectedCategoryId = null;
    }
@endphp

<div class="min-h-screen overflow-x-hidden bg-slate-950 text-white">

    {{-- BACKGROUND --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-40 -left-40 h-[520px] w-[520px] rounded-full bg-orange-500/20 blur-3xl"></div>
        <div class="absolute top-40 -right-40 h-[520px] w-[520px] rounded-full bg-pink-500/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/3 h-[520px] w-[520px] rounded-full bg-purple-500/10 blur-3xl"></div>
    </div>

    <main class="relative z-10 mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <section class="mb-8 rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl">

            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-center gap-4">

                    <div class="relative shrink-0">
                        <div class="absolute inset-0 rounded-3xl bg-orange-500 opacity-40 blur-xl"></div>

                        <div class="relative flex h-16 w-16 items-center justify-center rounded-3xl bg-gradient-to-br from-orange-500 to-rose-500 text-4xl font-black shadow-2xl">
                            +
                        </div>
                    </div>

                    <div class="min-w-0">

                        <div class="flex flex-wrap items-center gap-3">

                            <h1 class="text-3xl font-black tracking-tight md:text-4xl">
                                Crear producto
                            </h1>

                            <span class="rounded-full border border-orange-400/20 bg-orange-500/10 px-3 py-1 text-xs font-black text-orange-200">
                                Nuevo producto
                            </span>

                        </div>

                        <p class="mt-2 text-sm text-slate-400">
                            Agrega un nuevo producto al catálogo de
                            <span class="font-bold text-white">
                                {{ $tenantName }}
                            </span>
                        </p>

                    </div>

                </div>

                <div class="flex flex-wrap items-center gap-3">

                    <a
                        href="{{ $productsIndexUrl }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-slate-200 transition hover:bg-white/10">

                        <span>⬅️</span>
                        Volver

                    </a>

                    @if($tenantPublicUrl)

                        <a
                            href="{{ $tenantPublicUrl }}"
                            target="_blank"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl border border-cyan-400/20 bg-cyan-500/10 px-5 py-3 text-sm font-bold text-cyan-200 transition hover:bg-cyan-500/20">

                            <span>🌐</span>
                            Ver tienda

                        </a>

                    @endif

                </div>

            </div>

        </section>

        {{-- ALERTAS --}}
        @if(session('success'))

            <section class="mb-8 rounded-3xl border border-emerald-400/20 bg-emerald-500/10 px-6 py-5 text-emerald-200">
                {{ session('success') }}
            </section>

        @endif

        @if(session('warning'))

            <section class="mb-8 rounded-3xl border border-yellow-400/20 bg-yellow-500/10 px-6 py-5 text-yellow-100">
                {{ session('warning') }}
            </section>

        @endif

        @if(session('error'))

            <section class="mb-8 rounded-3xl border border-red-400/20 bg-red-500/10 px-6 py-5 text-red-200">
                {{ session('error') }}
            </section>

        @endif

        @if($errors->any())

            <section class="mb-8 rounded-3xl border border-red-400/20 bg-red-500/10 px-6 py-5 text-red-200">

                <p class="mb-3 font-black">
                    Revisa los siguientes errores:
                </p>

                <ul class="list-inside list-disc space-y-1 text-sm">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </section>

        @endif

        {{-- SIN CATEGORÍAS --}}
        @unless($hasCategories)

            <section class="mb-8 rounded-3xl border border-yellow-400/20 bg-yellow-500/10 px-6 py-5 text-yellow-100">

                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                    <div>

                        <p class="font-black">
                            No tienes categorías registradas.
                        </p>

                        <p class="mt-1 text-sm text-yellow-100/80">
                            Para crear productos primero debes registrar una categoría para este negocio.
                        </p>

                    </div>

                    @if($categoryCreateRoute)

                        <a
                            href="{{ $createCategoryUrl }}"
                            data-save-product-draft
                            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-yellow-400 px-5 py-3 text-sm font-black text-slate-950 transition hover:bg-yellow-300">

                            <span>➕</span>
                            Crear categoría

                        </a>

                    @endif

                </div>

            </section>

        @endunless

        {{-- FORMULARIO --}}
        <form
            id="createProductForm"
            action="{{ $storeProductUrl }}"
            method="POST"
            enctype="multipart/form-data"
            class="w-full">

            @csrf

            <div class="grid grid-cols-1 items-start gap-8 xl:grid-cols-[1fr_420px]">

                {{-- COLUMNA IZQUIERDA --}}
                <section class="min-w-0 rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl md:p-8">

                    <div class="mb-8">

                        <h2 class="text-2xl font-black md:text-3xl">
                            Información del producto
                        </h2>

                        <p class="mt-2 text-slate-400">
                            Estos datos aparecerán en la tienda pública del negocio.
                        </p>

                    </div>

                    <div class="space-y-6">

                        {{-- NOMBRE --}}
                        <div>

                            <label for="name" class="mb-2 block text-sm font-bold text-slate-300">
                                Nombre del producto
                                <span class="text-red-400">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Ej: Pizza familiar, perfume, audífonos, combo especial..."
                                required
                                autocomplete="off"
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 text-white placeholder:text-slate-500 transition focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20">

                            @error('name')
                                <p class="mt-2 text-sm text-red-300">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- CATEGORÍA --}}
                        <div>

                            <div class="mb-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                                <label for="category_id" class="block text-sm font-bold text-slate-300">
                                    Categoría
                                    <span class="text-red-400">*</span>
                                </label>

                                @if($categoryCreateRoute)

                                    <a
                                        href="{{ $createCategoryUrl }}"
                                        data-save-product-draft
                                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-orange-400/20 bg-orange-500/10 px-4 py-2 text-xs font-black text-orange-200 transition hover:bg-orange-500/20">

                                        <span>➕</span>
                                        Crear nueva categoría

                                    </a>

                                @endif

                            </div>

                            <select
                                id="category_id"
                                name="category_id"
                                required
                                @disabled(!$hasCategories)
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 text-white transition focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20 disabled:cursor-not-allowed disabled:opacity-50">

                                <option value="">
                                    Selecciona una categoría
                                </option>

                                @foreach($categories ?? [] as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        @selected((string) $selectedCategoryId === (string) $category->id)>

                                        {{ $category->name }}

                                    </option>

                                @endforeach

                                @if($categoryCreateRoute)

                                    <option value="__create_new__">
                                        ➕ No encuentro mi categoría, crear nueva
                                    </option>

                                @endif

                            </select>

                            <p class="mt-2 text-xs text-slate-500">
                                Las categorías ayudan a ordenar el catálogo y mejorar la experiencia del cliente.
                            </p>

                            @error('category_id')
                                <p class="mt-2 text-sm text-red-300">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- DESCRIPCIÓN --}}
                        <div>

                            <label for="description" class="mb-2 block text-sm font-bold text-slate-300">
                                Descripción
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                maxlength="1000"
                                placeholder="Describe características, detalles, beneficios, ingredientes, tallas, colores o condiciones..."
                                class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 text-white placeholder:text-slate-500 transition focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20">{{ old('description') }}</textarea>

                            <div class="mt-2 flex items-center justify-between gap-3">

                                <p class="text-xs text-slate-500">
                                    Recomendado: máximo 1000 caracteres.
                                </p>

                                <p id="descriptionCounter" class="text-xs text-slate-500">
                                    0/1000
                                </p>

                            </div>

                            @error('description')
                                <p class="mt-2 text-sm text-red-300">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- PRECIOS --}}
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- PRECIO --}}
                            <div>

                                <label for="price" class="mb-2 block text-sm font-bold text-slate-300">
                                    Precio normal
                                    <span class="text-red-400">*</span>
                                </label>

                                <div class="flex overflow-hidden rounded-2xl border border-white/10 bg-slate-900/80 transition focus-within:border-orange-400 focus-within:ring-4 focus-within:ring-orange-500/20">

                                    <span class="flex items-center border-r border-white/10 px-5 font-bold text-slate-400">
                                        Bs
                                    </span>

                                    <input
                                        type="number"
                                        id="price"
                                        name="price"
                                        value="{{ old('price') }}"
                                        placeholder="0.00"
                                        min="0.01"
                                        step="0.01"
                                        required
                                        class="w-full bg-transparent px-5 py-4 text-white placeholder:text-slate-500 focus:outline-none">

                                </div>

                                @error('price')
                                    <p class="mt-2 text-sm text-red-300">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- DESCUENTO --}}
                            <div>

                                <label for="discount_price" class="mb-2 block text-sm font-bold text-slate-300">
                                    Precio con descuento
                                </label>

                                <div class="flex overflow-hidden rounded-2xl border border-white/10 bg-slate-900/80 transition focus-within:border-orange-400 focus-within:ring-4 focus-within:ring-orange-500/20">

                                    <span class="flex items-center border-r border-white/10 px-5 font-bold text-slate-400">
                                        Bs
                                    </span>

                                    <input
                                        type="number"
                                        id="discount_price"
                                        name="discount_price"
                                        value="{{ old('discount_price') }}"
                                        placeholder="Opcional"
                                        min="0"
                                        step="0.01"
                                        class="w-full bg-transparent px-5 py-4 text-white placeholder:text-slate-500 focus:outline-none">

                                </div>

                                <p id="discountHelp" class="mt-2 text-xs text-slate-500">
                                    El descuento debe ser menor al precio normal.
                                </p>

                                @error('discount_price')
                                    <p class="mt-2 text-sm text-red-300">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                        {{-- STOCK --}}
                        <div>

                            <label for="stock" class="mb-2 block text-sm font-bold text-slate-300">
                                Stock disponible
                            </label>

                            <input
                                type="number"
                                id="stock"
                                name="stock"
                                value="{{ old('stock', 0) }}"
                                min="0"
                                step="1"
                                placeholder="0"
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 text-white placeholder:text-slate-500 transition focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20">

                            <p class="mt-2 text-xs text-slate-500">
                                Usa 0 si todavía no quieres controlar inventario.
                            </p>

                            @error('stock')
                                <p class="mt-2 text-sm text-red-300">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </section>

                {{-- COLUMNA DERECHA --}}
                <aside class="w-full space-y-8">

                    {{-- IMAGEN --}}
                    <section class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl">

                        <h2 class="mb-2 text-2xl font-black">
                            Imagen
                        </h2>

                        <p class="mb-6 text-sm text-slate-400">
                            Sube una imagen clara del producto. Esto mejora la conversión.
                        </p>

                        <div class="relative mb-5 h-64 overflow-hidden rounded-3xl border border-white/10 bg-slate-900/80">

                            <img
                                id="imagePreview"
                                src=""
                                alt="Vista previa"
                                class="hidden h-full w-full object-cover">

                            <div
                                id="imageEmpty"
                                class="absolute inset-0 flex flex-col items-center justify-center px-6 text-center">

                                <div class="mb-3 text-5xl">
                                    🖼️
                                </div>

                                <p class="font-black text-white">
                                    Vista previa
                                </p>

                                <p class="mt-1 text-sm text-slate-400">
                                    La imagen seleccionada aparecerá aquí.
                                </p>

                            </div>

                        </div>

                        <label
                            for="image"
                            class="block cursor-pointer rounded-2xl border border-dashed border-white/20 bg-slate-900/80 px-5 py-6 text-center transition hover:bg-slate-900">

                            <span class="mb-2 block text-3xl">
                                📸
                            </span>

                            <span class="block font-black text-white">
                                Seleccionar imagen
                            </span>

                            <span
                                id="imageFileName"
                                class="mt-1 block text-sm text-slate-400">

                                JPG, PNG o WEBP hasta 4MB

                            </span>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/jpeg,image/png,image/webp"
                                class="hidden">

                        </label>

                        @error('image')
                            <p class="mt-2 text-sm text-red-300">
                                {{ $message }}
                            </p>
                        @enderror

                    </section>

                    {{-- CONFIGURACIÓN --}}
                    <section class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl">

                        <h2 class="mb-2 text-2xl font-black">
                            Configuración
                        </h2>

                        <p class="mb-6 text-sm text-slate-400">
                            Controla cómo aparecerá el producto en la tienda.
                        </p>

                        <div class="space-y-4">

                            {{-- DISPONIBLE --}}
                            <label class="flex cursor-pointer items-center justify-between gap-4 rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 transition hover:bg-slate-900">

                                <div>

                                    <p class="font-black text-white">
                                        Disponible
                                    </p>

                                    <p class="text-sm text-slate-400">
                                        Se podrá comprar en la tienda.
                                    </p>

                                </div>

                                <input
                                    type="hidden"
                                    name="is_available"
                                    value="0">

                                <input
                                    type="checkbox"
                                    name="is_available"
                                    value="1"
                                    class="h-5 w-5 rounded border-white/20 bg-slate-800 text-orange-500 focus:ring-orange-500"
                                    @checked(old('is_available', '1') == '1')>

                            </label>

                            {{-- DESTACADO --}}
                            <label class="flex cursor-pointer items-center justify-between gap-4 rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 transition hover:bg-slate-900">

                                <div>

                                    <p class="font-black text-white">
                                        Destacado
                                    </p>

                                    <p class="text-sm text-slate-400">
                                        Producto recomendado o promocionado.
                                    </p>

                                </div>

                                <input
                                    type="hidden"
                                    name="featured"
                                    value="0">

                                <input
                                    type="checkbox"
                                    name="featured"
                                    value="1"
                                    class="h-5 w-5 rounded border-white/20 bg-slate-800 text-orange-500 focus:ring-orange-500"
                                    @checked(old('featured') == '1')>

                            </label>

                        </div>

                    </section>

                    {{-- RESUMEN --}}
                    <section class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl">

                        <h2 class="mb-4 text-xl font-black">
                            Resumen rápido
                        </h2>

                        <div class="rounded-3xl border border-white/10 bg-slate-900/80 p-5">

                            <p id="previewName" class="text-lg font-black text-white">
                                Nombre del producto
                            </p>

                            <p id="previewCategory" class="mt-1 text-sm text-slate-400">
                                Categoría no seleccionada
                            </p>

                            <div class="mt-4 flex items-end justify-between gap-3">

                                <div>

                                    <p class="text-xs font-bold uppercase tracking-widest text-slate-500">
                                        Precio
                                    </p>

                                    <p id="previewPrice" class="text-2xl font-black text-orange-400">
                                        Bs 0.00
                                    </p>

                                </div>

                                <span id="previewBadge" class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-black text-emerald-300">
                                    Disponible
                                </span>

                            </div>

                        </div>

                    </section>

                    {{-- ACCIONES --}}
                    <section class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl">

                        <button
                            type="submit"
                            id="submitProductButton"
                            @disabled(!$hasCategories)
                            class="w-full rounded-2xl bg-gradient-to-r from-orange-500 to-rose-500 px-6 py-5 text-lg font-black text-white shadow-[0_15px_40px_rgba(249,115,22,0.35)] transition hover:scale-[1.02] disabled:cursor-not-allowed disabled:opacity-40 disabled:hover:scale-100">

                            Guardar producto

                        </button>

                        <a
                            href="{{ $productsIndexUrl }}"
                            class="mt-4 block w-full rounded-2xl border border-white/10 bg-white/5 px-6 py-4 text-center text-sm font-bold text-slate-300 transition hover:bg-white/10">

                            Cancelar

                        </a>

                    </section>

                </aside>

            </div>

        </form>

    </main>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const draftKey = 'foodlink.product.create.draft';

        const productForm = document.getElementById('createProductForm');

        const categorySelect = document.getElementById('category_id');

        const createCategoryUrl = @json($createCategoryUrl);

        const urlParams = new URLSearchParams(window.location.search);

        const newCategoryId = urlParams.get('category_id') || @json((string) ($selectedCategoryId ?? ''));

        const nameInput = document.getElementById('name');
        const descriptionInput = document.getElementById('description');
        const descriptionCounter = document.getElementById('descriptionCounter');

        const priceInput = document.getElementById('price');
        const discountInput = document.getElementById('discount_price');
        const discountHelp = document.getElementById('discountHelp');

        const availableInput = document.querySelector('input[name="is_available"][type="checkbox"]');

        const previewName = document.getElementById('previewName');
        const previewCategory = document.getElementById('previewCategory');
        const previewPrice = document.getElementById('previewPrice');
        const previewBadge = document.getElementById('previewBadge');

        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const imageEmpty = document.getElementById('imageEmpty');
        const imageFileName = document.getElementById('imageFileName');

        const submitButton = document.getElementById('submitProductButton');

        function safeSelectorName(name) {
            if (window.CSS && typeof window.CSS.escape === 'function') {
                return window.CSS.escape(name);
            }

            return name.replace(/"/g, '\\"');
        }

        function restoreDraft() {
            if (!productForm) {
                return;
            }

            const savedDraft = sessionStorage.getItem(draftKey);

            if (!savedDraft) {
                if (newCategoryId && categorySelect) {
                    categorySelect.value = newCategoryId;
                }

                return;
            }

            try {
                const data = JSON.parse(savedDraft);

                Object.keys(data).forEach(function (name) {
                    if (name === '_token' || name === 'image') {
                        return;
                    }

                    if (name === 'category_id' && newCategoryId) {
                        return;
                    }

                    const safeName = safeSelectorName(name);

                    const checkbox = productForm.querySelector(`input[type="checkbox"][name="${safeName}"]`);

                    if (checkbox) {
                        checkbox.checked = data[name] === '1' || data[name] === true || data[name] === checkbox.value;
                        return;
                    }

                    const radio = productForm.querySelector(`input[type="radio"][name="${safeName}"][value="${data[name]}"]`);

                    if (radio) {
                        radio.checked = true;
                        return;
                    }

                    const fields = productForm.querySelectorAll(`[name="${safeName}"]`);

                    if (!fields.length) {
                        return;
                    }

                    const field = Array.from(fields).find(function (input) {
                        return input.type !== 'hidden' && input.type !== 'file';
                    }) || fields[0];

                    if (!field || field.type === 'file') {
                        return;
                    }

                    field.value = data[name] ?? '';
                });

                if (newCategoryId && categorySelect) {
                    categorySelect.value = newCategoryId;
                }

                sessionStorage.removeItem(draftKey);
            } catch (error) {
                sessionStorage.removeItem(draftKey);
            }
        }

        function saveProductDraft() {
            if (!productForm) {
                return;
            }

            const formData = new FormData(productForm);
            const data = {};

            formData.forEach(function (value, key) {
                if (key === '_token' || key === 'image') {
                    return;
                }

                data[key] = value;
            });

            const checkboxes = productForm.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(function (checkbox) {
                data[checkbox.name] = checkbox.checked ? checkbox.value : '0';
            });

            sessionStorage.setItem(draftKey, JSON.stringify(data));
        }

        function goToCreateCategory() {
            if (!createCategoryUrl || createCategoryUrl === '#') {
                alert('La ruta para crear categorías no está disponible.');
                return;
            }

            saveProductDraft();
            window.location.href = createCategoryUrl;
        }

        document.querySelectorAll('[data-save-product-draft]').forEach(function (button) {
            button.addEventListener('click', function () {
                saveProductDraft();
            });
        });

        if (categorySelect) {
            categorySelect.addEventListener('change', function () {
                if (this.value === '__create_new__') {
                    goToCreateCategory();
                    return;
                }

                updatePreview();
            });
        }

        function updateDescriptionCounter() {
            if (!descriptionInput || !descriptionCounter) {
                return;
            }

            const length = descriptionInput.value.length;

            descriptionCounter.textContent = `${length}/1000`;

            if (length >= 1000) {
                descriptionCounter.classList.remove('text-slate-500');
                descriptionCounter.classList.add('text-yellow-300');
            } else {
                descriptionCounter.classList.add('text-slate-500');
                descriptionCounter.classList.remove('text-yellow-300');
            }
        }

        function updateDiscountHelp() {
            if (!priceInput || !discountInput || !discountHelp) {
                return;
            }

            const price = parseFloat(priceInput.value || '0');
            const discount = parseFloat(discountInput.value || '0');

            discountHelp.classList.remove('text-red-300', 'text-emerald-300', 'text-slate-500');

            if (discount > 0 && price > 0 && discount >= price) {
                discountHelp.textContent = 'El descuento debe ser menor al precio normal.';
                discountHelp.classList.add('text-red-300');
                return;
            }

            if (discount > 0 && price > 0 && discount < price) {
                discountHelp.textContent = 'Descuento válido.';
                discountHelp.classList.add('text-emerald-300');
                return;
            }

            discountHelp.textContent = 'El descuento debe ser menor al precio normal.';
            discountHelp.classList.add('text-slate-500');
        }

        function formatPrice(value) {
            const number = parseFloat(value || '0');

            if (Number.isNaN(number)) {
                return 'Bs 0.00';
            }

            return `Bs ${number.toFixed(2)}`;
        }

        function updatePreview() {
            if (previewName && nameInput) {
                previewName.textContent = nameInput.value.trim() || 'Nombre del producto';
            }

            if (previewCategory && categorySelect) {
                const selectedOption = categorySelect.options[categorySelect.selectedIndex];

                if (selectedOption && selectedOption.value && selectedOption.value !== '__create_new__') {
                    previewCategory.textContent = selectedOption.textContent.trim();
                } else {
                    previewCategory.textContent = 'Categoría no seleccionada';
                }
            }

            if (previewPrice && priceInput && discountInput) {
                const discount = parseFloat(discountInput.value || '0');

                previewPrice.textContent = discount > 0
                    ? formatPrice(discountInput.value)
                    : formatPrice(priceInput.value);
            }

            if (previewBadge && availableInput) {
                if (availableInput.checked) {
                    previewBadge.textContent = 'Disponible';
                    previewBadge.className = 'rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-black text-emerald-300';
                } else {
                    previewBadge.textContent = 'Agotado';
                    previewBadge.className = 'rounded-full bg-red-500/10 px-3 py-1 text-xs font-black text-red-300';
                }
            }
        }

        if (imageInput && imagePreview && imageEmpty && imageFileName) {
            imageInput.addEventListener('change', function () {
                const file = this.files && this.files[0];

                if (!file) {
                    imagePreview.src = '';
                    imagePreview.classList.add('hidden');
                    imageEmpty.classList.remove('hidden');
                    imageFileName.textContent = 'JPG, PNG o WEBP hasta 4MB';
                    return;
                }

                const allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ];

                if (!allowedTypes.includes(file.type)) {
                    alert('Formato no permitido. Usa JPG, PNG o WEBP.');
                    this.value = '';
                    imagePreview.src = '';
                    imagePreview.classList.add('hidden');
                    imageEmpty.classList.remove('hidden');
                    imageFileName.textContent = 'JPG, PNG o WEBP hasta 4MB';
                    return;
                }

                const maxSize = 4 * 1024 * 1024;

                if (file.size > maxSize) {
                    alert('La imagen no debe superar los 4MB.');
                    this.value = '';
                    imagePreview.src = '';
                    imagePreview.classList.add('hidden');
                    imageEmpty.classList.remove('hidden');
                    imageFileName.textContent = 'JPG, PNG o WEBP hasta 4MB';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (event) {
                    imagePreview.src = event.target.result;
                    imagePreview.classList.remove('hidden');
                    imageEmpty.classList.add('hidden');
                    imageFileName.textContent = file.name;
                };

                reader.readAsDataURL(file);
            });
        }

        [
            nameInput,
            descriptionInput,
            priceInput,
            discountInput,
            availableInput
        ].forEach(function (field) {
            if (!field) {
                return;
            }

            field.addEventListener('input', function () {
                updateDescriptionCounter();
                updateDiscountHelp();
                updatePreview();
            });

            field.addEventListener('change', function () {
                updateDescriptionCounter();
                updateDiscountHelp();
                updatePreview();
            });
        });

        if (productForm && submitButton) {
            productForm.addEventListener('submit', function (event) {
                if (categorySelect && categorySelect.value === '__create_new__') {
                    event.preventDefault();
                    goToCreateCategory();
                    return;
                }

                submitButton.disabled = true;
                submitButton.classList.add('cursor-not-allowed', 'opacity-70');
                submitButton.textContent = 'Guardando producto...';
            });
        }

        restoreDraft();
        updateDescriptionCounter();
        updateDiscountHelp();
        updatePreview();
    });
</script>

@endsection