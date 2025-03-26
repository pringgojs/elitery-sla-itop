<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Sanctum\PersonalAccessToken;

class SSOTokenController extends Controller
{
    public function phpMyAdmin(Request $request)
    {
        $user = Auth::user();
        $token = $user->createToken('SSO Token')->plainTextToken;

        $url = 'https://sinau.ponorogo.go.id/mbulrp?token='.$token;

        return Redirect::to($url);
    }

    public function validateToken(Request $request)
    {
        $token = $request->bearerToken();

        info('TOKEN DARI MYSQL'.$token);

        $tokenData = PersonalAccessToken::findToken($token);

        if (! $tokenData) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $user = $tokenData->tokenable;

        return response()->json([
            'user' => [
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
            ],
        ]);
    }
}
