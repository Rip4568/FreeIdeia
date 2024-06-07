<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    if (isset($data['banner']) && $data['banner'] instanceof UploadedFile) {
      $bannerValidated = Storage::disk('public')->put('banners', $data['banner']);
      $data['banner'] = $bannerValidated;
    }

    return Post::create($data);
  }

  public function update(string $id, array $data)
  {
    if (isset($data['title'])) {
      $data['slug'] = $this->generateUniqueSlug($data['title']);
    }

    if(isset($data['banner']) && $data['banner'] instanceof UploadedFile) {
      Storage::delete($data['banner']);
      $bannerUpdated = $data['banner']->store('banners', 'public');
      $data['banner'] = $bannerUpdated;
    }
    
    return Post::where('id', $id)->update($data);
  }

  public function delete(string $id)
  {
    return Post::where('id', $id)->delete();
  }

  static private function generateUniqueSlug($title)
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
