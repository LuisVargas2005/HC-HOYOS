@extends('layouts.app')

@section('content')
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="max-w-2xl lg:max-w-5xl mx-auto">
      <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-800 sm:text-4xl dark:text-white">
          Contacta a Nuestro Equipo de Soporte
        </h1>
        <p class="mt-1 text-gray-600 dark:text-neutral-400">
          Obtén ayuda con tus pedidos, reparaciones o cualquier pregunta sobre nuestra plataforma.
        </p>
      </div>
  
      <div class="mt-12 grid items-center lg:grid-cols-2 gap-6 lg:gap-16">
        <div class="flex flex-col rounded-xl p-4 sm:p-6 lg:p-8 bg-white dark:bg-neutral-900 shadow-sm">
          <h2 class="mb-8 text-xl font-semibold text-gray-800 dark:text-neutral-200">
            Envíanos un mensaje
          </h2>
  
          <form>
            <div class="grid gap-4">
              <!-- Selección de propósito del formulario -->
              <div>
                <label for="contact-purpose" class="block text-sm font-medium mb-1 dark:text-neutral-300">¿Con qué podemos ayudarte?</label>
                <select id="contact-purpose" name="purpose" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400">
                  <option value="">Selecciona una opción</option>
                  <option value="order">Consulta sobre pedido</option>
                  <option value="repair">Agendamiento de reparación</option>
                  <option value="account">Problemas con la cuenta</option>
                  <option value="technical">Soporte técnico</option>
                  <option value="other">Otras preguntas</option>
                </select>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label for="first-name" class="block text-sm font-medium mb-1 dark:text-neutral-300">Nombre</label>
                  <input type="text" id="first-name" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400" placeholder="Tu nombre">
                </div>
  
                <div>
                  <label for="last-name" class="block text-sm font-medium mb-1 dark:text-neutral-300">Apellido</label>
                  <input type="text" id="last-name" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400" placeholder="Tu apellido">
                </div>
              </div>
  
              <div>
                <label for="email" class="block text-sm font-medium mb-1 dark:text-neutral-300">Correo electrónico</label>
                <input type="email" id="email" autocomplete="email" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400" placeholder="tu@email.com">
              </div>
  
              <div>
                <label for="phone" class="block text-sm font-medium mb-1 dark:text-neutral-300">Número de teléfono</label>
                <input type="text" id="phone" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400" placeholder="+52 123 456 7890">
              </div>

              <!-- Campo para número de pedido si es relevante -->
              <div id="order-number-field" class="hidden">
                <label for="order-number" class="block text-sm font-medium mb-1 dark:text-neutral-300">Número de pedido (opcional)</label>
                <input type="text" id="order-number" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400" placeholder="Ej: ORD-12345">
              </div>

              <!-- Campo para número de reparación si es relevante -->
              <div id="repair-number-field" class="hidden">
                <label for="repair-number" class="block text-sm font-medium mb-1 dark:text-neutral-300">Número de reparación (opcional)</label>
                <input type="text" id="repair-number" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400" placeholder="Ej: REP-67890">
              </div>
  
              <div>
                <label for="message" class="block text-sm font-medium mb-1 dark:text-neutral-300">Detalles</label>
                <textarea id="message" rows="4" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400" placeholder="Describe tu consulta en detalle..."></textarea>
              </div>
            </div>
  
            <div class="mt-4 grid">
              <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Enviar mensaje</button>
            </div>
  
            <div class="mt-3 text-center">
              <p class="text-sm text-gray-500 dark:text-neutral-500">
                Te responderemos en 1-2 días hábiles.
              </p>
            </div>
          </form>
        </div>
  
        <div class="divide-y divide-gray-200 dark:divide-neutral-800">

          <!-- Sección de eCommerce -->

          <div class="flex gap-x-7 py-6">
            <svg class="shrink-0 size-6 mt-1.5 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            <div class="grow">
              <h3 class="font-semibold text-gray-800 dark:text-neutral-200">Soporte de eCommerce</h3>
              <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">¿Problemas con tu pedido? Consulta el estado, devoluciones o pagos.</p>
              <a class="mt-2 inline-flex items-center gap-x-2 text-sm font-medium text-gray-600 hover:text-gray-800 focus:outline-none focus:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200" href="#">
                Contactar al equipo de ventas
                <svg class="shrink-0 size-2.5 transition ease-in-out group-hover:translate-x-1 group-focus:translate-x-1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M0.975821 6.92249C0.43689 6.92249 -3.50468e-07 7.34222 -3.27835e-07 7.85999C-3.05203e-07 8.37775 0.43689 8.79749 0.975821 8.79749L12.7694 8.79748L7.60447 13.7596C7.22339 14.1257 7.22339 14.7193 7.60447 15.0854C7.98555 15.4515 8.60341 15.4515 8.98449 15.0854L15.6427 8.68862C16.1191 8.23098 16.1191 7.48899 15.6427 7.03134L8.98449 0.634573C8.60341 0.268455 7.98555 0.268456 7.60447 0.634573C7.22339 1.00069 7.22339 1.59428 7.60447 1.9604L12.7694 6.92248L0.975821 6.92249Z" fill="currentColor"/>
                </svg>
              </a>
            </div>
          </div>
  
          <!-- Sección de reparaciones -->
          <div class="flex gap-x-7 py-6">
            <svg class="shrink-0 size-6 mt-1.5 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
            <div class="grow">
              <h3 class="font-semibold text-gray-800 dark:text-neutral-200">Agendamiento de Reparaciones</h3>
              <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">Programa, modifica o consulta el estado de tu servicio técnico.</p>
              <a class="mt-2 inline-flex items-center gap-x-2 text-sm font-medium text-gray-600 hover:text-gray-800 focus:outline-none focus:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200" href="{{ url('/agendar') }}">
                Agenda una reparación
                <svg class="shrink-0 size-2.5 transition ease-in-out group-hover:translate-x-1 group-focus:translate-x-1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M0.975821 6.92249C0.43689 6.92249 -3.50468e-07 7.34222 -3.27835e-07 7.85999C-3.05203e-07 8.37775 0.43689 8.79749 0.975821 8.79749L12.7694 8.79748L7.60447 13.7596C7.22339 14.1257 7.22339 14.7193 7.60447 15.0854C7.98555 15.4515 8.60341 15.4515 8.98449 15.0854L15.6427 8.68862C16.1191 8.23098 16.1191 7.48899 15.6427 7.03134L8.98449 0.634573C8.60341 0.268455 7.98555 0.268456 7.60447 0.634573C7.22339 1.00069 7.22339 1.59428 7.60447 1.9604L12.7694 6.92248L0.975821 6.92249Z" fill="currentColor"/>
                </svg>
              </a>
            </div>
          </div>
  
          <!-- Sección de Preguntas Frecuentes -->
          <div class="flex gap-x-7 py-6">
            <svg class="shrink-0 size-6 mt-1.5 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
            <div class="grow">
              <h3 class="font-semibold text-gray-800 dark:text-neutral-200">Preguntas Frecuentes</h3>
              <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">Encuentra respuestas rápidas a las preguntas más comunes.</p>
              <a class="mt-2 inline-flex items-center gap-x-2 text-sm font-medium text-gray-600 hover:text-gray-800 focus:outline-none focus:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200" href="#">
                Ver preguntas frecuentes
                <svg class="shrink-0 size-2.5 transition ease-in-out group-hover:translate-x-1 group-focus:translate-x-1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M0.975821 6.92249C0.43689 6.92249 -3.50468e-07 7.34222 -3.27835e-07 7.85999C-3.05203e-07 8.37775 0.43689 8.79749 0.975821 8.79749L12.7694 8.79748L7.60447 13.7596C7.22339 14.1257 7.22339 14.7193 7.60447 15.0854C7.98555 15.4515 8.60341 15.4515 8.98449 15.0854L15.6427 8.68862C16.1191 8.23098 16.1191 7.48899 15.6427 7.03134L8.98449 0.634573C8.60341 0.268455 7.98555 0.268456 7.60447 0.634573C7.22339 1.00069 7.22339 1.59428 7.60447 1.9604L12.7694 6.92248L0.975821 6.92249Z" fill="currentColor"/>
                </svg>
              </a>
            </div>
          </div>
  
          <!-- Sección de contacto directo -->
          <div class="flex gap-x-7 py-6">
            <svg class="shrink-0 size-6 mt-1.5 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z"/><path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10"/></svg>
            <div class="grow">
              <h3 class="font-semibold text-gray-800 dark:text-neutral-200">Contáctanos directamente</h3>
              <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">Para consultas urgentes o información adicional:</p>
              <div class="mt-2 space-y-1">
                <p class="text-sm font-medium text-gray-600 dark:text-neutral-400">Email: <span class="text-blue-600 dark:text-blue-400">Hcsistemasyservicios@gmail.com</span></p>
                <p class="text-sm font-medium text-gray-600 dark:text-neutral-400">Teléfono: <span class="text-blue-600 dark:text-blue-400">+57 321 495 6470  <span class="text-gray-400"> / </span>+57 311 882 5821
                <p class="text-sm font-medium text-gray-600 dark:text-neutral-400">Horario: <span class="text-gray-500 dark:text-neutral-500">Lunes a Viernes, 9am - 6pm</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Mostrar campos adicionales según la selección
    document.getElementById('contact-purpose').addEventListener('change', function() {
      const orderField = document.getElementById('order-number-field');
      const repairField = document.getElementById('repair-number-field');
      
      orderField.classList.add('hidden');
      repairField.classList.add('hidden');
      
      if(this.value === 'order') {
        orderField.classList.remove('hidden');
      } else if(this.value === 'repair') {
        repairField.classList.remove('hidden');
      }
    });
  </script>
@endsection