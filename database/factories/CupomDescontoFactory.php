<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CupomDesconto>
 */
class CupomDescontoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = \App\Models\CupomDesconto::class;


    public function definition(): array
    {
        $codigo = $this->faker->numberBetween(5, 50);
        return [
            'nm_cupom' => $this->faker->unique()->word . $codigo, // Nome do cupom
            'porc_desconto' => $codigo // Desconto entre 5% e 50%
        ];
    }
}
