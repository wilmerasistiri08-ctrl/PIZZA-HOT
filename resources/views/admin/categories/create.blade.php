@extends('layouts.app')

@section('content')

@php
    $returnToValue = old('return_to', $returnTo ?? request('return_to', 'categories_index'));

    $isProductCreateReturn = $returnToValue === 'product_create';

    $cancelUrl = $isProductCreateReturn
        ? route('admin.products.create')
        : route('admin.categories.index');

    $cancelText = $isProductCreateReturn
        ? 'Volver a crear producto'
        : 'Cancelar';

    $backUrl = $cancelUrl;
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

                        <div class="relative flex h-16 w-16 items-center justify-center rounded-3xl bg-gradient-to-br from-orange-500 to-rose-500 text-4xl shadow-2xl">
                            ➕
                        </div>
                    </div>

                    <div>
                        <div class="mb-2 flex flex-wrap items-center gap-2">

                            <h1 class="text-3xl font-black md:text-4xl">
                                Crear categoría
                            </h1>

                            @if($isProductCreateReturn)
                                <span class="rounded-full border border-cyan-400/20 bg-cyan-500/10 px-3 py-1 text-xs font-black text-cyan-200">
                                    Viene desde crear producto
                                </span>
                            @endif

                        </div>

                        <p class="mt-1 max-w-2xl text-sm text-slate-400">
                            Organiza tus productos por secciones para que el cliente encuentre rápido lo que busca.
                        </p>
                    </div>

                </div>

                <div class="flex flex-wrap items-center gap-3">

                    <a
                        href="{{ $backUrl }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-slate-200 transition hover:bg-white/10">

                        <span>⬅️</span>
                        Volver

                    </a>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl border border-cyan-400/20 bg-cyan-500/10 px-5 py-3 text-sm font-bold text-cyan-200 transition hover:bg-cyan-500/20">

                        <span>📦</span>
                        Productos

                    </a>

                </div>

            </div>

        </section>

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <section class="mb-8 rounded-[2rem] border border-emerald-400/20 bg-emerald-500/10 p-6 text-emerald-200">
                {{ session('success') }}
            </section>
        @endif

        {{-- ALERT ERROR --}}
        @if(session('error'))
            <section class="mb-8 rounded-[2rem] border border-red-400/20 bg-red-500/10 p-6 text-red-200">
                {{ session('error') }}
            </section>
        @endif

        {{-- VALIDATION ERRORS --}}
        @if($errors->any())
            <section class="mb-8 rounded-[2rem] border border-red-400/20 bg-red-500/10 p-6 text-red-200">

                <h3 class="mb-3 text-lg font-black">
                    Revisa los siguientes errores:
                </h3>

                <ul class="space-y-2 text-sm">
                    @foreach($errors->all() as $error)
                        <li>
                            • {{ $error }}
                        </li>
                    @endforeach
                </ul>

            </section>
        @endif

        {{-- INFO RETURN --}}
        @if($isProductCreateReturn)
            <section class="mb-8 rounded-[2rem] border border-cyan-400/20 bg-cyan-500/10 p-6 text-cyan-100">

                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                    <div>
                        <h2 class="font-black">
                            Crearás una categoría para continuar con tu producto
                        </h2>

                        <p class="mt-1 text-sm text-cyan-100/80">
                            Al guardar, volverás automáticamente al formulario de creación de producto.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-cyan-400/20 bg-slate-950/40 px-4 py-3 text-sm font-bold">
                        Flujo activo: producto → categoría → producto
                    </div>

                </div>

            </section>
        @endif

        {{-- FORM --}}
        <form
            id="createCategoryForm"
            action="{{ route('admin.categories.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            @csrf

            <input
                type="hidden"
                name="return_to"
                value="{{ $returnToValue }}">

            {{-- LEFT FORM --}}
            <section class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl md:p-8 lg:col-span-2">

                <div class="mb-8">

                    <h2 class="text-2xl font-black">
                        Información de la categoría
                    </h2>

                    <p class="mt-2 text-sm text-slate-400">
                        Estos datos aparecerán en el panel administrativo y ayudarán a ordenar el catálogo público.
                    </p>

                </div>

                <div class="space-y-7">

                    {{-- NAME --}}
                    <div>

                        <label for="name" class="mb-3 block text-sm font-black text-slate-200">
                            Nombre de la categoría
                            <span class="text-orange-400">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="off"
                            placeholder="Ej: Promociones, Ropa, Tecnología, Belleza"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 text-white placeholder:text-slate-500 transition focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20">

                        @error('name')
                            <p class="mt-2 text-sm text-red-300">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- SLUG --}}
                    <div>

                        <label for="slug" class="mb-3 block text-sm font-black text-slate-200">
                            URL interna de la categoría
                        </label>

                        <div class="flex items-center overflow-hidden rounded-2xl border border-white/10 bg-slate-900/80 transition focus-within:border-orange-400 focus-within:ring-4 focus-within:ring-orange-500/20">

                            <span class="hidden border-r border-white/10 px-5 text-sm text-slate-500 sm:inline-flex">
                                categoria/
                            </span>

                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                value="{{ old('slug') }}"
                                autocomplete="off"
                                placeholder="promociones"
                                class="w-full bg-transparent px-5 py-4 text-white placeholder:text-slate-500 focus:outline-none">

                        </div>

                        <p class="mt-2 text-xs text-slate-500">
                            Puedes dejarlo vacío y se generará automáticamente desde el nombre.
                        </p>

                        @error('slug')
                            <p class="mt-2 text-sm text-red-300">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- STATUS --}}
                    <div class="rounded-3xl border border-white/10 bg-slate-900/60 p-5">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>
                                <h3 class="font-black text-slate-100">
                                    Estado de la categoría
                                </h3>

                                <p class="mt-1 text-sm text-slate-400">
                                    Si está activa, podrá usarse para organizar productos del negocio.
                                </p>
                            </div>

                            <label class="inline-flex cursor-pointer items-center">

                                <input
                                    type="hidden"
                                    name="is_active"
                                    value="0">

                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    class="peer sr-only"
                                    @checked(old('is_active', '1') == '1')>

                                <div class="relative h-9 w-16 rounded-full bg-slate-700 transition after:absolute after:left-1 after:top-1 after:h-7 after:w-7 after:rounded-full after:bg-white after:transition peer-checked:bg-emerald-500 peer-checked:after:translate-x-7"></div>

                                <span class="ml-3 text-sm font-bold text-slate-200">
                                    Activa
                                </span>

                            </label>

                        </div>

                    </div>

                    {{-- QUICK SUGGESTIONS --}}
                    <div class="rounded-3xl border border-white/10 bg-slate-900/60 p-5">

                        <h3 class="mb-4 font-black text-slate-100">
                            Sugerencias rápidas
                        </h3>

                        <div class="flex flex-wrap gap-3">

                            @foreach(['Promociones', 'Destacados', 'Novedades', 'Accesorios', 'Cuidado personal', 'Tecnología', 'Ropa', 'Combos'] as $suggestion)
                                <button
                                    type="button"
                                    data-category-suggestion="{{ $suggestion }}"
                                    class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-xs font-bold text-slate-300 transition hover:border-orange-400/30 hover:bg-orange-500/10 hover:text-orange-200">
                                    {{ $suggestion }}
                                </button>
                            @endforeach

                        </div>

                    </div>

                </div>

            </section>

            {{-- RIGHT COLUMN --}}
            <aside class="space-y-8">

                {{-- IMAGE --}}
                <section class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl">

                    <h2 class="mb-2 text-2xl font-black">
                        Imagen
                    </h2>

                    <p class="mb-6 text-sm text-slate-400">
                        Sube una imagen representativa para identificar la categoría.
                    </p>

                    <div class="rounded-3xl border border-dashed border-white/20 bg-slate-900/60 p-5 text-center">

                        <div
                            id="imagePreviewBox"
                            class="mb-5 flex aspect-video w-full items-center justify-center overflow-hidden rounded-2xl border border-white/10 bg-slate-950">

                            <div id="imageEmptyState" class="px-4 text-center">

                                <div class="mb-3 text-5xl">
                                    🖼️
                                </div>

                                <p class="text-sm text-slate-400">
                                    Vista previa de la imagen
                                </p>

                            </div>

                            <img
                                id="imagePreview"
                                src=""
                                alt="Vista previa"
                                class="hidden h-full w-full object-cover">

                        </div>

                        <label
                            for="image"
                            class="inline-flex w-full cursor-pointer items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-orange-500 to-rose-500 px-5 py-4 text-sm font-black text-white shadow-[0_15px_40px_rgba(249,115,22,0.30)] transition hover:scale-[1.02]">

                            <span>📸</span>
                            Seleccionar imagen

                        </label>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/png,image/jpeg,image/jpg,image/webp"
                            class="hidden">

                        <p id="imageFileName" class="mt-4 text-xs text-slate-500">
                            Formatos permitidos: JPG, PNG, WEBP. Máximo 4MB.
                        </p>

                        @error('image')
                            <p class="mt-2 text-sm text-red-300">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </section>

                {{-- HELP --}}
                <section class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl">

                    <h2 class="mb-4 text-xl font-black">
                        Ejemplos útiles
                    </h2>

                    <div class="space-y-3 text-sm text-slate-300">

                        <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-slate-900/60 p-4">
                            <span class="text-2xl">🔥</span>
                            <span>Promociones</span>
                        </div>

                        <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-slate-900/60 p-4">
                            <span class="text-2xl">🛍️</span>
                            <span>Productos destacados</span>
                        </div>

                        <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-slate-900/60 p-4">
                            <span class="text-2xl">💄</span>
                            <span>Belleza y cuidado personal</span>
                        </div>

                        <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-slate-900/60 p-4">
                            <span class="text-2xl">📱</span>
                            <span>Tecnología y accesorios</span>
                        </div>

                    </div>

                </section>

                {{-- SUBMIT --}}
                <section class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-2xl">

                    <button
                        type="submit"
                        id="submitCategoryButton"
                        class="w-full rounded-2xl bg-gradient-to-r from-orange-500 via-pink-500 to-rose-500 px-6 py-5 text-lg font-black text-white shadow-[0_15px_50px_rgba(249,115,22,0.35)] transition hover:scale-[1.02]">

                        Guardar categoría

                    </button>

                    <a
                        href="{{ $cancelUrl }}"
                        class="mt-4 inline-flex w-full items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-6 py-4 text-sm font-bold text-slate-200 transition hover:bg-white/10">

                        {{ $cancelText }}

                    </a>

                </section>

            </aside>

        </form>

    </main>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('createCategoryForm');
        const submitButton = document.getElementById('submitCategoryButton');

        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const imageEmptyState = document.getElementById('imageEmptyState');
        const imageFileName = document.getElementById('imageFileName');

        function slugify(text) {
            return text
                .toString()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }

        if (nameInput && slugInput) {
            if (slugInput.value.trim() !== '') {
                slugInput.dataset.edited = 'true';
            }

            nameInput.addEventListener('input', function () {
                if (!slugInput.dataset.edited) {
                    slugInput.value = slugify(this.value);
                }
            });

            slugInput.addEventListener('input', function () {
                this.dataset.edited = 'true';
                this.value = slugify(this.value);
            });
        }

        document.querySelectorAll('[data-category-suggestion]').forEach(function (button) {
            button.addEventListener('click', function () {
                const value = this.dataset.categorySuggestion || '';

                if (!nameInput || !slugInput) {
                    return;
                }

                nameInput.value = value;
                slugInput.value = slugify(value);
                slugInput.dataset.edited = 'true';

                nameInput.focus();
            });
        });

        if (imageInput && imagePreview && imageEmptyState && imageFileName) {
            imageInput.addEventListener('change', function () {
                const file = this.files && this.files[0];

                if (!file) {
                    imagePreview.src = '';
                    imagePreview.classList.add('hidden');
                    imageEmptyState.classList.remove('hidden');
                    imageFileName.textContent = 'Formatos permitidos: JPG, PNG, WEBP. Máximo 4MB.';
                    return;
                }

                const allowedTypes = [
                    'image/jpeg',
                    'image/jpg',
                    'image/png',
                    'image/webp'
                ];

                if (!allowedTypes.includes(file.type)) {
                    alert('Formato no permitido. Usa JPG, PNG o WEBP.');
                    this.value = '';
                    imagePreview.src = '';
                    imagePreview.classList.add('hidden');
                    imageEmptyState.classList.remove('hidden');
                    imageFileName.textContent = 'Formatos permitidos: JPG, PNG, WEBP. Máximo 4MB.';
                    return;
                }

                const maxSize = 4 * 1024 * 1024;

                if (file.size > maxSize) {
                    alert('La imagen supera los 4MB permitidos.');
                    this.value = '';
                    imagePreview.src = '';
                    imagePreview.classList.add('hidden');
                    imageEmptyState.classList.remove('hidden');
                    imageFileName.textContent = 'Formatos permitidos: JPG, PNG, WEBP. Máximo 4MB.';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (event) {
                    imagePreview.src = event.target.result;
                    imagePreview.classList.remove('hidden');
                    imageEmptyState.classList.add('hidden');
                    imageFileName.textContent = file.name;
                };

                reader.readAsDataURL(file);
            });
        }

        if (form && submitButton) {
            form.addEventListener('submit', function () {
                submitButton.disabled = true;
                submitButton.classList.add('opacity-70', 'cursor-not-allowed');
                submitButton.innerText = 'Guardando categoría...';
            });
        }
    });
</script>

@endsection