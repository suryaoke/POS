<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            /**
             * Email
             * @example admin@gmail.com
             */
            'email' => 'required|email',
            /**
             * Email
             * @example 12345678
             */
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password salah',
                'data' => null
            ], 422);
        }
        $token = $user->createToken('API token')->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'Sukses Login',
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]
        ]);
    }
}
