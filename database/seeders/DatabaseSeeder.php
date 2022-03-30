<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Interaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //(new UserSeeder)->run();
        User::factory(100)->create();
        Blog::factory(100)->create();
        Comment::factory(100)->create();
        Interaction::factory(100)->create();
        User::factory(100)->create();
        
    }
}
