<?php

namespace Database\Factories;

use App\Models\ExerciceRespiration;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdministrerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_utilisateur' => User::inRandomOrder()->first()->id ?? User::factory(),
            'id_exercice_respiration' => ExerciceRespiration::inRandomOrder()->first()->id_exercice_respiration ?? ExerciceRespiration::factory(),
        ];
    }
}
