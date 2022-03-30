<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Interaction;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InteractionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $interaction = ['like', 'dislike'];
        $status = $interaction[rand(0,1)];
        $blogID = rand(1,100);
        $userID = rand(1,100);
        $blog = Blog::withoutGlobalScope('user_id')->find($blogID);

        if($status == 'like'){
            $blog->total_likes++;
        } else {$blog->total_likes++;}
        $blog->save();
        
        return [
            'blog_id' => $blogID,
            'user_id' => $userID,
            'interaction' =>  $status,
        ];
                
    }
}
