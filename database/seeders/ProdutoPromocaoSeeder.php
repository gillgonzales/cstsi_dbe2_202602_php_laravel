<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Promocao;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Seeder;

class ProdutoPromocaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listProdutos = Produto::all();
        $totalPromocao = Promocao::count();

        if(!$totalPromocao || !$listProdutos->count()) {
            throw new Exception('Error: registrar produtos e/ou promocoes!');
        }

        $now = Carbon::now()->toDateTimeString();
        $createUpdateAt = ['created_at'=>$now,'updated_at'=>$now];

        Log::channel('stderr')->info('Relacionando promocoes e produtos...');
        $listPromocoesIDs = Promocao::all()->pluck('id');
        $listProdutos->each(function ($produto) use ($listPromocoesIDs, $createUpdateAt) {
            [$promoId,$promoId2] = $listPromocoesIDs->random(2);
            $produto->promocoes()->attach([
                $promoId => $createUpdateAt,
                $promoId2 => $createUpdateAt,
            ]);
            Log::channel('stderr')->info("Produto: $produto->id | Promocoes: ( $promoId , $promoId2 )");
        });
    }
}
