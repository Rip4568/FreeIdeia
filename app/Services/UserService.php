<?php 
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRespository;

class UserService
{
  private UserRespository $userRepository;
  public function __construct(UserRespository $userRepository) {
    $this->userRepository = $userRepository;
  }

}