<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
  protected string $model = Model::class;

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

  public function getBy(array $criteria, array $orderBy = [], int $perPage = null)
  {
    $query = $this->model->query();

    foreach ($criteria as $field => $value) {
      $method = $this->getQueryMethod($field);
      $query->$method($field, $value);
    }

    foreach ($orderBy as $field => $direction) {
      $query->orderBy($field, $direction);
    }

    return $perPage ? $query->paginate($perPage) : $query->get();
  }

  protected function getQueryMethod(string $field): string
  {
    $customMethods = $this->getCustomQueryMethods();
    return $customMethods[$field] ?? 'where';
  }

  protected function getCustomQueryMethods(): array
  {
    return [
      'name' => 'whereLike',
      'email' => 'whereLike',
      'created_at' => 'whereDate',
    ];
  }

  public function scopeWhereLike($query, $field, $value)
  {
    return $query->where($field, 'LIKE', "%{$value}%");
  }
}
