@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Detalles del Pedido #{{ $order->id }}</h1>

<p><strong>Cliente:</strong> {{ $order->user->name ?? 'Invitado' }}</p>
<p><strong>Email:</strong> {{ $order->user->email ?? $order->email }}</p>
<p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
<p><strong>Estado:</strong> {{ ucfirst($order->status) }}</p>

<form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="mt-4">
    @csrf
    @method('PATCH')
    <label for="status">Cambiar estado:</label>
    <select name="status" id="status" class="border p-1">
        <option value="pendiente" @selected($order->status == 'pendiente')>Pendiente</option>
        <option value="procesando" @selected($order->status == 'procesando')>Procesando</option>
        <option value="completado" @selected($order->status == 'completado')>Completado</option>
        <option value="enviado" @selected($order->status == 'enviado')>Enviado</option>
        <option value="cancelado" @selected($order->status == 'cancelado')>Cancelado</option>
    </select>
    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded ml-2">Actualizar</button>
</form>

<h2 class="text-lg font-semibold mt-6">Productos</h2>
<ul class="mt-2">
    @foreach($order->orderItems as $item)
        <li class="border-b py-2">
            {{ $item->product->name }} - Cantidad: {{ $item->quantity }} - ${{ number_format($item->price, 2) }}
        </li>
    @endforeach
</ul>
@endsection