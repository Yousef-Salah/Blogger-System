<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,100),
            'title' => $this->faker->sentence(),
            'text' => $this->faker->text(),
            'total_comments' => 0,
            'total_likes' => 0,
            'total_dislikes' => 0,
            
            'image'=> $this->faker->imageUrl(),
        ];
    }
}
