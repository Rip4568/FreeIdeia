<?php

namespace App\Repositories;

use App\Models\Post;

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
    return Post::create($data);
  }

  public function update(string $id, array $data)
  {
    return Post::where('id', $id)->update($data);
  }

  public function delete(string $id)
  {
    return Post::where('id', $id)->delete();
  }
}
