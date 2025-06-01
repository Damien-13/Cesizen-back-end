<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciceRespirationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('exercice_respiration')->insert([
            [
                'nomExercice' => 'Cohérence cardiaque 365',
                'duree_inspiration' => 5,
                'duree_expiration' => 5,
                'duree_apnee' => 0,
                'nombre_repetitions' => 6,
            ],
            [
                'nomExercice' => 'Respiration carrée',
                'duree_inspiration' => 4,
                'duree_expiration' => 4,
                'duree_apnee' => 4,
                'nombre_repetitions' => 5,
            ],
            [
                'nomExercice' => 'Respiration profonde relaxante',
                'duree_inspiration' => 4,
                'duree_expiration' => 6,
                'duree_apnee' => 2,
                'nombre_repetitions' => 8,
            ],
            [
                'nomExercice' => 'Relaxation 4-7-8',
                'duree_inspiration' => 4,
                'duree_expiration' => 8,
                'duree_apnee' => 7,
                'nombre_repetitions' => 4,
            ],
            [
                'nomExercice' => 'Respiration énergisante matinale',
                'duree_inspiration' => 6,
                'duree_expiration' => 4,
                'duree_apnee' => 0,
                'nombre_repetitions' => 6,
            ],
            [
                'nomExercice' => 'Respiration anti-stress express',
                'duree_inspiration' => 4,
                'duree_expiration' => 6,
                'duree_apnee' => 1,
                'nombre_repetitions' => 5,
            ],
            [
                'nomExercice' => 'Cycle apnée courte',
                'duree_inspiration' => 5,
                'duree_expiration' => 5,
                'duree_apnee' => 3,
                'nombre_repetitions' => 6,
            ],
            [
                'nomExercice' => 'Routine avant sommeil',
                'duree_inspiration' => 4,
                'duree_expiration' => 8,
                'duree_apnee' => 2,
                'nombre_repetitions' => 7,
            ],
            [
                'nomExercice' => 'Détente diaphragmatique',
                'duree_inspiration' => 3,
                'duree_expiration' => 5,
                'duree_apnee' => 0,
                'nombre_repetitions' => 5,
            ],
            [
                'nomExercice' => 'Respiration alternée zen',
                'duree_inspiration' => 5,
                'duree_expiration' => 5,
                'duree_apnee' => 2,
                'nombre_repetitions' => 6,
            ],
        ]);
    }
}
