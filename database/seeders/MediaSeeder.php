<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use App\Models\Media;
use App\Models\Produto;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         try {

            $totalProduto = Produto::count();
            $totalFornecedor = Fornecedor::count();

            $createdAt = Carbon::now()->toDateTimeString();
            $modelProdutoId = fake()->numberBetween(1,$totalProduto);
            $modelFornecedorId = fake()->numberBetween(1,$totalFornecedor);
            $produtoModelType = Produto::class;
            $fornecedorModelType = Fornecedor::class;
            $medias = [
                [
                    'mediable_id'  =>  $modelProdutoId,
                    'mediable_type'=>  $produtoModelType,
                    'source'    =>  'https://www.youtube.com/watch?v=QAfTYrDhdHE',
                    'type'      =>  'video',
                    'created_at'=>  $createdAt,
                    'updated_at'=>  $createdAt
                ],
                [
                    'mediable_id'  =>   $modelProdutoId,
                    'mediable_type'=>  $produtoModelType,
                    'source'    =>  'https://www.youtube.com/watch?v=5s-_SnVl-1g',
                    'type'      =>  'video',
                    'created_at'=>  $createdAt,
                    'updated_at'=>  $createdAt
                ],
                [
                    'mediable_id'  =>  $modelFornecedorId,
                    'mediable_type'=>  $fornecedorModelType,
                    'source'    =>  'https://www.youtube.com/watch?v=127ng7botO4',
                    'type'      =>  'video',
                    'created_at'=>  $createdAt,
                    'updated_at'=>  $createdAt
                ],
                [
                    'mediable_id'  =>  $modelFornecedorId,
                    'mediable_type'=>  $fornecedorModelType,
                    'source'    =>  'https://www.youtube.com/watch?v=veSLRzmOfAI',
                    'type'      =>  'video',
                    'created_at'=>  $createdAt,
                    'updated_at'=>  $createdAt
                ],
                [
                    'mediable_id'  =>  $modelFornecedorId,
                    'mediable_type'=>  $fornecedorModelType,
                    'source'    =>  'https://www.youtube.com/watch?v=sBIkA95t1wM',
                    'type'      =>  'video',
                    'created_at'=>  $createdAt,
                    'updated_at'=>  $createdAt
                ],
            ];

            Media::insert($medias)
                ? Log::channel('stderr')->info("Vídeos cadastrados! Fornecedor: $modelFornecedorId | Produto: $modelProdutoId")
                : throw new Exception("Erro ao criar medias!");

        } catch(Exception $error) {
            Log::debug($error->getMessage());
            Log::channel('stderr')->error($error->getMessage());
        }
    }
}
