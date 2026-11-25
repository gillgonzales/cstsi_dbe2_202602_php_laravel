<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use App\Models\Produto;
use App\Models\Promocao;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fornecedor::factory(5)
            ->has(
                Produto::factory(5)
                    ->hasAttached(
                        Promocao::factory()->count(3),
                        [
                            'created_at' => Carbon::now()->toDateTimeString(),
                            'updated_at' => Carbon::now()->toDateTimeString(),
                            'desconto' => fake()->numberBetween(10, 50)
                        ],
                        'promocoes'
                    )
                    ->hasMedias(2)
            )
            ->hasMedias(2)
            ->hasProdutos(5)
            ->create();
    }
}
