<?php

namespace Database\Factories;

use App\Models\Jogo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jogo>
 */
class JogoFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Jogo::class;
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word
        ];
    }
}
