<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index() {
        $produtos = Produto::all();
        // dd($produtos);
        // return response()->json(["data"=>$produtos]);//JSON
        return view('produtos.index',["produtos"=>$produtos]);
    }

    public function show($id){
        //TODO
    }
}
