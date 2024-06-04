<?php

namespace App\Repositories;

use App\Models\User;

class UserRespository
{
  public function all()
  {
    return User::all();
  }

  public function find(string $id)
  {
    return User::find($id);
  }

  public function create(array $data)
  {
    return User::create($data);
  }

  public function update(string $id, array $data)
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
}
