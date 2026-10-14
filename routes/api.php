<?php

use App\Http\Controllers\Api\FornecedorController;
use App\Http\Controllers\Api\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function(){
    Route::apiResource('produtos',ProdutoController::class);
    Route::apiResource('fornecedores',FornecedorController::class)
        ->parameters([
            'fornecedores'=>'fornecedor'
        ]);
});
