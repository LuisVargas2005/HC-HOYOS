<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Cita</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; margin: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.05); overflow: hidden;">
        <tr>
            <td style="padding: 30px; background-color: #007BFF; color: white; text-align: center;">
                <h1 style="margin: 0;">Confirmación de Cita</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <p>Hola <strong>{{ $appointment->name }}</strong>,</p>
                <p>Hemos recibido tu solicitud de cita. Aquí están los detalles de tu cita de reparación:</p>

                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 20px; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 10px; font-weight: bold; border-bottom: 1px solid #eee;">Dispositivo</td>
                        <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $appointment->category }} - {{ $appointment->model }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; font-weight: bold; background-color: #f9f9f9;">Problema</td>
                        <td style="padding: 10px; background-color: #f9f9f9;">{{ $appointment->problem }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; font-weight: bold;">Fecha</td>
                        <td style="padding: 10px;">{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; font-weight: bold; background-color: #f9f9f9;">Hora</td>
                        <td style="padding: 10px; background-color: #f9f9f9;">{{ $appointment->time }}</td>
                    </tr>
                </table>

                <p style="margin-top: 30px;">Nos pondremos en contacto contigo al número <strong>{{ $appointment->phone }}</strong> o al correo <strong>{{ $appointment->email }}</strong> si necesitamos más información.</p>

                <p style="margin-top: 30px;">Gracias por confiar en nuestro servicio.</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; font-size: 13px; color: #999; text-align: center; background-color: #f2f2f2;">
                Este mensaje ha sido generado automáticamente. Por favor, no respondas a este correo.
            </td>
        </tr>
    </table>
</body>
</html>
