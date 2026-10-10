<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdutoResource;
use App\Http\Resources\ProdutoResourceCollection;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 5;
        if ($request->has('perPage'))
            $perPage = $request->perPage;
        $produtos = Produto::paginate(perPage: $perPage, page: $request->page)
            ->appends(['perPage' => $request->perPage]);
        return new ProdutoResourceCollection($produtos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => "required | min:5",
                'descricao' => "required | max:500",
                'qtd_estoque' => "required | integer | min:1",
                'preco' => "required | numeric | min:1.99",
                'importado' => "nullable | boolean"

            ]);

            $produto = $request->all();
            $produto['importado'] = $request->has('importado');

            return response()->json([
                "data" =>  Produto::create($produto),
                "message" => 'Produto criado !!!'
            ], 201);
        } catch (\Exception $error) {
            $httpStatus = 500;
            if ($error instanceof ValidationException) throw $error;
            return response()->json(
                [
                    "error" => true,
                    "message" => $error->getMessage()
                ],
                $httpStatus
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return new ProdutoResource($produto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
