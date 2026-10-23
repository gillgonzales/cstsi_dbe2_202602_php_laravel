<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LoginTokensController;
use App\Http\Controllers\Api\FornecedorController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['auth:sanctum']);


Route::prefix('v1')->group(function () {

    Route::apiResource('produtos', ProdutoController::class)
        ->middleware('auth:sanctum');

    Route::apiResource('produtos', ProdutoController::class)
        ->only(['index', 'show']);

    // Route::apiResource('produtos', ProdutoController::class)
    //     ->except(['index', 'show'])
    //     ->middleware('auth:sanctum');

    Route::apiResource('fornecedores', FornecedorController::class)
        ->parameters([
            'fornecedores' => 'fornecedor'
        ]);
    Route::apiResource('users', UserController::class);

    Route::apiResource('users', UserController::class)
        ->only(['update', 'destroy'])
        ->middleware('auth:sanctum');

    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('user', [LoginController::class, 'user'])->middleware('auth:sanctum');


    Route::prefix('tokens')->group(function () {
        Route::post('login', [LoginTokensController::class, 'login']);
    });
});
