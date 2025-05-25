<?php

namespace Tests\Unit;

use App\Models\article;
use App\Models\articleType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class articleTypeTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_article_type_belongs_to_many_ressources(): void
    {
        // Arrange
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
        $type = articleType::factory()->create();
        article::factory()->count(2)->create([
            'article_type_id' => $type->id,
        ]);

        // Act
        $ressources = $type->ressources;

        // Assert
        $this->assertCount(2, $ressources);
        $this->assertInstanceOf(article::class, $ressources->first());
    }
}
