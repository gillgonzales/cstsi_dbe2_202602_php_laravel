<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nomes = ['Placa de Vídeo RTX', 'AMD Radeon GPU', 'Placa Gráfica Gamer', 'Memória', 'PC Gamer', 'Placa Mãe', 'GPU Gamer'];
        return [
            "source" => fake()->imageUrl(360, 360, fake()->bothify(fake()->randomElement($nomes) . ' ####', true))
        ];
    }
}
