<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoStoreRequest;
use App\Http\Resources\ProdutoResource;
use App\Http\Resources\ProdutoResourceCollection;
use App\Http\Resources\ProdutoStoredResource;
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
    public function store(ProdutoStoreRequest $request)
    {
        try {
            return new ProdutoStoredResource(Produto::create($request->validated()));
        } catch (\Exception $error) {
            $httpStatus = 500;
            $message = "Não foi possível criar o Produto!!! Tente mais tarde.";
            $response = [
                "error" => true,
                "message" => $message
            ];
            if (env("APP_DEBUG"))
                $response = [
                    ...$response,
                    "exception" => $error->getMessage(),
                    "trace" => $error->getTrace()
                ];
            return  response()->json($response, $httpStatus);
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
