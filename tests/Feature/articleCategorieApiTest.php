<?php

namespace Tests\Feature;

use App\Models\article;
use App\Models\articleCategorie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class articleCategorieApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_article_categories(): void
    {
        //Arrange
        articleCategorie::factory()->count(3)->create();

        //Act
        $response = $this->getJson('/api/article_categories');

        //Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    '*' => ['id', 'lib_article_categorie', 'visible', 'created_at', 'updated_at']
                ]
            ]);
    }

    public function test_can_list_by_visible(): void
    {
        //Arrange
        articleCategorie::factory()->create(['visible' => true]);
        articleCategorie::factory()->create(['visible' => false]);

        //Act
        $response = $this->getJson('/api/article_categories?visible=true');

        //Assert
        $response->assertStatus(200)
            ->assertJsonFragment(['visible' => 1])
            ->assertJsonMissing(['visible' => 0]);
    }

    public function test_can_store_article_categorie(): void
    {
        //Arrange
        $payload = [
            'lib_article_categorie' => 'Images',
            'visible' => true,
        ];

        //Act
        $response = $this->postJson('/api/article_categories', $payload);

        //Assert
        $response->assertStatus(201)
            ->assertJson([
                'status' => true,
                'message' => 'Catégorie de article ajoutée avec succès',
                'data' => [
                    'lib_article_categorie' => 'Images',
                    'visible' => 1,
                ]
            ]);

        $this->assertDatabaseHas('article_categories', [
            'lib_article_categorie' => 'Images',
            'visible' => 1,
        ]);
    }

    public function test_can_show_article_categorie(): void
    {
        //Arrange
        $categorie = articleCategorie::factory()->create([
            'lib_article_categorie' => 'PDF',
            'visible' => true,
        ]);

        //Act
        $response = $this->getJson("/api/article_categories/{$categorie->id}");

        //Assert
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Catégorie de article trouvée avec succès',
            ])
            ->assertJsonStructure([
                'data'
            ]);
    }

    public function test_can_update_article_categorie(): void
    {
        //Arrange
        $categorie = articleCategorie::factory()->create([
            'lib_article_categorie' => 'Video',
            'visible' => true,
        ]);

        $payload = [
            'lib_article_categorie' => 'Video Updated',
            'visible' => false,
        ];

        //Act
        $response = $this->putJson("/api/article_categories/{$categorie->id}", $payload);

        //Assert
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Catégorie de article modifiée avec succès',
                'data' => [
                    'id' => $categorie->id,
                    'lib_article_categorie' => 'Video Updated',
                    'visible' => 0,
                ]
            ]);

        $this->assertDatabaseHas('article_categories', [
            'id' => $categorie->id,
            'lib_article_categorie' => 'Video Updated',
            'visible' => 0,
        ]);
    }

    public function test_can_delete_article_categorie(): void
    {
        //Arrange
        $categorie = articleCategorie::factory()->create();

        //Act
        $response = $this->deleteJson("/api/article_categories/{$categorie->id}");

        //Assert
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Catégorie de article supprimée avec succès',
            ]);

        $this->assertDatabaseMissing('article_categories', [
            'id' => $categorie->id,
        ]);
    }

    public function test_cannot_delete_categorie_with_article(): void
    {
        //Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $categorie = articleCategorie::factory()->create();
        article::factory()->create(['article_categorie_id' => $categorie->id]);

        //Act
        $response = $this->deleteJson("/api/article_categories/{$categorie->id}");

        //Assert
        $response->assertStatus(400)
            ->assertJson([
                'status' => false,
                'message' => 'Cette catégorie ne peut être supprimée : elle est utilisée par une article.',
            ]);

        $this->assertDatabaseHas('article_categories', [
            'id' => $categorie->id,
        ]);
    }
}
