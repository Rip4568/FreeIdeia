<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRespository;
use Illuminate\Support\Facades\Hash;

class UserService
{
  private $userRepository;
  public function __construct(UserRespository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function create(array $data)
  {
    if (isset($data['password'])) {
      $data['password'] = Hash::make($data['password']);
    }
    return $this->userRepository->create($data);
  }

  public function update(string $id, array $data)
  {
    if (isset($data['password'])) {
      $data['password'] = Hash::make($data['password']);
    }
    return $this->userRepository->update($id, $data);
  }

  public function delete(string $id)
  {
    return $this->userRepository->delete($id);
  }

  public function find(string $id)
  {
    return $this->userRepository->find($id);
  }

  public function all()
  {
    return $this->userRepository->all();
  }
}
