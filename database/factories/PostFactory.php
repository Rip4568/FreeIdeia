<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
  protected $model = Post::class;

  public function definition()
  {
    $user = User::inRandomOrder()->first();
    if (!$user) {
      $user = User::factory()->create();
    }

    return [
      'user_id' => $user->id,
      'title' => $this->faker->sentence(),
      'content' => $this->faker->paragraph(),
      'banner' => $this->faker->imageUrl(),
    ];
  }
}
