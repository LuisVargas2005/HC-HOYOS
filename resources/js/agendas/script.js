// Carrusel
const carousel = document.getElementById('carousel');
const cards = document.querySelectorAll('.card');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
let scrollAmount = 0;
const cardWidth = 160;

nextBtn.addEventListener('click', () => {
  scrollAmount += cardWidth;
  if (scrollAmount >= carousel.scrollWidth - carousel.clientWidth) scrollAmount = 0;
  carousel.scrollTo({ left: scrollAmount, behavior: 'smooth' });
});
prevBtn.addEventListener('click', () => {
  scrollAmount -= cardWidth;
  if (scrollAmount < 0) scrollAmount = carousel.scrollWidth - carousel.clientWidth;
  carousel.scrollTo({ left: scrollAmount, behavior: 'smooth' });
});

// Buscador
document.getElementById('categorySearch').addEventListener('input', function () {
  const search = this.value.toLowerCase();
  cards.forEach(card => {
    const match = card.textContent.toLowerCase().includes(search);
    card.style.display = match ? 'block' : 'none';
  });
});

// Paso 2
let selectedCategory = null;
let selectedModel = null;

const modelsByCategory = {
  mobile: ['iPhone 14', 'Samsung Galaxy S22', 'Otro'],
  desktop: ['iMac M1', 'HP Pavilion', 'Otro'],
  tablet: ['iPad Air', 'Galaxy Tab', 'Otro'],
  camera: ['Canon EOS', 'Nikon Z50'],
  game: ['PlayStation 5', 'Xbox Series X'],
  industrial: ['Siemens Control', 'Mitsubishi PLC'],
  others: ['Otro dispositivo 1', 'Otro dispositivo 2']
};

function renderModels(category) {
  const container = document.getElementById('modelsContainer');
  container.innerHTML = '';
  (modelsByCategory[category] || []).forEach(model => {
    const div = document.createElement('div');
    div.className = 'model-card';
    div.innerText = model;
    div.addEventListener('click', () => {
      document.querySelectorAll('.model-card').forEach(el => el.classList.remove('selected'));
      div.classList.add('selected');
      selectedModel = model;
    });
    container.appendChild(div);
  });
}

cards.forEach(card => {
  card.addEventListener('click', () => {
    selectedCategory = card.dataset.category;
    document.querySelector('.step-1').classList.remove('active');
    document.querySelector('.step-1').classList.add('hidden');
    document.querySelector('.step-2').classList.remove('hidden');
    document.querySelector('.step-2').classList.add('active');
    renderModels(selectedCategory);
  });
});

// Paso 3
let selectedProblem = null;

const problemsByModel = {
  'iPhone 14': ['Pantalla rota', 'Batería agotada', 'No enciende'],
  'Samsung Galaxy S22': ['Puerto de carga dañado', 'Pantalla negra', 'Se reinicia solo'],
  'Otro': ['Batería', 'Bloqueo', 'Virus'],
  'iMac M1': ['Pantalla no responde', 'Ventilador ruidoso'],
  'HP Pavilion': ['Problemas de arranque', 'Teclado no funciona'],
  'Otro': ['Sobrecalentamiento', 'Instalación de software', 'Pantalla', 'Teclado'],
  'iPad Air': ['Pantalla quebrada', 'Problemas de audio', 'Software', 'Virus'],
  'Galaxy Tab': ['Wifi no funciona', 'No reconoce el cargador', 'Software', 'Virus'],
  'Canon EOS': ['Lente atascado', 'No toma fotos'],
  'Nikon Z50': ['Error de tarjeta', 'Pantalla no enciende'],
  'PlayStation 5': ['No da imagen', 'No lee discos'],
  'Xbox Series X': ['Ruido extraño', 'No arranca'],
  'Siemens Control': ['Fallo de comunicación', 'Pantalla apagada'],
  'Mitsubishi PLC': ['Error de sistema', 'No se conecta'],
  'Otro dispositivo 1': ['Problema 1', 'Problema 2'],
  'Otro dispositivo 2': ['Problema 3', 'Problema 4']
};

function renderProblems(model) {
  const container = document.getElementById('problemsContainer');
  container.innerHTML = '';
  (problemsByModel[model] || ['Otro problema']).forEach(problem => {
    const div = document.createElement('div');
    div.className = 'problem-card';
    div.innerText = problem;
    div.addEventListener('click', () => {
      document.querySelectorAll('.problem-card').forEach(el => el.classList.remove('selected'));
      div.classList.add('selected');
      selectedProblem = problem;
    });
    container.appendChild(div);
  });
}

