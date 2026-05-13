@extends('layouts.tenant')

@section('content')

<section class="min-h-screen bg-slate-100 py-20">

    <div class="max-w-3xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="mb-10 text-center">

            <span class="bg-orange-100 text-orange-600 px-5 py-2 rounded-full text-sm font-bold">
                Finalizar Pedido
            </span>

            <h1 class="text-5xl font-extrabold text-slate-900 mt-6">
                Checkout
            </h1>

            <p class="text-slate-500 mt-4 text-lg">
                Completa tus datos para enviar tu pedido al negocio.
            </p>

        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-3xl shadow-2xl p-10 border border-slate-200">

            {{-- ALERT SUCCESS --}}
            @if(session('success'))

                <div class="bg-green-100 border border-green-200 text-green-700 px-5 py-4 rounded-2xl mb-8">

                    {{ session('success') }}

                </div>

            @endif

            {{-- FORM --}}
            <form action="{{ route('checkout') }}" method="POST" class="space-y-6">

                @csrf

                {{-- NAME --}}
                <div>

                    <label class="block mb-2 font-semibold text-slate-700">
                        Nombre Completo
                    </label>

                    <input
                        type="text"
                        name="customer_name"
                        required
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200"
                        placeholder="Ej: Juan Pérez"
                    >

                </div>

                {{-- PHONE --}}
                <div>

                    <label class="block mb-2 font-semibold text-slate-700">
                        WhatsApp
                    </label>

                    <input
                        type="text"
                        name="customer_phone"
                        required
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200"
                        placeholder="77777777"
                    >

                </div>

                {{-- ADDRESS --}}
                <div>

                    <label class="block mb-2 font-semibold text-slate-700">
                        Dirección exacta
                    </label>

                    <textarea
                        name="address"
                        rows="4"
                        required
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200"
                        placeholder="Ej: Av. Principal #123"
                    ></textarea>

                </div>

                {{-- GOOGLE MAPS --}}
                <div>

                    <label class="block mb-2 font-semibold text-slate-700">
                        Link Google Maps
                    </label>

                    <input
                        type="text"
                        name="google_maps"
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200"
                        placeholder="https://maps.google.com/..."
                    >

                </div>

                {{-- PAYMENT --}}
                <div>

                    <label class="block mb-2 font-semibold text-slate-700">
                        Método de Pago
                    </label>

                    <select
                        name="payment_method"
                        class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200">

                        <option value="Efectivo">
                            Efectivo
                        </option>

                        <option value="QR">
                            QR
                        </option>

                        <option value="Transferencia">
                            Transferencia
                        </option>

                    </select>

                </div>

                {{-- BUTTON --}}
                <button
                    type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 transition text-white py-5 rounded-2xl text-lg font-bold shadow-lg">

                    Enviar Pedido

                </button>

            </form>

        </div>

    </div>

</section>

@endsection