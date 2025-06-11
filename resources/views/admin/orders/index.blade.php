@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Pedidos Recientes</h1>
<table class="w-full table-auto border-collapse">
    <thead>
        <tr class="bg-gray-100">
            <th class="p-2 border">ID</th>
            <th class="p-2 border">Cliente</th>
            <th class="p-2 border">Total</th>
            <th class="p-2 border">Estado</th>
            <th class="p-2 border">Fecha</th>
            <th class="p-2 border">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td class="p-2 border">{{ $order->id }}</td>
            <td class="p-2 border">{{ $order->user->name ?? 'Invitado' }}</td>
            <td class="p-2 border">${{ number_format($order->total, 2) }}</td>
            <td class="p-2 border">{{ ucfirst($order->status) }}</td>
            <td class="p-2 border">{{ $order->created_at->format('d/m/Y') }}</td>
            <td class="p-2 border">
                <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-500 underline">Ver</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $orders->links() }}
@endsection