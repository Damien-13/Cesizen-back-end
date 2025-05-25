<?php

namespace Tests\Unit;

use App\Models\RelationType;
use App\Models\article;
use App\Models\articleCategorie;
use App\Models\articleType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class articleTest extends TestCase
{
    use RefreshDatabase;

    public function test_article_belong_relations(): void
    {
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        
        // Arrange
        $user = User::factory()->create();
        $categorie = articleCategorie::factory()->create();
        $type = articleType::factory()->create();
        $relation = RelationType::factory()->create();
        $article = article::factory()->create([
            'user_id' => $user->id,
            'article_categorie_id' => $categorie->id,
            'article_type_id' => $type->id,
            'relation_type_id' => $relation->id,
        ]);

        // Act & Assert : vérifier chaque relation

        // User
        $this->assertInstanceOf(User::class, $article->user);
        $this->assertEquals($user->id, $article->user->id);

        // articleCategorie
        $this->assertInstanceOf(articleCategorie::class, $article->articleCategorie);
        $this->assertEquals($categorie->id, $article->articleCategorie->id);

        // articleType
        $this->assertInstanceOf(articleType::class, $article->articleType);
        $this->assertEquals($type->id, $article->articleType->id);

        // RelationType
        $this->assertInstanceOf(RelationType::class, $article->relationType);
        $this->assertEquals($relation->id, $article->relationType->id);
    }
}
