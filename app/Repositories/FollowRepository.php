<?php

use App\Models\User;

class FollowRepository
{
  private $authenticatedUser;

  public function __construct($authenticatedUser)
  {
    $this->authenticatedUser = $authenticatedUser;
  }
  public function follow(User $user)
  {
    return $this->authenticatedUser->following()->attach($user->id);
  }

  public function unfollow(User $user)
  {
    return $this->authenticatedUser->following()->detach($user->id);
  }

  public function isFollowing(User $user)
  {
    return $this->authenticatedUser->following->contains($user->id);
  }

  /**
   * Obtenha os usuários que estão seguindo o usuário autenticado.
   *
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public function getFollowers()
  {
    return $this->authenticatedUser->followers()->get();
  }

  /**
   * Pegue todos os usuários que o usuario autenticado está seguindo.
   *
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public function getFollowing()
  {
    return $this->authenticatedUser->following()->get();
  }

}
