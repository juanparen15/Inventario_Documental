<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User; // Importa el modelo User
use App\Notifications\ResetPassword; // Importa tu notificación
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class CustomForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Valida el email
        $this->validateEmail($request);

        // Busca el usuario por el email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Crear el token para el restablecimiento de contraseña
            $token = app('auth.password.broker')->createToken($user);

            // Enviar la notificación personalizada
            $user->notify(new ResetPassword($token));
        }

        // Retornar una respuesta
        return back()->with('status', trans(Password::RESET_LINK_SENT));
    }
}
