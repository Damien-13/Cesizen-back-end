<?php

namespace Tests\Unit;

use App\Models\RelationType;
use App\Models\article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelationTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_article_categorie_belongs_to_many_articles(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $relation_type = RelationType::factory()->create();
        article::factory()->count(1)->create([
            'relation_type_id' => $relation_type->id,
        ]);

        // Act
        $articles = $relation_type->ressources;

        // Assert
        $this->assertCount(1, $ressources);
        $this->assertInstanceOf(article::class, $ressources->first());
    }
}
