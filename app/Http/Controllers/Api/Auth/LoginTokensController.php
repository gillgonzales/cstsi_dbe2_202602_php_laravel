<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\Request;

class LoginTokensController extends LoginController
{
    public function login(LoginRequest $request) : UserResource
    {
        try {
            $credentials = $request->validated();
            $user = $this->authenticate($credentials);
            $ability = [];
            if($user->is_admin)
                $ability = ['is_admin'];
            $token = $user->createToken($user->email,$ability)->plainTextToken;
            return new UserResource($user)
                ->additional([
                    "message" => "Logado via tokens!!!",
                    "token"=>$token
                    ]);
        } catch (Exception $error) {
            $this->errorHandler("Erro ao efetuar o login!!!", $error);
        }
    }
}
