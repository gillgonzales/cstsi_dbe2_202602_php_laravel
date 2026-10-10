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

Route::controller(ProdutoController::class)->group(function(){
    Route::get('/produtos','index')->name("produto.index");
    Route::get('/produtos/{produto}','show')->name("produto.show");
    Route::get('/produto','create')->name("produto.create");
    Route::post('/produto','store')->name("produto.store");
    Route::get('/produto/{id}/edit','edit')->name("produto.edit");
    Route::post('/produto/{id}/update','update')->name("produto.update");
    Route::get('/produto/{id}/delete',[ProdutoController::class,'delete'])->name('produto.remove');
});
