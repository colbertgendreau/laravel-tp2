<?php

namespace Database\Factories;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */ 
    public function definition()
    {
        return [
            // 'title' => $this->faker->sentence,
            'title' => $this->faker->catchPhrase(),
            'title_fr' => $this->faker->sentence,
            // 'body' => $this->faker->paragraph(20),
            'body' => $this->faker->realText($maxNbChars = 500, $indexSize = 2),
            'body_fr' => $this->faker->paragraph(20),
            'user_id' => User::factory(),
            // 'categories_id' => $this->faker->numberBetween(1, 4)
            'categories_id' => Category::all()->random()->id
        ];
    }
}
