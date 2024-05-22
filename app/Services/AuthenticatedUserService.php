<?php

namespace App\Services;

use App\Models\User;
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
  public static function getAuthenticatedUser(): User
  {
    $cacheKey = 'authenticated_user_' . session()->getId();
    $user = Cache::get($cacheKey); //pegue o user da cache

    if (!$user) {
      /* se não encontra, pegue o user da session */
      $user = Session::get('authenticated_user');
    }

    if (!$user) {
      /* se tabem não encontra, pegue o usario autenticado pelo Auth fazendo
       * uma busca no BD */
      $user = Auth::user();
      /* apos a busca aramazene o usuario na cache
      por 10 minutos para melhorar o desempenho (se estiver configurado) */
      Cache::put($cacheKey, $user, now()->addMinutes(10)); // Armazena o usuário na cache por 10 minutos

      Session::put('authenticated_user', $user); // Armazena o usuário na sessão
    }

    return $user;
  }
}
