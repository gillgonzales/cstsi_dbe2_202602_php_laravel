<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected function authenticate(array $credentials) : User
    {
        if (Auth::attempt($credentials))
            return User::where('email', $credentials['email'])->first();
        else
            throw new Exception("Dados inválidos!!!");
    }


    public function login(LoginRequest $request): UserResource
    {
        try {
            $credentials = $request->validated();
            $user = $this->authenticate($credentials);
            return new UserResource($user)
                ->additional(["message"=>"Logado via cookies!!!"]);
        } catch (Exception $error) {
            $this->errorHandler("Erro ao efetuar o login!!!", $error);
        }
    }

    public function user(Request $request){
        return $request->user();
    }
}
