<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProdutoRepository implements RepositoryInterface
{
    public function all(): Collection
    {
        return Produto::all();
    }

    public function findById(int $id): ?Produto
    {
        return Produto::findOrfail($id)->load('promocoes', 'fornecedor.estado.regiao');
    }

    public function create(array $data): ?Produto
    {
        if (!isset($data['imagem']))
            return Produto::create($data);

        $novoProduto = Produto::create($data);
        $novoProduto->medias()->create([
            'source' => $data['imagem']
        ]);
        return $novoProduto;
    }

    public function filter(Request $request): ?Collection
    {
        $importado = $request->has('importado') ? $request->importado : 0;
        $min = $request->has('min') ? $request->min : 1;
        $max = $request->has('max') ? $request->max : 99999;
        $queryBuilderFilter = Produto::with('fornecedor.estado.regiao');

        if ($request->filled('nome'))
            $queryBuilderFilter->where('nome', 'like', "%$request->nome%");

        $request->anyFilled(['min', 'max']) && $queryBuilderFilter->whereBetween('preco', [$min, $max]);

        $request->filled('regiao') && $queryBuilderFilter->porRegiao($request->regiao);

        $request->filled('importado') && $queryBuilderFilter->importados($importado);

        return $queryBuilderFilter->get();
    }
}
