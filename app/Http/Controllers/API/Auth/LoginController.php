<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            Log::error('Unauthorized login attempt for email: ' . $request->email);
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('token-name')->plainTextToken;

        $user->tokens->last()->update(['expires_at' => now()->addMinutes(1440)]);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 1440,
        ]);
    }
}
