@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Proceso de Pago</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-6">
            <h2 class="font-bold mb-2">Errores:</h2>
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Formulario de Pago -->
        <div class="md:col-span-2">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Detalles del Pedido</h2>

                <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block font-medium mb-1">Correo Electrónico *</label>
                        <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:outline-none" required>
                        <input type="hidden" name="stripeToken" id="stripeToken">
                    </div>

                    <!-- Selección de método de entrega -->
                    <div class="mb-6">
                        <h3 class="font-medium mb-3">Método de Entrega *</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input type="radio" id="pickup-store" name="delivery_method" value="pickup" checked class="mr-2">
                                <label for="pickup-store" class="flex items-center">
                                    <span>Recoger en tienda</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="delivery-home" name="delivery_method" value="delivery" disabled class="mr-2">
                                <label for="delivery-home" class="flex items-center text-gray-400">
                                    <span>Envío a domicilio</span>
                                    <span class="ml-2 bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">Próximamente</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Información de recogida en tienda -->
                    <div id="pickup-info" class="mb-6 bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <h3 class="font-semibold text-blue-800 mb-2">Información para Recoger en Tienda</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-medium">Dirección de la Tienda:</h4>
                                <p class="text-gray-700">Cra 4 # 5-62, El Agrado, Huila</p>
                            </div>
                            <div>
                                <h4 class="font-medium">Horario de Atención:</h4>
                                <p class="text-gray-700">Lunes a Viernes: 9:00 AM - 7:00 PM<br>
                                Sábados: 10:00 AM - 5:00 PM</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-600">* Presenta tu número de orden y documento de identidad al reclamar tu pedido.</p>
                        </div>
                    </div>

                    <!-- Sección oculta para envíos (para implementación futura) -->
                    <div id="delivery-info" class="hidden mb-6">
                        <div class="mb-4">
                            <label for="shipping_address" class="block font-medium mb-1">Dirección de Envío *</label>
                            <textarea id="shipping_address" name="shipping_address" rows="3" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:outline-none" disabled></textarea>
                        </div>
                    </div>

                    @if($total > 0)
                        <div class="mb-4">
                            <label for="payment_method" class="block font-medium mb-1">Método de Pago *</label>
                            <select id="payment_method" name="payment_method" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:outline-none">
                                <option value="stripe">Tarjeta de Crédito/Débito</option>
                                <option value="paypal">PayPal</option>
                                <option value="nequi">Nequi</option>
                                <option value="efectivo">Pago en Efectivo (Al recoger)</option>
                            </select>
                        </div>

                        <!-- Formulario para Tarjeta de Crédito -->
                        <div id="stripe-payment" class="payment-method-form mb-4">
                            <div id="card-element" class="w-full border border-gray-300 rounded-md px-4 py-2"></div>
                            <div id="card-errors" class="text-red-500 text-sm mt-2"></div>
                        </div>

                        <!-- Formulario para PayPal -->
                        <div id="paypal-payment" class="payment-method-form hidden">
                            <div id="paypal-button-container" class="mb-4"></div>
                            <input type="hidden" name="paypal_payment_id" id="paypal_payment_id">
                        </div>

                        <!-- Formulario para Nequi -->
                        <div id="nequi-payment" class="payment-method-form hidden">
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <h3 class="font-semibold text-lg mb-3 text-blue-800">Pago con Nequi</h3>
                                <div class="flex flex-col md:flex-row items-center gap-6">
                                    <div class="w-48 h-48 bg-white p-2 rounded-lg shadow-md">
                                        <img src="{{ asset('images/nequi-qr-code.png') }}" alt="Código QR Nequi" class="w-full h-full object-contain">
                                    </div>
                                    <div>
                                        <p class="mb-2 text-gray-700">Escanea el código QR con la app de Nequi o realiza la transferencia manualmente:</p>
                                        <div class="bg-white p-3 rounded-lg shadow-inner">
                                            <p class="font-mono text-lg font-bold">(321) 495 6470</p>
                                        </div>
                                        <p class="mt-3 text-sm text-gray-600">Después de realizar el pago, por favor envía el comprobante a nuestro WhatsApp para procesar tu pedido.</p>
                                        <a href="https://wa.me/573123456789" class="inline-block mt-2 bg-green-500 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                            </svg>
                                            Enviar Comprobante
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="nequi_payment" value="1">
                        </div>

                        <!-- Opción de pago en efectivo -->
                        <div id="efectivo-payment" class="payment-method-form hidden">
                            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                                <h3 class="font-semibold text-lg mb-3 text-green-800">Pago en Efectivo</h3>
                                <p class="text-gray-700 mb-4">Puedes pagar directamente cuando vengas a recoger tu pedido en la tienda.</p>
                                <div class="bg-white p-3 rounded-lg shadow-inner">
                                    <p class="font-semibold">Recuerda traer:</p>
                                    <ul class="list-disc pl-5 mt-2 space-y-1">
                                        <li>Número de orden (te llegará por correo)</li>
                                        <li>Documento de identidad</li>
                                        <li>Monto exacto del pago (${{ number_format($total, 2) }})</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-md mt-4 transition duration-200">
                        {{ $total > 0 ? 'Confirmar Pedido' : 'Completar Registro' }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Resumen del Pedido -->
        <div>
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Resumen del Pedido</h2>
                @foreach($cart as $productId => $item)
                    <div class="flex justify-between mb-2">
                        <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                        <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </div>
                @endforeach
                <hr class="my-4">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Subtotal:</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-bold text-lg">Total:</span>
                    <span class="text-lg font-bold" id="total-amount">${{ number_format($total, 2) }}</span>
                </div>

                <!-- Información de recogida -->
                <div class="mt-6 bg-blue-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-blue-800 mb-2">Recogerás tu pedido en:</h3>
                    <p class="text-gray-700">Cra 4 # 5-62, El Agrado, Huila</p>
                    <p class="text-sm text-gray-600 mt-2">Horario: L-V 9AM-7PM, Sáb 10AM-5PM</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar cambio entre recogida y envío (aunque envío está deshabilitado por ahora)
        const deliveryMethodPickup = document.getElementById('pickup-store');
        const deliveryMethodHome = document.getElementById('delivery-home');
        const pickupInfo = document.getElementById('pickup-info');
        const deliveryInfo = document.getElementById('delivery-info');

        if (deliveryMethodPickup && deliveryMethodHome) {
            deliveryMethodPickup.addEventListener('change', function() {
                pickupInfo.classList.remove('hidden');
                deliveryInfo.classList.add('hidden');
            });

            deliveryMethodHome.addEventListener('change', function() {
                pickupInfo.classList.add('hidden');
                deliveryInfo.classList.remove('hidden');
            });
        }

        // Cambiar entre métodos de pago
        const paymentMethodSelect = document.getElementById('payment_method');
        const paymentForms = document.querySelectorAll('.payment-method-form');

        if (paymentMethodSelect) {
            paymentMethodSelect.addEventListener('change', function() {
                // Ocultar todos los formularios de pago
                paymentForms.forEach(form => {
                    form.classList.add('hidden');
                });
                
                // Mostrar solo el seleccionado
                const selectedForm = document.getElementById(this.value + '-payment');
                if (selectedForm) {
                    selectedForm.classList.remove('hidden');
                }
            });

            // Mostrar método de pago inicial
            paymentMethodSelect.dispatchEvent(new Event('change'));
        }
    });
</script>

@if($total > 0)
<script src="https://js.stripe.com/v3/"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD"></script>
<script>
    // Configuración de Stripe
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const form = document.getElementById('checkout-form');
    const paymentMethodSelect = document.getElementById('payment_method');

    form.addEventListener('submit', async (event) => {
        // Solo procesar Stripe si es el método seleccionado
        if (paymentMethodSelect.value === 'stripe') {
            event.preventDefault();

            const {token, error} = await stripe.createToken(card);

            if (error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                document.getElementById('stripeToken').value = token.id;
                form.submit();
            }
        }
        // Para PayPal, Nequi y Efectivo, el formulario se envía normalmente
    });

    // Configuración de PayPal
    if (document.getElementById('paypal-button-container')) {
        paypal.Buttons({
            style: {
                layout: 'vertical',
                color: 'blue',
                shape: 'rect',
                label: 'paypal'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: document.getElementById('total-amount').textContent.replace('$', '')
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    document.getElementById('paypal_payment_id').value = details.id;
                    form.submit();
                });
            }
        }).render('#paypal-button-container');
    }
</script>
@endif
@endpush
@endsection