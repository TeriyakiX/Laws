<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ResetPasswordCodeMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function sendResetPasswordLink(Request $request)
    {
        // Валидация входных данных
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        // Проверка на наличие ошибок валидации
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Нахождение пользователя по адресу электронной почты
        $user = User::where('email', $request->email)->first();

        // Проверка на наличие пользователя
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Генерация токена для сброса пароля
        $token = Str::random(60);

        // Сохранение токена в базе данных
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['email' => $user->email, 'token' => $token, 'created_at' => now()]
        );

        // Формирование URL для сброса пароля
        $resetUrl = URL::temporarySignedRoute(
            'password.reset', now()->addMinutes(30), ['token' => $token]
        );

        // Отправка письма с ссылкой для сброса пароля
        Mail::to($user->email)->send(new ResetPasswordLinkMail($resetUrl));

        return response()->json(['message' => 'Reset password link sent successfully'], 200);
    }
}
