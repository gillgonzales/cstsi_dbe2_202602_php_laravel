<?php

namespace Tests\Unit\Api\PHPUnit;

use App\Models\Produto;
use PHPUnit\Framework\TestCase;

use Illuminate\Database\Capsule\Manager as Capsule;

class ModelProdutoTest extends TestCase
{

    private function startConnectionForEloquent(): void
    {

        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => env('DB_CONNECTION'),
            'host'      => env('DB_HOST'),
            'database'  => env('DB_DATABASE'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD')
        ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }


    public function test_create_eloquent_model_of_produto(): void
    {
        //ARRANGE
        $this->startConnectionForEloquent();
        $protudoTest = [
            "nome" => "Distinctio ut qui.",
            "descricao" => "Suscipit consequatur quas sint eos omnis.",
            "qtd_estoque" => 3,
            "preco" => 6.14,
            "importado" => true,
        ];

        //ACT
        $result = Produto::factory()->create($protudoTest);

        //ASSERT
        $this->assertIsObject($result);
    }
}
