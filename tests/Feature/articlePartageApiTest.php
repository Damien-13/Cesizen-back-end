<?php

namespace Tests\Feature;

use App\Models\article;
use App\Models\articlePartage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class articlePartageApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_article_partages(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $userActif = User::factory()->create(['actif' => 1]);
        $userInactif = User::factory()->create(['actif' => 0]);

        $article = article::factory()->create();
        $partageActif = articlePartage::factory()->create([
            'user_id' => $userActif->id,
            'article_id' => $article->id,
        ]);
        $partageInactif = articlePartage::factory()->create([
            'user_id' => $userInactif->id,
            'article_id' => $article->id,
        ]);

        // Act
        $response = $this->getJson('/api/article_partages');

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Liste des articles récupérée avec succès',
            ])
            ->assertJsonFragment([
                'id' => $partageActif->id,
            ])
            ->assertJsonMissing([
                'id' => $partageInactif->id,
            ]);
    }

    public function test_can_filter_article_partages_by_article_id(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $user = User::factory()->create(['actif' => 1]);
        $article1 = article::factory()->create();
        $article2 = article::factory()->create();

        $partage1 = articlePartage::factory()->create([
            'user_id' => $user->id,
            'article_id' => $article1->id,
        ]);
        $partage2 = articlePartage::factory()->create([
            'user_id' => $user->id,
            'article_id' => $article2->id,
        ]);

        // Act
        $response = $this->getJson('/api/article_partages?article_id=' . $article1->id);

        // Assert
        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $partage1->id,
            ])
            ->assertJsonMissing([
                'id' => $partage2->id,
            ]);
    }

    public function test_can_store_article_partage(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $user = User::factory()->create(['actif' => 1]);
        $article = article::factory()->create();

        $payload = [
            'article_id' => $article->id,
            'email_destinataire' => $user->email,
        ];

        // Act
        $response = $this->postJson('/api/article_partages', $payload);

        // Assert
        $response->assertStatus(201)
            ->assertJson([
                'status' => true,
                'message' => 'Partage de ressouce ajouté avec succès',
            ]);

        $this->assertDatabaseHas('article_partages', [
            'article_id' => $article->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_cannot_store_partage_with_nonexistent_user(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $article = article::factory()->create();

        $payload = [
            'article_id' => $article->id,
            'email_destinataire' => 'inexistant@mail.com',
        ];

        // Act
        $response = $this->postJson('/api/article_partages', $payload);

        // Assert
        $response->assertStatus(422);
    }

    public function test_cannot_store_partage_for_inactive_user(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $user = User::factory()->create(['actif' => 0]);
        $article = article::factory()->create();

        $payload = [
            'article_id' => $article->id,
            'email_destinataire' => $user->email,
        ];

        // Act
        $response = $this->postJson('/api/article_partages', $payload);

        // Assert
        $response->assertStatus(404)
            ->assertJson([
                'status' => false,
                'message' => 'Aucun utilisateur trouvé avec cet email.',
            ]);
    }

    public function test_can_delete_article_partage(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $articlePartage = articlePartage::factory()->create();

        // Act
        $response = $this->deleteJson('/api/article_partages/' . $articlePartage->id);

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Partage de article supprimé avec succès',
            ]);

        $this->assertDatabaseMissing('article_partages', [
            'id' => $articlePartage->id,
        ]);
    }
}
