<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Services\AppleToken;

class AppleController extends Controller
{
    public function redirectToApple()
    {
        return Socialite::driver('apple')->stateless()->redirect();
    }

    public function handleAppleCallback(AppleToken $appleToken)
    {
        config()->set('services.apple.client_secret', $appleToken->generate());

        $appleUser = Socialite::driver('apple')->stateless()->user();

        $user = User::where('email', $appleUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $appleUser->getName(),
                'email' => $appleUser->getEmail(),
            ]);
        }

        $token = $user->createToken('Law')->plainTextToken;
        try {
            $appleUser = Socialite::driver('apple')->stateless()->user();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Apple callback error'], 500);
        }

        return response()->json([
            'user' => $user,
            'access_token' => $token,
        ]);

    }
}
