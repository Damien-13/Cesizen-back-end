<?php

namespace Database\Seeders;

use App\Models\articleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class articleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        articleType::create([
            'lib_article_type' => 'texte',
            'visible' => true
        ]);
    }
}
