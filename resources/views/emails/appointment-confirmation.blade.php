<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Cita</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <h1 style="color: #007BFF;">Confirmación de Cita</h1>
        <p>Hola <strong>{{ $appointment->name }}</strong>,</p>
        <p>Tu cita ha sido agendada con éxito. Aquí están los detalles:</p>

        <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px; font-weight: bold;">Dispositivo:</td>
                <td style="padding: 8px;">{{ $appointment->category }} - {{ $appointment->model }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <td style="padding: 8px; font-weight: bold;">Problema:</td>
                <td style="padding: 8px;">{{ $appointment->problem }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; font-weight: bold;">Fecha:</td>
                <td style="padding: 8px;">{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <td style="padding: 8px; font-weight: bold;">Hora:</td>
                <td style="padding: 8px;">{{ $appointment->time }}</td>
            </tr>
        </table>

        <p style="margin-top: 30px;">Gracias por confiar en nosotros. Si tienes alguna pregunta, no dudes en contactarnos.</p>

        <p style="margin-top: 40px; font-size: 14px; color: #777;">Este mensaje ha sido generado automáticamente. Por favor, no respondas a este correo.</p>
    </div>
</body>
</html>