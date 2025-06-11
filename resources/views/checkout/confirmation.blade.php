@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-md">
    <h1 class="text-3xl font-bold text-green-600 mb-6">¡Gracias por tu pedido! 🎉</h1>

    <div class="mb-6">
        <p class="text-lg">Número de pedido: <span class="font-semibold">#{{ $order->id }}</span></p>
        @if ($order->delivery_code)
            <p class="text-lg">Código de entrega: 
                <span class="font-mono text-blue-600 bg-blue-100 px-2 py-1 rounded">{{ $order->delivery_code }}</span>
            </p>
            <p class="text-sm text-gray-500 mt-1">Guarda este código, será requerido para recibir tu producto.</p>
        @endif
        <p class="text-lg">Fecha: <span class="text-gray-700">{{ $order->order_date->format('d/m/Y H:i') }}</span></p>
        <p class="text-lg">Método de pago: <span class="capitalize">{{ $order->payment_method }}</span></p>
        <p class="text-lg">Estado del pago: <span class="capitalize">{{ $order->payment_status }}</span></p>
        <p class="text-lg">Total: <span class="font-bold text-gray-800">${{ number_format($order->total_amount, 2) }}</span></p>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-3">Productos adquiridos</h2>
        <ul class="divide-y divide-gray-200">
            @foreach ($order->items ?? [] as $item)
                <li class="py-2 flex justify-between items-center">
                    <div>
                        <p class="font-medium">{{ $item->product->name }}</p>
                        <p class="text-sm text-gray-500">Cantidad: {{ $item->quantity }}</p>
                    </div>
                    <p class="text-right font-semibold">${{ number_format($item->price * $item->quantity, 2) }}</p>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-3">Datos del cliente</h2>
        <p><strong>Email:</strong> {{ $order->customer_email }}</p>
        @if ($order->shipping_address)
            <p><strong>Dirección de envío:</strong> {{ $order->shipping_address }}</p>
        @endif
        @if ($order->is_dropshipping)
            <p><strong>Destinatario:</strong> {{ $order->recipient_name }} ({{ $order->recipient_email }})</p>
        @endif
    </div>

    <div class="text-center">
        <a href="{{ route('products.index') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
            Seguir comprando
        </a>
    </div>
</div>
@endsection