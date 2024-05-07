<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function sendResetPasswordLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Генерация и сохранение ссылки для сброса пароля
        $resetUrl = url('/reset-password/' . $user->generatePasswordResetToken());

        // Отправка письма с ссылкой на сброс пароля
        Mail::to($user->email)->send(new ResetPasswordMail($resetUrl));

        return response()->json(['message' => 'Reset password link sent successfully'], 200);
    }

    public function resetPassword(Request $request, $token)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('password_reset_token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid or expired token'], 404);
        }

        // Обновление пароля
        $user->password = Hash::make($request->password);
        $user->password_reset_token = null;
        $user->save();

        return response()->json(['success' => 'Password reset successfully'], 200);
    }
}
