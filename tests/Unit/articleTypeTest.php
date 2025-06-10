<?php

namespace Tests\Unit;

use App\Models\article;
use App\Models\articleType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class articleTypeTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_article_type_belongs_to_many_articles(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $type = articleType::factory()->create();
        article::factory()->count(2)->create([
            'article_type_id' => $type->id,
        ]);

        // Act
        $articles = $type->articles;

        // Assert
        $this->assertCount(2, $articles);
        $this->assertInstanceOf(article::class, $articles->first());
    }
}
