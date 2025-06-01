<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciceRespirationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nomExercice' => $this->faker->sentence(3),
            'duree_inspiration' => $this->faker->numberBetween(2, 6),
            'duree_expiration' => $this->faker->numberBetween(2, 6),
            'duree_apnee' => $this->faker->numberBetween(0, 6),
            'nombre_repetitions' => $this->faker->numberBetween(3, 10),
        ];
    }
}
