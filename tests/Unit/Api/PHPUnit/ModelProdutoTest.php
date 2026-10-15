<?php

namespace Tests\Unit\Api\PHPUnit;

use App\Models\Produto;
use Tests\TestCase;

class ModelProdutoTest extends TestCase
{

    public function test_create_eloquent_model_of_produto(): void
    {
        //ARRANGE
        $protudoTest = [
            "nome" => "Distinctio ut qui.",
            "descricao" => "Suscipit consequatur quas sint eos omnis.",
            "qtd_estoque" => 3,
            "preco" => 6.14,
            "importado" => true,
        ];

        //ACT
        $result = Produto::create($protudoTest);

        //ASSERT
        $this->assertIsObject($result);
    }
}
