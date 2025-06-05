<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string',
            'model' => 'required|string',
            'problem' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $appointment = Appointment::create($data);

        // Enviar correo de confirmación
        Mail::to($data['email'])->send(new AppointmentConfirmation($appointment));

        return response()->json(['success' => true]);
    }
}
