<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        if ($user) {

            $token = auth()->login($user);
            return $this->respondWithToken($token, $user);
        } else {
            return response()->json(['status' => 'Error'], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            return $this->respondWithToken($token, auth()->user());
        }
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'access_token' => $token,
            'user' => $user,
            'token_type' => 'bearer',
            'expires_in' => '30d'
            //'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
