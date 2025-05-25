<?php

namespace Tests\Unit;

use App\Models\article;
use App\Models\articlePartage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class articlePartageTest extends TestCase
{
    use RefreshDatabase;

    public function test_article_partage_belongs_to_article_and_user(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $user = User::factory()->create();
        $article = article::factory()->create();
        $partage = articlePartage::factory()->create([
            'user_id' => $user->id,
            'article_id' => $article->id,
        ]);

        // Act
        $linkedarticle = $partage->article;
        $linkedDestinataire = $partage->destinataire;

        // Assert
        $this->assertInstanceOf(article::class, $linkedarticle);
        $this->assertEquals($article->id, $linkedarticle->id);

        $this->assertInstanceOf(User::class, $linkedDestinataire);
        $this->assertEquals($user->id, $linkedDestinataire->id);
    }
}
