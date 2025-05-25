<?php

namespace Database\Factories;

use App\Models\article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\articlePartage>
 */
class articlePartageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'article_id' => article::factory(),
            'user_id' => User::factory(),
        ];
    }
}
