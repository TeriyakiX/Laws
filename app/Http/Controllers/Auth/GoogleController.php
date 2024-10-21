<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Google_Client;


class GoogleController extends Controller
{
    public function handleGoogleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->setScopes(['email', 'profile']);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');

        if ($request->has('code')) {
            $authorizationCode = $request->input('code');

            try {
                // Обмен кода авторизации на токен доступа
                $token = $client->fetchAccessTokenWithAuthCode($authorizationCode);

                if (isset($token['error'])) {
                    return response()->json(['error' => $token['error'], 'error_description' => $token['error_description']], 400);
                }

                // Установка токена доступа
                $client->setAccessToken($token['access_token']);

                // Получение информации о пользователе
                $googleUser = Socialite::driver('google')->stateless()->userFromToken($token['access_token']);

                $user = User::where('email', $googleUser->getEmail())->first();

                if (!$user) {
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                    ]);
                }

                $accessToken = $user->createToken('Law')->plainTextToken;

                //$authCode = request()->input('code');

                // $redirectUri = "lawsapi://lawsapi.ru/api/v1/auth/google/callback?code={$authCode}";
                $redirectUri = "lawsapi://lawsapi.ru/api/v1/auth/google/callback?token={$accessToken}";

                return redirect()->away($redirectUri);

                /* return response()->json([
                    'user' => $user,
                    'access_token' => $accessToken,
                    'authorization_code' => $authorizationCode,  // Возвращаем authorization_code для отладки
                ]); */
            } catch (Exception $e) {
                return response()->json(['error' => 'Invalid grant or authorization code already used', 'message' => $e->getMessage()], 400);
            }
        } else {
            return response()->json(['error' => 'Authorization code not provided'], 400);
        }
    }

    public function redirectToGoogle()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->setScopes(['email', 'profile']);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        return redirect($client->createAuthUrl());
    }
}
