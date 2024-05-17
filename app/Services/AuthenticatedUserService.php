<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AuthenticatedUserService
{
  /**
   * Obtém o usuário autenticado a partir da cache ou sessão.
   * Se não encontrar, busca pelo método Auth::user().
   *
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   */
  public static function getAuthenticatedUser()
  {
    $cacheKey = 'authenticated_user';
    $user = Cache::get($cacheKey);

    if (!$user) {
      $user = Session::get('authenticated_user');
    }

    if (!$user) {
      $user = Auth::user();
      Cache::put($cacheKey, $user, now()->addMinutes(10)); // Armazena o usuário na cache por 10 minutos
      Session::put('authenticated_user', $user); // Armazena o usuário na sessão
    }

    return $user;
  }
}
