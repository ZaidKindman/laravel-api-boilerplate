<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\Auth\AuthException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\FilesService;

class AuthController extends Controller
{
    protected $filesService;

    public function __construct(FilesService $filesService)
    {
        $this->filesService = $filesService;
    }

    public function register(RegisterRequest $request)
    {


        $profile_image = "";

        if ($request->has('file')) {
            $file = $request->file('file');
            $profile_image = $this->filesService->storeProfileImage($file);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'profile_image' => $profile_image
        ]);

        //$user = User::create($request->validated());

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
