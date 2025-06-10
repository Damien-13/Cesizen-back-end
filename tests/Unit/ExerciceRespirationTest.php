<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ExerciceRespiration;

class ExerciceRespirationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function les_exercices_sont_bien_ordonnes_du_plus_recent_au_plus_ancien()
    {
        // Crée 3 exercices en base avec des ID croissants
        $exo1 = ExerciceRespiration::factory()->create(['id_exercice_respiration' => 1, 'nomExercice' => 'Exo 1']);
        $exo2 = ExerciceRespiration::factory()->create(['id_exercice_respiration' => 2, 'nomExercice' => 'Exo 2']);
        $exo3 = ExerciceRespiration::factory()->create(['id_exercice_respiration' => 3, 'nomExercice' => 'Exo 3']);

        // Reproduire la requête de la méthode index()
        $exercices = ExerciceRespiration::select(
            'id_exercice_respiration',
            'nomExercice',
            'duree_inspiration',
            'duree_expiration',
            'duree_apnee',
            'nombre_repetitions'
        )
        ->orderByDesc('id_exercice_respiration')
        ->get();

        // Vérifie que les ID sont dans l’ordre attendu
        $this->assertEquals([3, 2, 1], $exercices->pluck('id_exercice_respiration')->toArray());
    }
}