document.getElementById('goToStep3').addEventListener('click', () => {
  if (!selectedModel) {
    alert('Por favor selecciona un modelo.');
    return;
  }

  document.querySelector('.step-2').classList.remove('active');
  document.querySelector('.step-2').classList.add('hidden');
  document.querySelector('.step-3').classList.remove('hidden');
  document.querySelector('.step-3').classList.add('active');

  renderProblems(selectedModel);
});

// Paso 4
let selectedDate = null;
let selectedTime = null;

const availableTimes = ['09:00 AM', '10:00 AM', '11:00 AM', '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM'];

document.getElementById('goToStep4').addEventListener('click', () => {
  if (!selectedProblem) {
    alert('Por favor selecciona un problema.');
    return;
  }

  document.querySelector('.step-3').classList.remove('active');
  document.querySelector('.step-3').classList.add('hidden');
  document.querySelector('.step-4').classList.remove('hidden');
  document.querySelector('.step-4').classList.add('active');

  setMinDateToday();
  renderTimeSlots();
});

function setMinDateToday() {
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('datePicker').setAttribute('min', today);
}

document.getElementById('datePicker').addEventListener('change', (e) => {
  selectedDate = e.target.value;
});

function renderTimeSlots() {
  const container = document.getElementById('timeSlots');
  container.innerHTML = '';
  availableTimes.forEach(time => {
    const div = document.createElement('div');
    div.className = 'time-slot';
    div.innerText = time;
    div.addEventListener('click', () => {
      document.querySelectorAll('.time-slot').forEach(slot => slot.classList.remove('selected'));
      div.classList.add('selected');
      selectedTime = time;
    });
    container.appendChild(div);
  });
}

// Paso 5
let clientData = {};

document.getElementById('goToStep5').addEventListener('click', () => {
  selectedDate = document.getElementById('datePicker')?.value;
  selectedTime = document.querySelector('.time-slot.selected')?.innerText;

  if (!selectedDate || !selectedTime) {
    alert('Por favor selecciona una fecha y hora.');
    return;
  }

  document.querySelector('.step-4').classList.remove('active');
  document.querySelector('.step-4').classList.add('hidden');
  document.querySelector('.step-5').classList.remove('hidden');
  document.querySelector('.step-5').classList.add('active');
});

document.getElementById('goToStep6').addEventListener('click', () => {
  const name = document.getElementById('clientName').value.trim();
  const email = document.getElementById('clientEmail').value.trim();
  const phone = document.getElementById('clientPhone').value.trim();

  if (!name || !email || !phone) {
    alert('Por favor complete todos los campos.');
    return;
  }

  clientData = { name, email, phone };

  document.querySelector('.step-5').classList.remove('active');
  document.querySelector('.step-5').classList.add('hidden');
  document.querySelector('.step-6').classList.remove('hidden');
  document.querySelector('.step-6').classList.add('active');

  showSummary();
});

function showSummary() {
  const summaryContainer = document.getElementById('summaryContainer');
  summaryContainer.innerHTML = `
    <p><strong>Categoría:</strong> ${selectedCategory}</p>
    <p><strong>Modelo:</strong> ${selectedModel}</p>
    <p><strong>Problema:</strong> ${selectedProblem}</p>
    <p><strong>Fecha:</strong> ${selectedDate}</p>
    <p><strong>Hora:</strong> ${selectedTime}</p>
    <p><strong>Nombre:</strong> ${clientData.name}</p>
    <p><strong>Email:</strong> ${clientData.email}</p>
    <p><strong>Teléfono:</strong> ${clientData.phone}</p>
  `;
}

// Enviar cita
document.getElementById('submitAppointment').addEventListener('click', () => {
  if (!selectedDate || !selectedTime || !clientData.name || !clientData.email || !clientData.phone) {
    alert('Por favor completa todos los datos antes de confirmar.');
    return;
  }

  const appointmentData = {
    category: selectedCategory,
    model: selectedModel,
    problem: selectedProblem,
    date: selectedDate,
    time: selectedTime,
    name: clientData.name,
    email: clientData.email,
    phone: clientData.phone,
  };

  fetch('/appointments', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify(appointmentData)
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('¡Cita agendada correctamente! Revisa tu correo.');
      } else {
        alert('Ocurrió un error al guardar la cita.');
      }
    })
    .catch(err => {
      console.error('Error al enviar la cita:', err);
      alert('Error al enviar la cita.');
    });
});
