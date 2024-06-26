<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all()
            ?? 
            Post::factory()->count(5)->create();
        foreach ($posts as $post) {
            Comment::factory()->count(10)->create([
                'post_id' => $post->id,
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
