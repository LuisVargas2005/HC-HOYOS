@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Historial de Pedidos</h1>

    @if($orders->isEmpty())
        <div class="text-center text-gray-500">
            <p>No has realizado ningún pedido aún.</p>
        </div>
    @else
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Fecha</th>
                        <th class="px-6 py-3 text-left">Total</th>
                        <th class="px-6 py-3 text-left">Estado</th>
                        <th class="px-6 py-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4">{{ $order->id }}</td>
                            <td class="px-6 py-4">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">${{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-6 py-4 capitalize">
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                                    @if($order->status === 'paid') bg-green-100 text-green-800 
                                    @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800 
                                    @elseif($order->status === 'failed') bg-red-100 text-red-800 
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('orders.show', $order->id) }}"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded transition">
                                    Ver detalles
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $orders->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection