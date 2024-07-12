<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
  protected $model = Post::class;

  static private function generateUniqueSlug($title)
  {
    $slug = Str::slug($title);
    $originalSlug = $slug;
    $count = 2;

    while (Post::whereSlug($slug)->exists()) {
      $slug = $originalSlug . '-' . $count++;
    }

    return $slug;
  }

  public function definition()
  {
    $user = User::inRandomOrder()->first();
    if (!$user) {
      $user = User::factory()->create();
    }

    $title = $this->faker->sentence();
    $slug = $this->generateUniqueSlug($title);
    
    return [
      'user_id' => $user->id,
      'title' => $title,
      'slug' => $slug,
      'content' => $this->faker->paragraph(),
      'banner' => $this->faker->imageUrl(),
    ];
  }
}
