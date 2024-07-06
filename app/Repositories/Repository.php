<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
  protected string $model;

  public function __construct()
  {
    $this->model = $this->getModelClass();
  }

  abstract protected function getModelClass(): string;

  public function create(array $data): Model
  {
    return $this->model::create($data);
  }

  public function update(int $item, array $data): Model
  {
    $item = $this->model::findOrFail($item);

    $item->update($data);

    return $item;
  }

  public function delete(int $item): bool
  {
    return $this->model::delete($item);
  }

  public function find(int $id): ?Model
  {
    return $this->model::find($id);
  }

  public function findOrFail(int $id): Model
  {
    return $this->model::findOrFail($id);
  }

  public function all()
  {
    return $this->model::all();
  }
}
