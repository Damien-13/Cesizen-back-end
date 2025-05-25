<?php

namespace Tests\Feature;

use App\Models\RelationType;
use App\Models\article;
use App\Models\articleCategorie;
use App\Models\articleType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class articleApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_articles(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        article::factory()->count(3)->create();

        // Act
        $response = $this->getJson('/api/articles');

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Liste des articles récupérée avec succès',
            ])
            ->assertJsonCount(3, 'data');
    }

    public function test_can_filter_articles_by_valide(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        article::factory()->create(['valide' => true]);
        article::factory()->create(['valide' => false]);

        // Act
        $response = $this->getJson('/api/articles?valide=true');

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Liste des articles récupérée avec succès',
            ])
            ->assertJsonFragment(['valide' => 1])
            ->assertJsonMissing(['valide' => 0]);
    }

    public function test_can_store_article(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $user = User::factory()->create();
        $categorie = articleCategorie::factory()->create();
        $type = articleType::factory()->create();
        $relation = RelationType::factory()->create();

        $payload = [
            'titre' => 'Test titre',
            'description' => 'Description de test',
            'nom_fichier' => 'test.pdf',
            'restreint' => false,
            'url' => 'https://test.com',
            'valide' => true,
            'user_id' => $user->id,
            'article_categorie_id' => $categorie->id,
            'article_type_id' => $type->id,
            'relation_type_id' => $relation->id,
        ];

        // Act
        $response = $this->postJson('/api/articles', $payload);

        // Assert
        $response->assertStatus(201)
            ->assertJson([
                'status' => true,
                'message' => 'article ajoutée avec succès',
                'data' => [
                    'titre' => 'Test titre',
                ],
            ]);

        $this->assertDatabaseHas('articles', [
            'titre' => 'Test titre',
        ]);
    }

    public function test_can_show_article(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $article = article::factory()->create();

        // Act
        $response = $this->getJson("/api/articles/{$article->id}");

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'article trouvée avec succès',
                'data' => [
                    'id' => $article->id,
                ],
            ]);
    }

    public function test_can_update_article(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $article = article::factory()->create();
        $user = User::factory()->create();
        $categorie = articleCategorie::factory()->create();
        $type = articleType::factory()->create();
        $relation = RelationType::factory()->create();

        $payload = [
            'titre' => 'Titre modifié',
            'description' => 'Description modifiée',
            'nom_fichier' => 'updated.pdf',
            'restreint' => true,
            'url' => 'https://updated.com',
            'valide' => false,
            'user_id' => $user->id,
            'article_categorie_id' => $categorie->id,
            'article_type_id' => $type->id,
            'relation_type_id' => $relation->id,
        ];

        // Act
        $response = $this->putJson("/api/articles/{$article->id}", $payload);

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'article modifiée avec succès',
                'data' => [
                    'titre' => 'Titre modifié',
                ],
            ]);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'titre' => 'Titre modifié',
        ]);
    }

    public function test_can_delete_article(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $article = article::factory()->create();

        // Act
        $response = $this->deleteJson("/api/articles/{$article->id}");

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'article supprimée avec succès',
            ]);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
        ]);
    }
}
