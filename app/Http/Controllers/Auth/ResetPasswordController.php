<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * Muestra el formulario para restablecer la contraseña.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Restablece la contraseña del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ], [
            'token.required' => 'El token de restablecimiento es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Por favor, introduce una dirección de correo electrónico válida.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        // Traducimos los mensajes de estado directamente aquí
        $translatedStatus = '';
        switch ($status) {
            case Password::PASSWORD_RESET:
                $translatedStatus = '¡Tu contraseña ha sido restablecida!';
                break;
            case Password::RESET_THROTTLED:
                $translatedStatus = 'Demasiados intentos de restablecimiento de contraseña. Por favor, espera antes de reintentar.';
                break;
            case Password::INVALID_TOKEN:
                $translatedStatus = 'Este token de restablecimiento de contraseña es inválido.';
                break;
            case Password::INVALID_USER:
                $translatedStatus = 'No podemos encontrar un usuario con esa dirección de correo electrónico.';
                break;
            default:
                $translatedStatus = 'Ha ocurrido un error inesperado al intentar restablecer la contraseña.';
                break;
        }


        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', $translatedStatus)
            : back()->withErrors(['email' => $translatedStatus]);
    }
}
