<?php

namespace Tests\Unit;

use App\Models\article;
use App\Models\articleCategorie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class articleCategorieTest extends TestCase
{
    use RefreshDatabase;

    public function test_article_categorie_belongs_to_many_articles(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $categorie = articleCategorie::factory()->create();
        article::factory()->count(3)->create([
            'article_categorie_id' => $categorie->id,
        ]);

        // Act
        $articles = $categorie->articles;

        // Assert
        $this->assertCount(3, $articles);
        $this->assertInstanceOf(article::class, $articles->first());
    }
}
