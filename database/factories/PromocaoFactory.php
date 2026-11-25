<?php

namespace Database\Factories;

use App\Models\Promocao;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Promocao>
 */
class PromocaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inicio'=>  Carbon::now()->addMonth()->toDateTimeString(),
            'fim'=> Carbon::now()->addDays(20)->addMonth()->toDateTimeString(),
            'nome'=>fake()->word()
        ];
    }
}
