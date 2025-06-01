<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministrerSeeder extends Seeder
{
    public function run(): void
    {
        // Exemple : on fait que l'utilisateur 1 administre les 3 premiers exercices
        $relations = [
            ['id_utilisateur' => 1, 'id_exercice_respiration' => 1],
            ['id_utilisateur' => 1, 'id_exercice_respiration' => 2],
            ['id_utilisateur' => 2, 'id_exercice_respiration' => 3],
        ];


        DB::table('administrer')->insert($relations);
    }
}
