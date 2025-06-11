@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Detalles del Pedido #{{ $order->id }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <p class="text-gray-500 text-sm">Fecha del pedido</p>
                <p class="text-lg font-semibold">{{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Estado del pedido</p>
                <p class="text-lg font-semibold capitalize">{{ $order->status }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Método de envío</p>
                <p class="text-lg font-semibold">{{ $order->shippingMethod->name ?? 'No definido' }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total</p>
                <p class="text-lg font-semibold">${{ number_format($order->total_amount, 2) }}</p>
            </div>
        </div>

        <hr class="my-4">

        <h2 class="text-xl font-bold mb-2">Productos</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Producto</th>
                        <th class="px-4 py-2 text-left">Cantidad</th>
                        <th class="px-4 py-2 text-left">Precio</th>
                        <th class="px-4 py-2 text-left">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->product_name }}</td>
                            <td class="px-4 py-2">{{ $item->quantity }}</td>
                            <td class="px-4 py-2">${{ number_format($item->price, 2) }}</td>
                            <td class="px-4 py-2">${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection