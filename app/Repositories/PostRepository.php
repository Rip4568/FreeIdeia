<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostRepository extends Repository
{
  public function getModelClass(): string
  {
    return Post::class;
  }

  public function all()
  {
    return parent::all()->orderBy('created_at', 'desc')->get();
  }

  public function find(int $id): ?Post
  {
    return parent::find($id);
  }


  public function index(
    ?array $with = ['user', 'comments'],
    ?string $text = null,
    ?int $userId = null,
    $orderByColumn = 'created_at',
    $orderByDirection = 'desc',
  ) {
    $query = Post::query()->with($with);

    if ($text) {
      $query->where(function ($q) use ($text) {
        $q->where('title', 'like', "%{$text}%")
          ->orWhere('content', 'like', "%{$text}%");
      });
    }

    if ($userId) {
      $query->where('user_id', $userId);
    }

    return $query
      ->orderBy($orderByColumn, $orderByDirection)
      ->get();
  }


  public function paginatePosts(
    ?array $with = ['user', 'comments'],
    ?string $text = null,
    ?int $userId = null,
    $orderByColumn = 'created_at',
    $orderByDirection = 'desc',
    $paginatePerItem = 15
  ) {
    $query = Post::query()->with($with);

    if ($text) {
      $query->where(function ($q) use ($text) {
        $q->where('title', 'like', "%{$text}%")
          ->orWhere('content', 'like', "%{$text}%");
      });
    }

    if ($userId) {
      $query->where('user_id', $userId);
    }

    return $query
      ->orderBy($orderByColumn, $orderByDirection)
      ->paginate($paginatePerItem);
  }

  public function create(array $data): Post
  {
    $data['slug'] = $this->generateUniqueSlug($data['title']);

    if (isset($data['banner']) && $data['banner'] instanceof UploadedFile) {
      $bannerValidated = Storage::disk('public')->put('banners', $data['banner']);
      $data['banner'] = $bannerValidated;
    }

    return parent::create($data);
  }

  public function update($id, array $data): Post
  {
    if (isset($data['title'])) {
      $data['slug'] = $this->generateUniqueSlug($data['title']);
    }

    if (isset($data['banner']) && $data['banner'] instanceof UploadedFile) {
      Storage::delete($data['banner']);
      $bannerUpdated = $data['banner']->store('banners', 'public');
      $data['banner'] = $bannerUpdated;
    }

    return parent::update($id, $data);
  }

  public function delete(int $id): bool
  {
    return parent::delete($id);
  }

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
}
