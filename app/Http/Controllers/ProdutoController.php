<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Exception;
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
        // dd(Produto::find($id));
        try{
            $produto = Produto::findOrFail($id);
            // dd($produto);
            return view('produtos.show', compact('produto'));
        }catch(Exception $error){
            dd($error->getMessage());
        }
    }
}
