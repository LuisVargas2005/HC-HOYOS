@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Checkout</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($hasPhysicalProducts)
        <input type="hidden" name="has_physical_products" value="true">
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Formulario -->
        <div class="md:col-span-2">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Order Details</h2>

                <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block font-medium mb-1">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:outline-none" required>
                        <input type="hidden" name="stripeToken" id="stripeToken">
                    </div>

                    @if($hasPhysicalProducts)
                        <div class="mb-4">
                            <label for="shipping_address" class="block font-medium mb-1">Shipping Address</label>
                            <textarea id="shipping_address" name="shipping_address" rows="3" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:outline-none" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="shipping_method" class="block font-medium mb-1">Shipping Method</label>
                            <select id="shipping_method" name="shipping_method_id" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:outline-none">
                                @foreach($shippingMethods as $method)
                                    <option value="{{ $method->id }}" data-base-rate="{{ $method->base_rate }}">
                                        {{ $method->name }} - ${{ number_format($method->base_rate, 2) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4 flex items-center">
                            <input type="checkbox" id="dropship" name="dropship" class="mr-2">
                            <label for="dropship" class="text-sm">Ship directly to recipient (Drop shipping)</label>
                        </div>

                        <div id="recipient-info" class="hidden">
                            <div class="mb-4">
                                <label for="recipient_name" class="block font-medium mb-1">Recipient Name</label>
                                <input type="text" id="recipient_name" name="recipient_name" class="w-full border border-gray-300 rounded-md px-4 py-2">
                            </div>
                            <div class="mb-4">
                                <label for="recipient_email" class="block font-medium mb-1">Recipient Email</label>
                                <input type="email" id="recipient_email" name="recipient_email" class="w-full border border-gray-300 rounded-md px-4 py-2">
                            </div>
                            <div class="mb-4">
                                <label for="gift_message" class="block font-medium mb-1">Gift Message (Optional)</label>
                                <textarea id="gift_message" name="gift_message" rows="2" class="w-full border border-gray-300 rounded-md px-4 py-2"></textarea>
                            </div>
                        </div>
                    @endif

                    @if($total > 0)
                        <div class="mb-4">
                            <label for="payment_method" class="block font-medium mb-1">Payment Method</label>
                            <select id="payment_method" name="payment_method" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:outline-none">
                                <option value="stripe">Credit Card (Stripe)</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>

                        <div id="stripe-payment" class="payment-method-form mb-4">
                            <div id="card-element" class="w-full border border-gray-300 rounded-md px-4 py-2"></div>
                            <div id="card-errors" class="text-red-500 text-sm mt-2"></div>
                        </div>

                        <div id="paypal-payment" class="payment-method-form hidden">
                            <div id="paypal-button-container" class="mb-4"></div>
                            <input type="hidden" name="paypal_payment_id" id="paypal_payment_id">
                        </div>
                    @endif

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-md mt-4 transition duration-200">
                        {{ $total > 0 ? 'Complete Purchase' : 'Complete Order' }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Resumen -->
        <div>
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
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
                @if($hasPhysicalProducts)
                    <div class="flex justify-between mb-2" id="shipping-cost">
                        <span class="font-semibold">Shipping:</span>
                        <span>$0.00</span>
                    </div>
                @endif
                <div class="flex justify-between">
                    <span class="font-bold text-lg">Total:</span>
                    <span class="text-lg font-bold" id="total-amount">${{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle drop shipping recipient info
        const dropshipCheckbox = document.getElementById('dropship');
        const recipientInfo = document.getElementById('recipient-info');

        if (dropshipCheckbox) {
            dropshipCheckbox.addEventListener('change', function() {
                recipientInfo.classList.toggle('d-none', !this.checked);
            });
        }

        // Update shipping cost when shipping method changes
        const shippingMethodSelect = document.getElementById('shipping_method');
        const shippingCostElement = document.querySelector('#shipping-cost span');
        const totalAmountElement = document.getElementById('total-amount');
        let subtotal = {{ $total }};

        if (shippingMethodSelect) {
            shippingMethodSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const shippingRate = parseFloat(selectedOption.dataset.baseRate);

                shippingCostElement.textContent = '$' + shippingRate.toFixed(2);
                const total = subtotal + shippingRate;
                totalAmountElement.textContent = '$' + total.toFixed(2);
            });

            // Trigger change to set initial shipping cost
            shippingMethodSelect.dispatchEvent(new Event('change'));
        }

        // Toggle payment methods
        const paymentMethodSelect = document.getElementById('payment_method');
        const stripePayment = document.getElementById('stripe-payment');
        const paypalPayment = document.getElementById('paypal-payment');

        if (paymentMethodSelect) {
            paymentMethodSelect.addEventListener('change', function() {
                if (this.value === 'stripe') {
                    stripePayment.classList.remove('d-none');
                    paypalPayment.classList.add('d-none');
                } else if (this.value === 'paypal') {
                    stripePayment.classList.add('d-none');
                    paypalPayment.classList.remove('d-none');
                }
            });
        }
    });
</script>

@if($total > 0)
<script src="https://js.stripe.com/v3/"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD"></script>
<script>
    // Stripe integration
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const form = document.getElementById('checkout-form');
    const paymentMethodSelect = document.getElementById('payment_method');

    form.addEventListener('submit', async (event) => {
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
    } else if (paymentMethodSelect.value === 'paypal') {
        // Bloquea el submit si se seleccionó PayPal para evitar doble envío
        event.preventDefault();
    }
});

    // PayPal integration
    if (document.getElementById('paypal-button-container')) {
        paypal.Buttons({
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