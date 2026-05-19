@extends('layouts.tenant')

@section('content')

<section class="min-h-screen bg-gradient-to-br from-orange-50 via-red-50 to-yellow-50 py-20">

    <div class="max-w-3xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="mb-10 text-center">

            <h1 class="text-5xl font-black bg-gradient-to-r from-red-600 to-orange-600 bg-clip-text text-transparent">
                Finalizar Pedido
            </h1>

            <p class="text-gray-600 mt-4 text-lg">
                Completa tus datos para enviar tu pedido al negocio.
            </p>

        </div>

        {{-- PASOS --}}
        <div class="flex items-center justify-center gap-2 mb-10">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold text-sm">1</div>
                <span class="font-semibold text-gray-700">Datos de Envío</span>
            </div>
            <span class="text-gray-400 text-xl">→</span>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-gray-300 text-gray-500 rounded-full flex items-center justify-center font-bold text-sm">2</div>
                <span class="font-medium text-gray-500">Pago</span>
            </div>
            <span class="text-gray-400 text-xl">→</span>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-gray-300 text-gray-500 rounded-full flex items-center justify-center font-bold text-sm">3</div>
                <span class="font-medium text-gray-500">Confirmación</span>
            </div>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-3xl shadow-2xl p-10 border border-orange-100">

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
                    <label class="block mb-2 font-semibold text-gray-700">
                        Nombre Completo
                    </label>
                    <input
                        type="text"
                        name="customer_name"
                        required
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200 focus:border-orange-400 transition"
                        placeholder="Ej: Juan Pérez"
                    >
                </div>

                {{-- PHONE --}}
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        WhatsApp
                    </label>
                    <input
                        type="text"
                        name="customer_phone"
                        required
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200 focus:border-orange-400 transition"
                        placeholder="+52 55 1234 5678"
                    >
                </div>

                {{-- ADDRESS --}}
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Dirección exacta
                    </label>
                    <textarea
                        name="address"
                        rows="4"
                        required
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200 focus:border-orange-400 transition"
                        placeholder="Ej: Av. Principal #123"
                    ></textarea>
                </div>

                {{-- GOOGLE MAPS --}}
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Link Google Maps
                    </label>
                    <input
                        type="text"
                        name="google_maps"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200 focus:border-orange-400 transition"
                        placeholder="https://maps.google.com/..."
                    >
                </div>

                {{-- PAYMENT --}}
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Método de Pago
                    </label>
                    <select
                        name="payment_method"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-orange-200 focus:border-orange-400 transition bg-white">
                        <option value="Efectivo">💵 Efectivo</option>
                        <option value="QR">📱 QR</option>
                        <option value="Transferencia">🏦 Transferencia</option>
                    </select>
                </div>

                {{-- BUTTON --}}
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 transition text-white py-5 rounded-2xl text-lg font-bold shadow-lg mt-4">
                    Finalizar Pedido y Pagar
                </button>

            </form>

        </div>

        {{-- INFO ADICIONAL --}}
        <div class="mt-6 text-center">
            <p class="text-gray-400 text-sm">
                🕒 Tiempo estimado de entrega: 30-45 minutos
            </p>
        </div>

    </div>

</section>

@endsection