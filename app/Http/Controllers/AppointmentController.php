<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // ✅ 1. Validar los datos recibidos
        $data = $request->validate([
            'category' => 'required|string|max:255',
            'model'    => 'required|string|max:255',
            'problem'  => 'required|string|max:255',
            'date'     => 'required|date',
            'time'     => 'required|string|max:20',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'required|string|max:20',
        ]);

        // ✅ 2. Guardar la cita en la base de datos
        $appointment = Appointment::create($data);

        // ✅ 3. Enviar correo de confirmación
        try {
            Mail::to($data['email'])->send(new AppointmentConfirmation($appointment));
        } catch (\Exception $e) {
            Log::error('Error al enviar correo de confirmación de cita: ' . $e->getMessage());

            return response()->json([
                'success' => true,
                'message' => 'Cita guardada pero no se pudo enviar el correo.'
            ]);
        }

        // ✅ 4. Enviar respuesta al frontend
        return response()->json([
            'success' => true,
            'message' => 'Cita registrada correctamente y correo enviado.',
            'appointment' => $appointment,
        ]);
    }
}

