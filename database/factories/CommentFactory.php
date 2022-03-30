<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $blogID = rand(1,100);
        $userID = rand(1,100);

        $blog = Blog::withoutGlobalScope('user_id')->find($blogID);
        $blog->total_comments++;
        $blog->save();
        return [
            'comment' => $this->faker->sentence(),
            'user_id' => $userID,
            'blog_id' => $blogID,
        ];
    }
}
