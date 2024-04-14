<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\Auth\AuthException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        if (!$user)
            throw AuthException::InternalServerErrorException();

        $token = auth()->login($user);
        return response()->success($this->respondWithToken($token, $user));
    }

    public function login(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->validated()))
            throw AuthException::InvalidLoginCredentialsException();

        return response()->success($this->respondWithToken($token, auth()->user()));
    }

    public function logout()
    {
        auth()->logout();
        return response()->success(null);
    }

    protected function respondWithToken($token, $user)
    {
        return [
            'access_token' => $token,
            'user' => $user,
            'token_type' => 'bearer',
            'expires_in' => '30d'
            //'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
