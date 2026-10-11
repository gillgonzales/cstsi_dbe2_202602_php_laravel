<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class ProdutoUpdatedResource extends ProdutoResource
{

    public function with(Request $request)
    {
        return ["message"=>"Produto Atualizado!!!"];
    }
}
