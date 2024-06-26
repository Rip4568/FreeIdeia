<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Crie alguns usuários para associar aos posts
        $users = User::all()
            ?? 
            User::factory()->count(5)->create();

        // Crie posts para cada usuário
        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                Post::factory()->create([
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
