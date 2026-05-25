@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-950 text-white overflow-x-hidden">

    {{-- BACKGROUND --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden">

        <div class="absolute -top-40 -left-40 w-[520px] h-[520px] bg-orange-500/20 rounded-full blur-3xl"></div>

        <div class="absolute top-40 -right-40 w-[520px] h-[520px] bg-pink-500/20 rounded-full blur-3xl"></div>

        <div class="absolute bottom-0 left-1/3 w-[520px] h-[520px] bg-purple-500/10 rounded-full blur-3xl"></div>

    </div>

    <main class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER --}}
        <section class="mb-8 rounded-[2rem] border border-white/10 bg-white/5 backdrop-blur-2xl p-6 shadow-2xl">

            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-center gap-4">

                    <div class="relative shrink-0">

                        <div class="absolute inset-0 bg-blue-500 rounded-3xl blur-xl opacity-40"></div>

                        <div class="relative w-16 h-16 rounded-3xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-4xl shadow-2xl">
                            ✏️
                        </div>

                    </div>

                    <div>

                        <h1 class="text-3xl md:text-4xl font-black">
                            Editar categoría
                        </h1>

                        <p class="text-slate-400 text-sm mt-1">
                            Actualiza la categoría: 
                            <span class="text-white font-bold">
                                {{ $category->name }}
                            </span>
                        </p>

                    </div>

                </div>

                <div class="flex flex-wrap items-center gap-3">

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-slate-200 hover:bg-white/10 transition">

                        <span>⬅️</span>
                        Volver

                    </a>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl border border-cyan-400/20 bg-cyan-500/10 px-5 py-3 text-sm font-bold text-cyan-200 hover:bg-cyan-500/20 transition">

                        <span>📦</span>
                        Productos

                    </a>

                </div>

            </div>

        </section>

        {{-- ERRORES --}}
        @if($errors->any())

            <section class="mb-8 rounded-[2rem] border border-red-400/20 bg-red-500/10 p-6 text-red-200">

                <h3 class="font-black text-lg mb-3">
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

        {{-- FORMULARIO --}}
        <form
            action="{{ route('admin.categories.update', $category) }}"
            method="POST"
            enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            @csrf
            @method('PUT')

            {{-- FORM PRINCIPAL --}}
            <section class="lg:col-span-2 rounded-[2rem] border border-white/10 bg-white/5 backdrop-blur-2xl p-6 md:p-8 shadow-2xl">

                <div class="mb-8">

                    <h2 class="text-2xl font-black">
                        Información de la categoría
                    </h2>

                    <p class="text-slate-400 text-sm mt-2">
                        Estos datos ayudan a ordenar el catálogo público del negocio.
                    </p>

                </div>

                <div class="space-y-7">

                    {{-- NAME --}}
                    <div>

                        <label for="name" class="block text-sm font-black text-slate-200 mb-3">
                            Nombre de la categoría <span class="text-orange-400">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $category->name) }}"
                            required
                            placeholder="Ej: Promociones, Tecnología, Belleza"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/80 px-5 py-4 text-white placeholder:text-slate-500 focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/20 transition">

                        @error('name')

                            <p class="mt-2 text-sm text-red-300">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                    {{-- SLUG --}}
                    <div>

                        <label for="slug" class="block text-sm font-black text-slate-200 mb-3">
                            Slug / URL interna
                        </label>

                        <div class="flex items-center rounded-2xl border border-white/10 bg-slate-900/80 overflow-hidden focus-within:border-orange-400 focus-within:ring-4 focus-within:ring-orange-500/20 transition">

                            <span class="hidden sm:inline-flex px-5 text-sm text-slate-500 border-r border-white/10">
                                categoria/
                            </span>

                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                value="{{ old('slug', $category->slug) }}"
                                placeholder="promociones"
                                class="w-full bg-transparent px-5 py-4 text-white placeholder:text-slate-500 focus:outline-none">

                        </div>

                        <p class="mt-2 text-xs text-slate-500">
                            Si lo modificas, usa solo letras, números y guiones.
                        </p>

                        @error('slug')

                            <p class="mt-2 text-sm text-red-300">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                    {{-- STATUS --}}
                    <div class="rounded-3xl border border-white/10 bg-slate-900/60 p-5">

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                            <div>

                                <h3 class="font-black text-slate-100">
                                    Estado de la categoría
                                </h3>

                                <p class="text-sm text-slate-400 mt-1">
                                    Si está activa, podrá mostrarse en la tienda pública.
                                </p>

                            </div>

                            <label class="inline-flex items-center cursor-pointer">

                                <input
                                    type="hidden"
                                    name="is_active"
                                    value="0">

                                <input
                                    type="checkbox"
                                    id="is_active"
                                    name="is_active"
                                    value="1"
                                    class="sr-only peer"
                                    {{ old('is_active', $category->is_active) ? 'checked' : '' }}>

                                <div class="relative w-16 h-9 bg-slate-700 rounded-full peer-checked:bg-emerald-500 transition">

                                    <div class="absolute top-1 left-1 w-7 h-7 bg-white rounded-full transition peer-checked:translate-x-7"></div>

                                </div>

                                <span class="ml-3 text-sm font-bold text-slate-200">
                                    Activa
                                </span>

                            </label>

                        </div>

                    </div>

                    {{-- INFO --}}
                    <div class="rounded-3xl border border-blue-400/20 bg-blue-500/10 p-5">

                        <h3 class="font-black text-blue-200 mb-2">
                            Información técnica
                        </h3>

                        <div class="grid sm:grid-cols-2 gap-4 text-sm text-slate-300">

                            <div>
                                <span class="text-slate-500">
                                    ID categoría:
                                </span>

                                <span class="font-bold text-white">
                                    {{ $category->id }}
                                </span>
                            </div>

                            <div>
                                <span class="text-slate-500">
                                    Tenant ID:
                                </span>

                                <span class="font-bold text-white">
                                    {{ $category->tenant_id }}
                                </span>
                            </div>

                            <div>
                                <span class="text-slate-500">
                                    Creado:
                                </span>

                                <span class="font-bold text-white">
                                    {{ optional($category->created_at)->format('d/m/Y H:i') }}
                                </span>
                            </div>

                            <div>
                                <span class="text-slate-500">
                                    Actualizado:
                                </span>

                                <span class="font-bold text-white">
                                    {{ optional($category->updated_at)->format('d/m/Y H:i') }}
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </section>

            {{-- LATERAL --}}
            <aside class="space-y-8">

                {{-- IMAGE --}}
                <section class="rounded-[2rem] border border-white/10 bg-white/5 backdrop-blur-2xl p-6 shadow-2xl">

                    <h2 class="text-2xl font-black mb-2">
                        Imagen
                    </h2>

                    <p class="text-slate-400 text-sm mb-6">
                        Puedes conservar la imagen actual o subir una nueva.
                    </p>

                    <div class="rounded-3xl border border-dashed border-white/20 bg-slate-900/60 p-5 text-center">

                        <div
                            id="imagePreviewBox"
                            class="mb-5 w-full aspect-video rounded-2xl bg-slate-950 border border-white/10 flex items-center justify-center overflow-hidden">

                            @if($category->image)

                                <img
                                    id="imagePreview"
                                    src="{{ asset('storage/' . $category->image) }}"
                                    alt="{{ $category->name }}"
                                    class="w-full h-full object-cover">

                                <div id="imageEmptyState" class="hidden text-center px-4">

                                    <div class="text-5xl mb-3">
                                        🖼️
                                    </div>

                                    <p class="text-sm text-slate-400">
                                        Vista previa de la imagen
                                    </p>

                                </div>

                            @else

                                <img
                                    id="imagePreview"
                                    src=""
                                    alt="Vista previa"
                                    class="hidden w-full h-full object-cover">

                                <div id="imageEmptyState" class="text-center px-4">

                                    <div class="text-5xl mb-3">
                                        🖼️
                                    </div>

                                    <p class="text-sm text-slate-400">
                                        Sin imagen registrada
                                    </p>

                                </div>

                            @endif

                        </div>

                        <label
                            for="image"
                            class="inline-flex items-center justify-center gap-2 w-full rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 px-5 py-4 text-sm font-black text-white shadow-[0_15px_40px_rgba(59,130,246,0.30)] hover:scale-[1.02] transition cursor-pointer">

                            <span>📸</span>
                            Cambiar imagen

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
                <section class="rounded-[2rem] border border-white/10 bg-white/5 backdrop-blur-2xl p-6 shadow-2xl">

                    <h2 class="text-xl font-black mb-4">
                        Recomendación
                    </h2>

                    <div class="space-y-3 text-sm text-slate-300">

                        <div class="flex items-center gap-3 rounded-2xl bg-slate-900/60 border border-white/10 p-4">

                            <span class="text-2xl">✅</span>

                            <span>
                                Usa nombres cortos y fáciles de entender.
                            </span>

                        </div>

                        <div class="flex items-center gap-3 rounded-2xl bg-slate-900/60 border border-white/10 p-4">

                            <span class="text-2xl">📱</span>

                            <span>
                                Piensa en cómo verá el cliente desde celular.
                            </span>

                        </div>

                        <div class="flex items-center gap-3 rounded-2xl bg-slate-900/60 border border-white/10 p-4">

                            <span class="text-2xl">🛒</span>

                            <span>
                                Las categorías claras ayudan a vender más rápido.
                            </span>

                        </div>

                    </div>

                </section>

                {{-- ACTIONS --}}
                <section class="rounded-[2rem] border border-white/10 bg-white/5 backdrop-blur-2xl p-6 shadow-2xl">

                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-gradient-to-r from-orange-500 via-pink-500 to-rose-500 px-6 py-5 text-lg font-black text-white shadow-[0_15px_50px_rgba(249,115,22,0.35)] hover:scale-[1.02] transition">

                        Guardar cambios

                    </button>

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="mt-4 inline-flex w-full items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-6 py-4 text-sm font-bold text-slate-200 hover:bg-white/10 transition">

                        Cancelar

                    </a>

                </section>

            </aside>

        </form>

    </main>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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

        if (slugInput) {
            slugInput.addEventListener('input', function () {
                this.value = slugify(this.value);
            });
        }

        if (nameInput && slugInput) {
            nameInput.addEventListener('input', function () {
                if (!slugInput.value.trim()) {
                    slugInput.value = slugify(this.value);
                }
            });
        }

        if (imageInput && imagePreview && imageEmptyState && imageFileName) {
            imageInput.addEventListener('change', function () {
                const file = this.files[0];

                if (!file) {
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
                    return;
                }

                const maxSize = 4 * 1024 * 1024;

                if (file.size > maxSize) {
                    alert('La imagen supera los 4MB permitidos.');
                    this.value = '';
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
    });
</script>

@endsection