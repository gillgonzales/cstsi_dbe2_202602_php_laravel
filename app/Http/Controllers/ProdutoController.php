<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProdutoController extends Controller
{
    public function index() {
        $produtos = Produto::all();
        // dd($produtos);
        // return response()->json(["data"=>$produtos]);//JSON
        return view('produtos.index',["produtos"=>$produtos]);
        // return View::make('produtos.index',["produtos"=>$produtos]);
    }

    public function show($id){
        //TODO
    }
}
