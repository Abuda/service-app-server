<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validatedInput = $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = User::create($validatedInput);

        return Response()->json(['user' => $user]);
    }

    public function login(Request $request) {
        $validatedInput = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!Auth::attempt($validatedInput)) {
            return Response()->json(['message' => 'no'], 400);
        }

        $token = Auth::user()->create_token('Auth_Token');

        return Response()->json(['user' => Auth::user(), 'token' => $token], 400);
    }
}
