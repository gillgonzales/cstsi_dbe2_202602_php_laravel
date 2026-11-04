<?php

namespace Database\Factories;

use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Fornecedor>
 */
class FornecedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nome" => fake()->company(),
            "descricao" => fake()->sentence(),
            "cnpj" => fake()->cnpj(),
            "email" => fake()->companyEmail(),
            "estado_id" => fake()->numberBetween(1, 27),
            "telefone" => fake()->cellphoneNumber(),
            "endereco" => fake()->sentence(3) . ' nr:' . fake()->randomNumber(4, false)
        ];
    }
}
