<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UserResourceCollection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        try {
            return new UserResource(User::create($request->validated()))
                ->additional(['message' => "Usuário criado com sucesso!!!"]);
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao cadastrar novo user.", $error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $auth_user = $request->user();
        try{
            if ($auth_user->id != $user->id)
                throw new Exception("Não tem permissão para modificar o recurso!!");
            return [$user, $request->user()];
        }catch(Exception $error){
             return $this->errorHandler(
                "Não autorizado!!!",
                $error,
                403
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        return [$user, $request->user()];
    }
}
