<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validatedInput = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'professional' => 'boolean',
            'profession_id' => [Rule::requiredIf($request->professional == true), 'exists:professions,id']
        ]);
        $validatedInput['password'] = bcrypt($validatedInput['password']);
        $user = User::create($validatedInput);

        return Response()->json(['message' => 'Registration Successful', 'user' => $user]);
    }

    public function login(Request $request) {
        $validatedInput = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!Auth::attempt($validatedInput)) {
            return Response()->json(['message' => 'no'], 400);
        }
        /** @var App\User $user */
        $user = Auth::user();
        $token = $user->createToken('Auth_Token');

        return Response()->json(['message' => 'Login Successful', 'user' => Auth::user(), 'token' => $token->accessToken], 400);
    }

    public function update(Request $request) {
        $validatedInput = $request->validate([
            'name' => 'max:' . Constants::MAX_NAME_LENGTH,
            'description' => 'max:' . Constants::MAX_DESCRIPTION_LENGTH,
            'phone' => 'max:' . Constants::MAX_PHONE_LENGTH,
            'password' => 'confirmed|min:' . Constants::MIN_PASSWORD_LENGTH,
            'professional' => 'boolean',
            'profession_id' => [Rule::requiredIf($request->professional == true), 'exists:professions,id'],
            'photo' => '',
            'cover' => ''
        ]);

        $user = $request->user()->fill($validatedInput)->save();

        return Response()->json(['message' => 'Update Successful', 'user' => Auth::user()]);
    }
}
