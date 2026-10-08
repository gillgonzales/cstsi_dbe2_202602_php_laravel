<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/ola',function () {
//     echo "Olá Mundo !!!";
// });

Route::get('/ola',[HomeController::class,'index']);

Route::prefix('/produtos')->group(function () {
    Route::get('/', [ProdutoController::class, 'index'])->name("produto.index");
    Route::get('/{id}',[ProdutoController::class, 'show'])->name("produto.show");
});

Route::prefix('/produto')->group(function () {
    Route::get('/',[ProdutoController::class, 'create'] )->name("produto.create");
    Route::post('/',[ProdutoController::class, 'store'])->name("produto.store");
    Route::get('/{id}/edit',[ProdutoController::class, 'edit'])->name("produto.edit");
    Route::post('/{id}/update',[ProdutoController::class, 'update'])->name("produto.update");
    Route::get('{id}/delete',[ProdutoController::class,'delete'])->name('produto.remove');
});
