@extends('layouts.app')

@section('content')

<section class="min-h-screen bg-slate-950 text-white px-6 py-10">

    <div class="max-w-7xl mx-auto">

        <a href="{{ route('super.admin.dashboard') }}"
           class="inline-flex items-center gap-2 text-orange-400 font-bold hover:text-orange-300 transition">
            ← Volver al dashboard
        </a>

        <div class="mt-8 rounded-[32px] border border-white/10 bg-white/10 p-8">

            <h1 class="text-4xl font-black">
                Reportes
            </h1>

            <p class="text-slate-400 mt-3">
                Módulo básico de reportes. Más adelante aquí estarán las métricas globales del sistema.
            </p>

        </div>

    </div>

</section>

@endsection