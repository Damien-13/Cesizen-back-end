<?php

namespace Database\Seeders;

use App\Models\RelationType;
use Illuminate\Database\Seeder;

class RelationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relationTypes = [
            ['lib_relation_type' => 'En couple', 'visible' => true],
            ['lib_relation_type' => 'Vie de famille', 'visible' => true], // inclut parent/enfant, fratrie, etc.
            ['lib_relation_type' => 'Entre collègues', 'visible' => true],
            ['lib_relation_type' => 'Avec son supérieur hiérarchique', 'visible' => true],
            ['lib_relation_type' => 'À l’école ou en formation', 'visible' => true],
            ['lib_relation_type' => 'Avec un professionnel de santé', 'visible' => true],
            ['lib_relation_type' => 'Voisinage', 'visible' => true],
            ['lib_relation_type' => 'Aidant et aidé·e', 'visible' => true],
            ['lib_relation_type' => 'Dans l’espace public', 'visible' => true],
        ];

        foreach ($relationTypes as $relationType) {
            RelationType::create($relationType);
        }
    }
}
