<?php

namespace App\Services;

use App\Repositories\LikeRepository;

/**
 * Classe de serviço para gerenciar curtidas
 */
class LikeService
{
  /**
   * Repositório de curtidas
   *
   * @var LikeRepository
   */
  private $likeRespository;

  /**
   * Construtor da classe
   *
   * @param LikeRepository $likeRespository
   */
  public function __construct(LikeRepository $likeRespository)
  {
    $this->likeRespository = $likeRespository;
  }

  /**
   * Curte um item
   *
   * @param string $userId ID do usuário que está curtindo
   * @return mixed Resultado da operação de curtir
   */
  public function like(string $userId)
  {
    return $this->likeRespository->create([
      'user_id' => $userId,
    ]);
  }

  /**
   * Descurte um item
   *
   * @param string $likeId ID da curtida a ser removida
   * @return void
   */
  public function unlike(string $likeId)
  {
    $this->likeRespository->destroy($likeId);
  }
}
