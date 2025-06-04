<?php

namespace Database\Seeders;

use App\Models\articleCategorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['lib_article_categorie' => 'Santé mentale', 'visible' => true],
            ['lib_article_categorie' => 'Émotions', 'visible' => true],
            ['lib_article_categorie' => 'Gestion du stress', 'visible' => true],
            ['lib_article_categorie' => 'Relaxation', 'visible' => true],
        ];

        foreach ($categories as $categorie) {
            articleCategorie::create($categorie);
        }
    }
}
