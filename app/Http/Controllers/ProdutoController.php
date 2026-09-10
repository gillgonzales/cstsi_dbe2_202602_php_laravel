<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        // dd($produtos);
        // return response()->json(["data"=>$produtos]);//JSON
        return view('produtos.index', ["produtos" => $produtos]);
        // return View::make('produtos.index',["produtos"=>$produtos]);
    }

    public function show(int $id)
    {
        //TODO
        // dd(Produto::find($id));
        try {
            $produto = Produto::findOrFail($id);
            // dd($produto);
            return view('produtos.show', compact('produto'));
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $novoProduto = $request->all();
        $novoProduto['importado'] = $request->has('importado');
        // dd($novoProduto);
        if (Produto::create($novoProduto)) { //fillable configurado
            return redirect('/produtos');
        }
        dd("Erro ao criar produto!");
    }

    public function edit(int $id)
    {
        try {
            $produto = Produto::findOrFail($id);
            // dd(compact('produto'));
            return view('produtos.edit', compact('produto'));
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function update(Request $request, int $id)
    {
        // dd($request->all());
        $produtoAtualizado = $request->all();
        $produtoAtualizado['importado'] = $request->has('importado');
        // dd($produtoAtualizado);
        if (Produto::find($id)->update($produtoAtualizado)) { //fillable configurado
            return redirect('/produtos');
        }
        dd("Erro ao atualizar produto!");
    }

    public function delete(int $id) {

        try {
            Produto::destroy($id);
            return redirect('/produtos');
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }
}
