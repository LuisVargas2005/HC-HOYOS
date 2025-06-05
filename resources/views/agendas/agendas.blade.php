<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/agendas/style.css', 'resources/js/agendas/script.js'])
    <title>Agendas</title>
</head>
<body>

<div class="appointment-carousel">
    <h1 class="title">¡Véalo en acción!</h1>
    <p class="subtitle">
        Su diseño impactante e intuitivo está diseñado específicamente para talleres de reparación.
        Totalmente adaptable a todos los dispositivos.
    </p>

    <div class="step-indicator">1 de 7</div>

    <div class="steps-wrapper">

        <!-- PASO 1: Categoría -->
        <section class="step step-1 active">
            <h2 class="step-title">Paso 1: Seleccione la Categoría</h2>

            <div class="search-bar">
                <label for="categorySearch">Buscar Categoría</label>
                <input type="text" id="categorySearch" placeholder="Search Category">
            </div>

            <div class="carousel-container">
                <div class="carousel" id="carousel">
                    <div class="card" data-category="mobile"> <img src="/images/mobile.png" alt=""> <span>Mobile</span> </div>
                    <div class="card" data-category="desktop"> <img src="/images/desktop.png" alt=""> <span>Desktop</span> </div>
                    <div class="card" data-category="tablet"> <img src="/images/tablet.png" alt=""> <span>Tablet / iPad</span> </div>
                    <div class="card" data-category="camera"> <img src="/images/camera.png" alt=""> <span>Camera</span> </div>
                    <div class="card" data-category="game"> <img src="/images/game.png" alt=""> <span>Game Console</span> </div>
                    <div class="card" data-category="industrial"> <img src="/images/industrial.png" alt=""> <span>Industrial</span> </div>
                    <div class="card" data-category="others"> <img src="/images/others.png" alt=""> <span>Others</span> </div>
                </div>
            </div>

            <div class="carousel-nav">
                <button id="prevBtn">‹</button>
                <button id="nextBtn">›</button>
            </div>
        </section>

        <!-- PASO 2: Selección de Modelo / Marca -->
        <section class="step step-2 hidden">
            <h2 class="step-title">Paso 2: Seleccione el Modelo o Marca</h2>
            <p class="subtitle">Elija el modelo correspondiente a su dispositivo para continuar.</p>

            <div class="models-container" id="modelsContainer"></div>

            <div style="text-align: center; margin-top: 2rem;">
                <button class="btn" id="goToStep3">Siguiente</button>
            </div>
        </section>

        <!-- PASO 3: Selección de Problema -->
        <section class="step step-3 hidden">
            <h2 class="step-title">Paso 3: Seleccione el Problema del Dispositivo</h2>
            <p class="subtitle">Seleccione el problema que presenta el dispositivo.</p>

            <div class="problems-container" id="problemsContainer"></div>

            <div style="text-align: center; margin-top: 2rem;">
                <button class="btn" id="goToStep4">Siguiente</button>
            </div>
        </section>

        <!-- PASO 4: Selección de Fecha y Hora -->
        <section class="step step-4 hidden">
            <h2 class="step-title">Paso 4: Seleccione la Fecha y Hora</h2>
            <p class="subtitle">Elija una fecha y un horario disponible para su cita.</p>

            <div class="date-time-selector">
                <label for="datePicker">Seleccione una fecha:</label><br>
                <input type="date" id="datePicker" min="" /><br><br>

                <label for="timeSlots">Horarios disponibles:</label>
                <div class="time-slots" id="timeSlots"></div>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <button class="btn" id="goToStep5">Siguiente</button>
            </div>
        </section>
        
        <!-- PASO 5: Información del Cliente -->
        <section class="step step-5 hidden">
        <h2 class="step-title">Paso 5: Ingrese sus Datos</h2>
        <p class="subtitle">Proporcione sus datos para confirmar la cita.</p>

        <div class="client-form">
            <div class="form-group">
            <label for="clientName">Nombre Completo</label>
            <input type="text" id="clientName" placeholder="Ej: Juan Pérez">
            </div>
            <div class="form-group">
            <label for="clientEmail">Correo Electrónico</label>
            <input type="email" id="clientEmail" placeholder="Ej: correo@ejemplo.com">
            </div>
            <div class="form-group">
            <label for="clientPhone">Teléfono</label>
            <input type="tel" id="clientPhone" placeholder="Ej: +1234567890">
            </div>
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <button class="btn" id="goToStep6">Siguiente</button>
        </div>
        </section>
    </div>

    <!-- Paso 6: Confirmación -->
    <div class="step step-6 hidden">
        <h2 class="text-xl font-bold mb-4">Paso 6: Confirmación</h2>

        <div id="summaryContainer" class="bg-white p-4 rounded shadow mb-4 text-gray-800">
            <!-- Aquí se llenará con JavaScript -->
        </div>

        <button id="confirmAppointment" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            Confirmar Cita
        </button>

    </div>
</div>
</body>
</html>