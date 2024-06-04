<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Str;

class PostRepository
{
  public function all()
  {
    return Post::orderBy('created_at', 'desc')->get();
  }

  public function find(string $id)
  {
    return Post::find($id);
  }

  public function create(array $data)
  {
    $data['slug'] = $this->generateUniqueSlug($data['title']);
    return Post::create($data);
  }

  public function update(string $id, array $data)
  {
    if (isset($data['title'])) {
      $data['slug'] = $this->generateUniqueSlug($data['title']);
    }
    return Post::where('id', $id)->update($data);
  }

  public function delete(string $id)
  {
    return Post::where('id', $id)->delete();
  }

  private function generateUniqueSlug($title)
  {
    $slug = Str::slug($title);
    $originalSlug = $slug;
    $count = 2;

    while (Post::where('slug', $slug)->exists()) {
      $slug = $originalSlug . '-' . $count++;
    }

    return $slug;
  }
}
