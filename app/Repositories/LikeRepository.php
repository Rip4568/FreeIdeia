<?php

namespace App\Repositories;

use App\Models\Like;

class LikeRepository
{
  public function __construct()
  {
  }

  /**
   * Obtém todos os likes de um usuário específico em uma postagem específica.
   *
   * @param string $userId O ID do usuário.
   * @param string $postId O ID da postagem.
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public function all(string $userId, string $postId)
  {
    return Like::where('user_id', $userId)
      ->where('post_id', $postId)
      ->get();
  }

  /**
   * Obtém todos os likes de um usuário específico.
   *
   * @param string $userId O ID do usuário.
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public function allByUser(string $userId)
  {
    return Like::where('user_id', $userId)
      ->get();
  }

  /**
   * Obtém todos os likes de uma postagem específica.
   *
   * @param string $postId O ID da postagem.
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public function allByPost(string $postId)
  {
    return Like::where('post_id', $postId)
      ->get();
  }

  /**
   * Encontra um like específico pelo seu ID.
   *
   * @param string $id O ID do like.
   * @return \App\Models\Like|null
   */
  public function find(string $id)
  {
    return Like::find($id);
  }

  /**
   * Cria um novo like.
   *
   * @param array $data Os dados do like.
   * @return \App\Models\Like
   */
  public function create(array $data)
  {
    return Like::create($data);
  }

  /**
   * Exclui um like específico.
   *
   * @param int|string $id O ID do like a ser excluído.
   * @return bool
   */
  public function destroy($id)
  {
    $like = Like::find($id);
    return $like->delete();
  }
}
