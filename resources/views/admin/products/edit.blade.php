@extends('layouts.app')

@section('content')

@php
    $authUser = auth()->user();

    $tenant = $tenant ?? ($product->tenant ?? ($authUser?->tenant ?? null));

    $tenantName = $tenant?->name ?? 'Mi negocio';
    $tenantSlug = $tenant?->slug ?? null;

    $categoriesList = collect($categories ?? []);
    $hasCategories = $categoriesList->count() > 0;

    $imagePath = $product->image ?? null;

    if ($imagePath) {
        $currentImage = \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://'])
            ? $imagePath
            : asset('storage/' . ltrim($imagePath, '/'));
    } else {
        $currentImage = null;
    }

    $selectedCategory = old('category_id', $product->category_id);
@endphp

<div class="min-h-screen overflow-x-hidden bg-slate-950 text-white">

    {{-- BACKGROUND --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-40 -left-40 h-[520px] w-[520px] rounded-full bg-blue-500/20 blur-3xl"></div>
        <div class="absolute top-40 -right-40 h-[520px] w-[520px] rounded-full bg-pink-500/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/3 h-[520px] w-[520px] rounded-full bg-orange-500/10 blur-3xl"></div>
    </div>

    <main class="relative z-10 mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <section class="mb-8 rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl">

            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-center gap-4">

                    <div class="relative shrink-0">
                        <div class="absolute inset-0 rounded-3xl bg-blue-500 opacity-40 blur-xl"></div>

                        <div class="relative flex h-16 w-16 items-center justify-center rounded-3xl bg-gradient-to-br from-blue-500 to-cyan-500 text-4xl shadow-2xl">
                            ✏️
                        </div>
                    </div>

                    <div class="min-w-0">
                        <h1 class="text-3xl font-black tracking-tight md:text-4xl">
                            Editar producto
                        </h1>

                        <p class="mt-1 text-sm text-slate-400">
                            Actualiza la información del producto de
                            <span class="font-bold text-white">
                                {{ $tenantName }}
                            </span>
                        </p>
                    </div>

                </div>

                <div class="flex flex-wrap items-center gap-3">

                    <a href="{{ route('admin.products.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-slate-200 transition hover:bg-white/10">
                        <span>⬅️</span>
                        Volver
                    </a>

                    @if (Route::has('admin.categories.index'))
                        <a href="{{ route('admin.categories.index') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl border border-purple-400/20 bg-purple-500/10 px-5 py-3 text-sm font-bold text-purple-200 transition hover:bg-purple-500/20">
                            <span>🗂️</span>
                            Categorías
                        </a>
                    @endif

                    @if ($tenantSlug)
                        <a href="{{ route('tenant.show', $tenantSlug) }}" target="_blank"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl border border-cyan-400/20 bg-cyan-500/10 px-5 py-3 text-sm font-bold text-cyan-200 transition hover:bg-cyan-500/20">
                            <span>🌐</span>
                            Ver tienda
                        </a>
                    @endif

                </div>

            </div>

        </section>

        {{-- ALERTAS --}}
        @if (session('success'))
            <div class="mb-8 rounded-3xl border border-emerald-400/20 bg-emerald-500/10 px-6 py-5 text-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-8 rounded-3xl border border-red-400/20 bg-red-500/10 px-6 py-5 text-red-200">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-8 rounded-3xl border border-red-400/20 bg-red-500/10 px-6 py-5 text-red-200">

                <p class="mb-3 font-black">
                    Revisa los siguientes errores:
                </p>

                <ul class="list-inside list-disc space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>

            </div>
        @endif

        @unless ($hasCategories)
            <div class="mb-8 rounded-3xl border border-yellow-400/20 bg-yellow-500/10 px-6 py-5 text-yellow-100">

                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                    <div>
                        <p class="font-black">
                            No tienes categorías registradas.
                        </p>

                        <p class="mt-1 text-sm text-yellow-100/80">
                            Para editar correctamente este producto debes tener al menos una categoría activa.
                        </p>
                    </div>

                    @if (Route::has('admin.categories.create'))
                        <a href="{{ route('admin.categories.create') }}"
                            class="inline-flex items-center justify-center rounded-2xl bg-yellow-400 px-5 py-3 text-sm font-black text-slate-950 transition hover:bg-yellow-300">
                            Crear categoría
                        </a>
                    @endif

                </div>

            </div>
        @endunless

        <div class="grid grid-cols-1 items-start gap-8 xl:grid-cols-[minmax(0,1fr)_420px]">

            {{-- FORMULARIO UPDATE --}}
            <form id="updateProductForm"
                method="POST"
                action="{{ route('admin.products.update', $product->id) }}"
                enctype="multipart/form-data"
                class="min-w-0">

                @csrf
                @method('PUT')

                <section class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl md:p-8">

                    <div class="mb-8">
                        <h2 class="text-2xl font-black md:text-3xl">
                            Información del producto
                        </h2>

                        <p class="mt-2 text-slate-400">
                            Modifica los datos que verá el cliente en la tienda pública.
                        </p>
                    </div>

                    <div class="space-y-6">

                        {{-- NOMBRE --}}
                        <div>
                            <label for="name" class="mb-2 block text-sm font-bold text-slate-300">
                                Nombre del producto
                                <span class="text-red-400">*</span>
                            </label>

                            <input type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                placeholder="Ej: Pizza familiar, combo especial, producto premium..."
                                required
                                autocomplete="off"
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 text-white placeholder:text-slate-500 transition focus:border-blue-400 focus:outline-none focus:ring-4 focus:ring-blue-500/20">

                            @error('name')
                                <p class="mt-2 text-sm text-red-300">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- CATEGORÍA --}}
                        <div>
                            <label for="category_id" class="mb-2 block text-sm font-bold text-slate-300">
                                Categoría
                                <span class="text-red-400">*</span>
                            </label>

                            <select id="category_id"
                                name="category_id"
                                required
                                @disabled(!$hasCategories)
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 text-white transition focus:border-blue-400 focus:outline-none focus:ring-4 focus:ring-blue-500/20 disabled:cursor-not-allowed disabled:opacity-50">

                                <option value="">
                                    Selecciona una categoría
                                </option>

                                @foreach ($categoriesList as $category)
                                    <option value="{{ $category->id }}" @selected((string) $selectedCategory === (string) $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>

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

                            <textarea id="description"
                                name="description"
                                rows="5"
                                placeholder="Describe características, detalles, contenido, beneficios, ingredientes o condiciones..."
                                class="w-full resize-none rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 text-white placeholder:text-slate-500 transition focus:border-blue-400 focus:outline-none focus:ring-4 focus:ring-blue-500/20">{{ old('description', $product->description) }}</textarea>

                            @error('description')
                                <p class="mt-2 text-sm text-red-300">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- PRECIOS --}}
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            <div>
                                <label for="price" class="mb-2 block text-sm font-bold text-slate-300">
                                    Precio normal
                                    <span class="text-red-400">*</span>
                                </label>

                                <div class="flex overflow-hidden rounded-2xl border border-white/10 bg-slate-900/80 transition focus-within:border-blue-400 focus-within:ring-4 focus-within:ring-blue-500/20">

                                    <span class="flex items-center border-r border-white/10 px-5 font-bold text-slate-400">
                                        Bs
                                    </span>

                                    <input type="number"
                                        id="price"
                                        name="price"
                                        value="{{ old('price', $product->price) }}"
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

                            <div>
                                <label for="discount_price" class="mb-2 block text-sm font-bold text-slate-300">
                                    Precio con descuento
                                </label>

                                <div class="flex overflow-hidden rounded-2xl border border-white/10 bg-slate-900/80 transition focus-within:border-blue-400 focus-within:ring-4 focus-within:ring-blue-500/20">

                                    <span class="flex items-center border-r border-white/10 px-5 font-bold text-slate-400">
                                        Bs
                                    </span>

                                    <input type="number"
                                        id="discount_price"
                                        name="discount_price"
                                        value="{{ old('discount_price', $product->discount_price) }}"
                                        placeholder="Opcional"
                                        min="0"
                                        step="0.01"
                                        class="w-full bg-transparent px-5 py-4 text-white placeholder:text-slate-500 focus:outline-none">
                                </div>

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

                            <input type="number"
                                id="stock"
                                name="stock"
                                value="{{ old('stock', $product->stock ?? 0) }}"
                                min="0"
                                step="1"
                                placeholder="0"
                                class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 text-white placeholder:text-slate-500 transition focus:border-blue-400 focus:outline-none focus:ring-4 focus:ring-blue-500/20">

                            <p class="mt-2 text-xs text-slate-500">
                                Usa 0 si todavía no quieres controlar inventario.
                            </p>

                            @error('stock')
                                <p class="mt-2 text-sm text-red-300">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- INFORMACIÓN TÉCNICA --}}
                        <div class="rounded-3xl border border-blue-400/20 bg-blue-500/10 p-5">

                            <h3 class="mb-3 font-black text-blue-200">
                                Información técnica
                            </h3>

                            <div class="grid gap-4 text-sm text-slate-300 sm:grid-cols-2">

                                <div>
                                    <span class="text-slate-500">
                                        ID producto:
                                    </span>

                                    <span class="font-bold text-white">
                                        {{ $product->id }}
                                    </span>
                                </div>

                                <div>
                                    <span class="text-slate-500">
                                        Tenant ID:
                                    </span>

                                    <span class="font-bold text-white">
                                        {{ $product->tenant_id }}
                                    </span>
                                </div>

                                <div>
                                    <span class="text-slate-500">
                                        Creado:
                                    </span>

                                    <span class="font-bold text-white">
                                        {{ optional($product->created_at)->format('d/m/Y H:i') ?? 'Sin fecha' }}
                                    </span>
                                </div>

                                <div>
                                    <span class="text-slate-500">
                                        Actualizado:
                                    </span>

                                    <span class="font-bold text-white">
                                        {{ optional($product->updated_at)->format('d/m/Y H:i') ?? 'Sin fecha' }}
                                    </span>
                                </div>

                            </div>

                        </div>

                    </div>

                </section>

            </form>

            {{-- COLUMNA DERECHA --}}
            <aside class="w-full space-y-8 xl:sticky xl:top-24">

                {{-- IMAGEN --}}
                <section class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl">

                    <h2 class="mb-2 text-2xl font-black">
                        Imagen
                    </h2>

                    <p class="mb-6 text-sm text-slate-400">
                        Puedes conservar la imagen actual o subir una nueva.
                    </p>

                    <div class="relative mb-5 h-64 overflow-hidden rounded-3xl border border-white/10 bg-slate-900/80">

                        @if ($currentImage)
                            <img id="imagePreview"
                                src="{{ $currentImage }}"
                                alt="{{ $product->name }}"
                                class="h-full w-full object-cover">

                            <div id="imageEmpty"
                                class="absolute inset-0 hidden flex-col items-center justify-center px-6 text-center">
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
                        @else
                            <img id="imagePreview"
                                src=""
                                alt="Vista previa"
                                class="hidden h-full w-full object-cover">

                            <div id="imageEmpty"
                                class="absolute inset-0 flex flex-col items-center justify-center px-6 text-center">
                                <div class="mb-3 text-5xl">
                                    🖼️
                                </div>

                                <p class="font-black text-white">
                                    Sin imagen
                                </p>

                                <p class="mt-1 text-sm text-slate-400">
                                    Selecciona una imagen para este producto.
                                </p>
                            </div>
                        @endif

                    </div>

                    <label for="image"
                        class="block cursor-pointer rounded-2xl border border-dashed border-white/20 bg-slate-900/80 px-5 py-6 text-center transition hover:bg-slate-900">

                        <span class="mb-2 block text-3xl">
                            📸
                        </span>

                        <span class="block font-black text-white">
                            Cambiar imagen
                        </span>

                        <span id="imageFileName" class="mt-1 block text-sm text-slate-400">
                            JPG, PNG o WEBP hasta 4MB
                        </span>

                        <input type="file"
                            id="image"
                            name="image"
                            form="updateProductForm"
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

                            <input type="hidden"
                                name="is_available"
                                value="0"
                                form="updateProductForm">

                            <input type="checkbox"
                                name="is_available"
                                value="1"
                                form="updateProductForm"
                                class="h-5 w-5 rounded border-white/20 bg-slate-800 text-blue-500 focus:ring-blue-500"
                                @checked(old('is_available', $product->is_available) == 1)>
                        </label>

                        {{-- DESTACADO --}}
                        <label class="flex cursor-pointer items-center justify-between gap-4 rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 transition hover:bg-slate-900">

                            <div>
                                <p class="font-black text-white">
                                    Destacado
                                </p>

                                <p class="text-sm text-slate-400">
                                    Producto recomendado.
                                </p>
                            </div>

                            <input type="hidden"
                                name="featured"
                                value="0"
                                form="updateProductForm">

                            <input type="checkbox"
                                name="featured"
                                value="1"
                                form="updateProductForm"
                                class="h-5 w-5 rounded border-white/20 bg-slate-800 text-blue-500 focus:ring-blue-500"
                                @checked(old('featured', $product->featured) == 1)>
                        </label>

                    </div>

                </section>

                {{-- ACCIONES UPDATE --}}
                <section class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl">

                    <button type="submit"
                        form="updateProductForm"
                        data-update-submit
                        @disabled(!$hasCategories)
                        class="w-full rounded-2xl bg-gradient-to-r from-blue-500 via-cyan-500 to-emerald-500 px-6 py-5 text-lg font-black text-white shadow-[0_15px_40px_rgba(59,130,246,0.35)] transition hover:scale-[1.02] disabled:cursor-not-allowed disabled:opacity-40 disabled:hover:scale-100">
                        Guardar cambios
                    </button>

                    <a href="{{ route('admin.products.index') }}"
                        class="mt-4 block w-full rounded-2xl border border-white/10 bg-white/5 px-6 py-4 text-center text-sm font-bold text-slate-300 transition hover:bg-white/10">
                        Cancelar
                    </a>

                </section>

                {{-- FORMULARIO DELETE COMPLETAMENTE SEPARADO --}}
                <section class="rounded-[2rem] border border-red-400/20 bg-red-500/10 p-6 shadow-2xl backdrop-blur-2xl">

                    <h2 class="mb-2 text-xl font-black text-red-200">
                        Zona peligrosa
                    </h2>

                    <p class="mb-5 text-sm text-red-100/80">
                        Esta acción eliminará el producto del catálogo. No se puede deshacer.
                    </p>

                    <form id="deleteProductForm"
                        action="{{ route('admin.products.destroy', $product->id) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            data-delete-submit
                            class="w-full rounded-2xl border border-red-400/30 bg-red-500/20 px-6 py-4 text-sm font-black text-red-100 transition hover:bg-red-500/30">
                            Eliminar producto
                        </button>

                    </form>

                </section>

            </aside>

        </div>

    </main>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const imageEmpty = document.getElementById('imageEmpty');
        const imageFileName = document.getElementById('imageFileName');

        const updateForm = document.getElementById('updateProductForm');
        const updateButton = document.querySelector('[data-update-submit]');

        const deleteForm = document.getElementById('deleteProductForm');
        const deleteButton = document.querySelector('[data-delete-submit]');

        if (imageInput && imagePreview && imageFileName) {
            imageInput.addEventListener('change', function () {
                const file = this.files && this.files[0];

                if (!file) {
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
                    return;
                }

                const maxSize = 4 * 1024 * 1024;

                if (file.size > maxSize) {
                    alert('La imagen no debe superar los 4MB.');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (event) {
                    imagePreview.src = event.target.result;
                    imagePreview.classList.remove('hidden');

                    if (imageEmpty) {
                        imageEmpty.classList.add('hidden');
                        imageEmpty.classList.remove('flex');
                    }

                    imageFileName.textContent = file.name;
                };

                reader.readAsDataURL(file);
            });
        }

        if (updateForm && updateButton) {
            updateForm.addEventListener('submit', function () {
                updateButton.disabled = true;
                updateButton.innerText = 'Guardando cambios...';
            });
        }

        if (deleteForm) {
            deleteForm.addEventListener('submit', function (event) {
                const confirmed = confirm('¿Seguro que deseas eliminar este producto? Esta acción no se puede deshacer.');

                if (!confirmed) {
                    event.preventDefault();
                    return;
                }

                if (deleteButton) {
                    deleteButton.disabled = true;
                    deleteButton.innerText = 'Eliminando producto...';
                }
            });
        }
    });
</script>

@endsection