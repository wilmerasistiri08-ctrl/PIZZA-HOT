@extends('layouts.admin')

@section('content')

<div class="p-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-4xl font-bold text-slate-800">
                Pedidos
            </h1>

            <p class="text-slate-500 mt-2">
                Gestión completa de pedidos realizados
            </p>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-slate-200">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-6 py-4 text-left font-bold text-slate-700">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left font-bold text-slate-700">
                            Cliente
                        </th>

                        <th class="px-6 py-4 text-left font-bold text-slate-700">
                            Teléfono
                        </th>

                        <th class="px-6 py-4 text-left font-bold text-slate-700">
                            Dirección
                        </th>

                        <th class="px-6 py-4 text-left font-bold text-slate-700">
                            Total
                        </th>

                        <th class="px-6 py-4 text-left font-bold text-slate-700">
                            Estado
                        </th>

                        <th class="px-6 py-4 text-left font-bold text-slate-700">
                            Fecha
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($orders as $order)

                        <tr class="border-b hover:bg-slate-50 transition">

                            <td class="px-6 py-4">
                                #{{ $order->id }}
                            </td>

                            <td class="px-6 py-4 font-semibold">
                                {{ $order->customer_name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $order->customer_phone }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $order->address }}
                            </td>

                            <td class="px-6 py-4 font-bold text-orange-500">
                                Bs {{ $order->total }}
                            </td>

                            <td class="px-6 py-4">

                                @if($order->status == 'pending')

                                    <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-bold">
                                        Pendiente
                                    </span>

                                @elseif($order->status == 'completed')

                                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">
                                        Completado
                                    </span>

                                @else

                                    <span class="bg-slate-100 text-slate-700 px-4 py-2 rounded-full text-sm font-bold">
                                        {{ $order->status }}
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-slate-500">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="px-6 py-10 text-center text-slate-500">

                                No existen pedidos todavía.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection