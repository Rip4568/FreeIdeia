<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
  private PostRepository $postRespository;

  public function __construct(PostRepository $postRespository)
  {
    $this->postRespository = $postRespository;
  }


  public function index(
    ?array $with = ['user', 'comments'],
    ?string $text = null,
    ?string $orderByColumn = 'created_at',
    ?string $orderByDirection = 'desc',
  ) {
    return $this->postRespository->index(
      with: $with,
      text: $text,
      orderByColumn: $orderByColumn,
      orderByDirection: $orderByDirection
    );
  }

  public function create(array $data)
  {
    return $this->postRespository->create($data);
  }

  public function update(string $id, array $data)
  {
    return $this->postRespository->update($id, $data);
  }

  public function delete(string $id)
  {
    return $this->postRespository->delete($id);
  }

  public function find(string $id)
  {
    return $this->postRespository->find($id);
  }
}
