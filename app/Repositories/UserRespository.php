<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRespository
{
  public function all(): Collection
  {
    return User::all();
  }

  public function find(string $id): ?User
  {
    return User::find($id);
  }

  public function create(array $data): User
  {
    return User::create($data);
  }

  public function update(string $id, array $data): User
  {
    $user = User::find($id);
    $user->update($data);
    return $user;
  }

  public function delete($id)
  {
    $user = User::find($id);
    return $user->delete();
  }

  public function getBy(
    array $with = [
      'posts',
      'comments',
      'following',
      'followers',
      'loadFollowing',
      'notifications',
    ],
    string $username = null,
    string $name = null,
    string $email = null,
    string $orderByColumn = 'created_at',
    string $orderByDirection = 'desc',
  ) {
    $query = User::query()->with($with);

    $query->when($username, function ($query) use ($username) {
      $query->where('username', $username);
    });

    $query->when($name, function ($query) use ($name) {
      $query->where('name', $name);
    });

    $query->when($email, function ($query) use ($email) {
      $query->where('email', $email);
    });

    return $query
      ->orderBy($orderByColumn, $orderByDirection)
      ->first();
  }
}
