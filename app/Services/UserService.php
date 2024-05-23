<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRespository;

class UserService
{
  private UserRespository $userRepository;
  public function __construct(UserRespository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function create(array $data)
  {
    return $this->userRepository->create($data);
  }

  public function update(string $id, array $data)
  {
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
