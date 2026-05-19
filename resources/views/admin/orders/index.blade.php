@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-orange-50 via-red-50 to-yellow-50">

    <div class="p-8">

        {{-- HEADER --}}
        <div class="mb-8">

            <div class="flex items-center justify-between flex-wrap gap-4">

                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="text-5xl">
                            📋
                        </div>
                        <div>
                            <h1 class="text-5xl font-black bg-gradient-to-r from-red-600 to-orange-600 bg-clip-text text-transparent">
                               Historial de Pedidos
                            </h1>
                            <p class="text-gray-500 font-semibold mt-1">
                               
                            </p>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-700 mt-4">
                        
                    </h2>
                </div>

                {{-- BOTÓN VOLVER --}}
                <a href="/admin/dashboard" 
                   class="bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 transition-all duration-300 text-white px-6 py-3 rounded-xl font-bold shadow-lg transform hover:scale-105 flex items-center gap-2">
                    <span class="text-xl">⬅️</span> Volver al Panel
                </a>

            </div>

        </div>

        {{-- FILTROS Y SELECCIÓN DE CLIENTE --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 border-2 border-orange-200">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- SELECCIONAR CLIENTE --}}
                <div>
                    <label class="block text-red-600 font-black text-sm uppercase tracking-wider mb-2">
                        🧑‍🤝‍🧑 Selecciona el cliente
                    </label>
                    <select class="w-full px-4 py-3 rounded-xl border-2 border-orange-200 focus:border-red-500 focus:outline-none transition-all duration-300 bg-white font-semibold">
                        <option value="">Todos los clientes</option>
                        <option value="1">Perez Pepito - 122334455</option>
                        <option value="2">CLIENTE LTDA - 909222222</option>
                        <option value="3">Juan Pérez - 77777777</option>
                        <option value="4">María López - 71234567</option>
                    </select>
                </div>

                {{-- FECHA DESDE --}}
                <div>
                    <label class="block text-red-600 font-black text-sm uppercase tracking-wider mb-2">
                        📅 Fecha Desde
                    </label>
                    <input type="date" value="2024-06-01" 
                           class="w-full px-4 py-3 rounded-xl border-2 border-orange-200 focus:border-red-500 focus:outline-none transition-all duration-300">
                </div>

                {{-- FECHA HASTA --}}
                <div>
                    <label class="block text-red-600 font-black text-sm uppercase tracking-wider mb-2">
                        📅 Fecha Hasta
                    </label>
                    <input type="date" value="2024-07-02" 
                           class="w-full px-4 py-3 rounded-xl border-2 border-orange-200 focus:border-red-500 focus:outline-none transition-all duration-300">
                </div>

                {{-- BOTÓN FILTRAR --}}
                <div class="flex items-end">
                    <button class="w-full bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                        <span class="text-xl">🔍</span> Filtrar
                    </button>
                </div>

            </div>

        </div>

        {{-- TABLA DE PEDIDOS --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-orange-200">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gradient-to-r from-red-100 via-orange-100 to-yellow-100">

                        <tr>
                            <th class="px-6 py-4 text-left font-black text-red-800 text-sm uppercase tracking-wider">
                                # Documento
                            </th>
                            <th class="px-6 py-4 text-left font-black text-red-800 text-sm uppercase tracking-wider">
                                Fecha Generada
                            </th>
                            <th class="px-6 py-4 text-left font-black text-red-800 text-sm uppercase tracking-wider">
                                Cliente
                            </th>
                            <th class="px-6 py-4 text-left font-black text-red-800 text-sm uppercase tracking-wider">
                                Valor Total
                            </th>
                            <th class="px-6 py-4 text-left font-black text-red-800 text-sm uppercase tracking-wider">
                                Estado
                            </th>
                            <th class="px-6 py-4 text-left font-black text-red-800 text-sm uppercase tracking-wider">
                                Ver Detalle
                            </th>
                            <th class="px-6 py-4 text-left font-black text-red-800 text-sm uppercase tracking-wider">
                                Cancelar
                            </th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($orders as $order)

                            <tr class="border-t border-orange-100 hover:bg-orange-50 transition-all duration-200">

                                {{-- Documento --}}
                                <td class="px-6 py-5 font-black text-gray-800">
                                    {{ str_pad($order->id, 10, '0', STR_PAD_LEFT) }}
                                </td>

                                {{-- Fecha Generada --}}
                                <td class="px-6 py-5 text-gray-700 font-medium">
                                    {{ $order->created_at->format('d/m/Y') }}
                                </td>

                                {{-- Cliente --}}
                                <td class="px-6 py-5">
                                    <div>
                                        <div class="font-bold text-gray-800">
                                            {{ $order->customer_name }}
                                        </div>
                                        <div class="text-gray-500 text-sm">
                                            {{ $order->customer_phone }}
                                        </div>
                                    </div>
                                </td>

                                {{-- Valor Total en Bs --}}
                                <td class="px-6 py-5">
                                    <div class="font-black text-red-600 text-xl">
                                        Bs {{ number_format($order->total, 2, ',', '.') }}
                                    </div>
                                </td>

                                {{-- Estado --}}
                                <td class="px-6 py-5">
                                    @php
                                        $statusClass = '';
                                        $statusText = '';
                                        $statusIcon = '';
                                        
                                        if($order->status == 'pending') {
                                            $statusClass = 'bg-yellow-100 text-yellow-700';
                                            $statusText = 'Creado';
                                            $statusIcon = '📝';
                                        } elseif($order->status == 'completed') {
                                            $statusClass = 'bg-green-100 text-green-700';
                                            $statusText = 'Facturado';
                                            $statusIcon = '✅';
                                        } elseif($order->status == 'cancelled') {
                                            $statusClass = 'bg-red-100 text-red-700';
                                            $statusText = 'Cancelado';
                                            $statusIcon = '❌';
                                        } elseif($order->status == 'shipped') {
                                            $statusClass = 'bg-blue-100 text-blue-700';
                                            $statusText = 'Remisionado';
                                            $statusIcon = '🚚';
                                        } else {
                                            $statusClass = 'bg-gray-100 text-gray-700';
                                            $statusText = ucfirst($order->status);
                                            $statusIcon = '📦';
                                        }
                                    @endphp
                                    <span class="{{ $statusClass }} px-4 py-2 rounded-xl text-sm font-black flex items-center gap-1 w-fit">
                                        {{ $statusIcon }} {{ $statusText }}
                                    </span>
                                </td>

                                {{-- Ver Detalle --}}
                                <td class="px-6 py-5">
                                    <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 flex items-center gap-1">
                                        <span class="text-lg">👁️</span> Ver
                                    </button>
                                </td>

                                {{-- Cancelar --}}
                                <td class="px-6 py-5">
                                    @if($order->status != 'cancelled' && $order->status != 'completed')
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 flex items-center gap-1">
                                        <span class="text-lg">🗑️</span> Cancelar
                                    </button>
                                    @else
                                    <button class="bg-gray-300 text-gray-500 px-4 py-2 rounded-xl font-bold cursor-not-allowed flex items-center gap-1" disabled>
                                        <span class="text-lg">🔒</span> No aplica
                                    </button>
                                    @endif
                                </td>

                            </tr>

                        @empty

                            {{-- DATOS DE EJEMPLO --}}
                            <tr class="border-t border-orange-100 hover:bg-orange-50 transition-all duration-200">
                                <td class="px-6 py-5 font-black text-gray-800">0000000131</td>
                                <td class="px-6 py-5">19/06/2024</td>
                                <td class="px-6 py-5">
                                    <div>
                                        <div class="font-bold text-gray-800">Perez Pepito</div>
                                        <div class="text-gray-500 text-sm">122334455</div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-black text-red-600 text-xl">Bs 511.700,00</td>
                                <td class="px-6 py-5"><span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-xl text-sm font-black">📝 Creado</span></td>
                                <td class="px-6 py-5"><button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl font-bold">👁️ Ver</button></td>
                                <td class="px-6 py-5"><button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl font-bold">🗑️ Cancelar</button></td>
                            </tr>
                            <tr class="border-t border-orange-100 hover:bg-orange-50 transition-all duration-200">
                                <td class="px-6 py-5 font-black text-gray-800">0000000130</td>
                                <td class="px-6 py-5">19/06/2024</td>
                                <td class="px-6 py-5">
                                    <div>
                                        <div class="font-bold text-gray-800">CLIENTE LTDA</div>
                                        <div class="text-gray-500 text-sm">909222222</div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-black text-red-600 text-xl">Bs 2.563.000,00</td>
                                <td class="px-6 py-5"><span class="bg-green-100 text-green-700 px-4 py-2 rounded-xl text-sm font-black">✅ Facturado</span></td>
                                <td class="px-6 py-5"><button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl font-bold">👁️ Ver</button></td>
                                <td class="px-6 py-5"><button class="bg-gray-300 text-gray-500 px-4 py-2 rounded-xl font-bold cursor-not-allowed" disabled>🔒 No aplica</button></td>
                            </tr>
                            <tr class="border-t border-orange-100 hover:bg-orange-50 transition-all duration-200">
                                <td class="px-6 py-5 font-black text-gray-800">0000000129</td>
                                <td class="px-6 py-5">19/06/2024</td>
                                <td class="px-6 py-5">
                                    <div>
                                        <div class="font-bold text-gray-800">Perez Pepito</div>
                                        <div class="text-gray-500 text-sm">122334455</div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-black text-red-600 text-xl">Bs 214.200,00</td>
                                <td class="px-6 py-5"><span class="bg-red-100 text-red-700 px-4 py-2 rounded-xl text-sm font-black">❌ Cancelado</span></td>
                                <td class="px-6 py-5"><button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl font-bold">👁️ Ver</button></td>
                                <td class="px-6 py-5"><button class="bg-gray-300 text-gray-500 px-4 py-2 rounded-xl font-bold cursor-not-allowed" disabled>🔒 No aplica</button></td>
                            </tr>
                            <tr class="border-t border-orange-100 hover:bg-orange-50 transition-all duration-200">
                                <td class="px-6 py-5 font-black text-gray-800">0000000128</td>
                                <td class="px-6 py-5">19/06/2024</td>
                                <td class="px-6 py-5">
                                    <div>
                                        <div class="font-bold text-gray-800">Perez Pepito</div>
                                        <div class="text-gray-500 text-sm">122334455</div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-black text-red-600 text-xl">Bs 233.000,00</td>
                                <td class="px-6 py-5"><span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-xl text-sm font-black">📝 Creado</span></td>
                                <td class="px-6 py-5"><button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl font-bold">👁️ Ver</button></td>
                                <td class="px-6 py-5"><button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl font-bold">🗑️ Cancelar</button></td>
                            </tr>
                            <tr class="border-t border-orange-100 hover:bg-orange-50 transition-all duration-200">
                                <td class="px-6 py-5 font-black text-gray-800">0000000127</td>
                                <td class="px-6 py-5">19/06/2024</td>
                                <td class="px-6 py-5">
                                    <div>
                                        <div class="font-bold text-gray-800">CLIENTE LTDA</div>
                                        <div class="text-gray-500 text-sm">909222222</div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-black text-red-600 text-xl">Bs 2.330.000,00</td>
                                <td class="px-6 py-5"><span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-xl text-sm font-black">📝 Creado</span></td>
                                <td class="px-6 py-5"><button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl font-bold">👁️ Ver</button></td>
                                <td class="px-6 py-5"><button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl font-bold">🗑️ Cancelar</button></td>
                            </tr>
                            <tr class="border-t border-orange-100 hover:bg-orange-50 transition-all duration-200">
                                <td class="px-6 py-5 font-black text-gray-800">0000000126</td>
                                <td class="px-6 py-5">19/06/2024</td>
                                <td class="px-6 py-5">
                                    <div>
                                        <div class="font-bold text-gray-800">Perez Pepito</div>
                                        <div class="text-gray-500 text-sm">122334455</div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-black text-red-600 text-xl">Bs 297.500,00</td>
                                <td class="px-6 py-5"><span class="bg-green-100 text-green-700 px-4 py-2 rounded-xl text-sm font-black">✅ Facturado</span></td>
                                <td class="px-6 py-5"><button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl font-bold">👁️ Ver</button></td>
                                <td class="px-6 py-5"><button class="bg-gray-300 text-gray-500 px-4 py-2 rounded-xl font-bold cursor-not-allowed" disabled>🔒 No aplica</button></td>
                            </tr>
                            <tr class="border-t border-orange-100 hover:bg-orange-50 transition-all duration-200">
                                <td class="px-6 py-5 font-black text-gray-800">0000000125</td>
                                <td class="px-6 py-5">19/06/2024</td>
                                <td class="px-6 py-5">
                                    <div>
                                        <div class="font-bold text-gray-800">Perez Pepito</div>
                                        <div class="text-gray-500 text-sm">122334455</div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-black text-red-600 text-xl">Bs 447.200,00</td>
                                <td class="px-6 py-5"><span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-xl text-sm font-black">🚚 Remisionado</span></td>
                                <td class="px-6 py-5"><button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl font-bold">👁️ Ver</button></td>
                                <td class="px-6 py-5"><button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl font-bold">🗑️ Cancelar</button></td>
                            </tr>
                            <tr class="border-t border-orange-100 hover:bg-orange-50 transition-all duration-200">
                                <td class="px-6 py-5 font-black text-gray-800">0000000124</td>
                                <td class="px-6 py-5">19/06/2024</td>
                                <td class="px-6 py-5">
                                    <div>
                                        <div class="font-bold text-gray-800">Perez Pepito</div>
                                        <div class="text-gray-500 text-sm">122334455</div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-black text-red-600 text-xl">Bs 297.500,00</td>
                                <td class="px-6 py-5"><span class="bg-red-100 text-red-700 px-4 py-2 rounded-xl text-sm font-black">❌ Cancelado</span></td>
                                <td class="px-6 py-5"><button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl font-bold">👁️ Ver</button></td>
                                <td class="px-6 py-5"><button class="bg-gray-300 text-gray-500 px-4 py-2 rounded-xl font-bold cursor-not-allowed" disabled>🔒 No aplica</button></td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINACIÓN --}}
            <div class="bg-gradient-to-r from-red-50 via-orange-50 to-yellow-50 px-6 py-4 border-t-2 border-orange-200">

                <div class="flex justify-between items-center flex-wrap gap-4">

                    <div class="text-gray-600 font-semibold">
                        📊 Mostrando {{ $orders->count() }} pedidos
                    </div>

                    <div class="flex gap-2">
                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-xl font-bold transition-all duration-300">
                            ◀ Anterior
                        </button>
                        <button class="bg-gradient-to-r from-red-600 to-orange-600 text-white px-4 py-2 rounded-xl font-bold">
                            1
                        </button>
                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-xl font-bold transition-all duration-300">
                            2
                        </button>
                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-xl font-bold transition-all duration-300">
                            3
                        </button>
                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-xl font-bold transition-all duration-300">
                            Siguiente ▶
                        </button>
                    </div>

                </div>

            </div>

        </div>

        {{-- RESÚMENES --}}
        <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl p-6 shadow-xl border-l-8 border-red-500">
                <div class="text-4xl mb-2">💰</div>
                <div class="text-2xl font-black text-gray-800">Bs 6.724.300,00</div>
                <div class="text-gray-500 font-semibold">Total Ventas</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xl border-l-8 border-orange-500">
                <div class="text-4xl mb-2">📝</div>
                <div class="text-2xl font-black text-gray-800">{{ $orders->where('status', 'pending')->count() + 3 }}</div>
                <div class="text-gray-500 font-semibold">Pedidos Creados</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xl border-l-8 border-green-500">
                <div class="text-4xl mb-2">✅</div>
                <div class="text-2xl font-black text-gray-800">{{ $orders->where('status', 'completed')->count() + 2 }}</div>
                <div class="text-gray-500 font-semibold">Pedidos Facturados</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xl border-l-8 border-red-500">
                <div class="text-4xl mb-2">❌</div>
                <div class="text-2xl font-black text-gray-800">{{ $orders->where('status', 'cancelled')->count() + 2 }}</div>
                <div class="text-gray-500 font-semibold">Pedidos Cancelados</div>
            </div>

        </div>

    </div>

</div>

@endsection