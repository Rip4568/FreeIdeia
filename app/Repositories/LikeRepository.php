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
  public function index(
    ?string $userId = null,
    ?string $postId = null,
    ?array $with = ['user', 'post'],
    ?string $orderByColumn = 'post_id',
    ?string $orderByDirection = 'asc'
  ) {
    $query = Like::query()->with($with);
    $likesByPost = $query->withCount('post');
    $likesByUser = $query->withCount('user');

    if ($userId) {
      $query->where('user_id', $userId);
    }

    if ($postId) {
      $query->where('post_id', $postId);
    }

    return $query
      ->orderBy($orderByColumn, $orderByDirection)
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
