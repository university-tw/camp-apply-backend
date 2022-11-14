<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    /**
     * Sanctum Login user issue token
     */
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::whereEmail($request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return $user->createToken('frontend')->plainTextToken;
        }

        return response([
            'message' => 'Bad credentials'
        ], 401);
    }

    /**
     * Sanctum Register user and issue token
     */
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $user->createToken('frontend')->plainTextToken;
    }

    /**
     * Sanctum remove current token
     */
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Logged out'
        ]);
    }
}
