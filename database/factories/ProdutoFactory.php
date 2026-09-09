<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'=>fake()->sentence(3),
            'descricao'=>fake()->sentence(),
            'qtd_estoque'=>fake()->numberBetween(1,100),
            'preco'=>fake()->randomFloat(2, 1, 100),
            'importado' => fake()->boolean()
        ];
    }
}
