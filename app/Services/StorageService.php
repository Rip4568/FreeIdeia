<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageService
{
  const STORAGE_NAME = 'public';
  const STORAGE_PATH_POSTS_BANNERS = '/posts/banners';
  const STORAGE_PATH_USERS_AVATARS = '/users/avatars';
  private $storage;
  public function __construct()
  {
    $this->storage = Storage::disk(self::STORAGE_NAME);
  }

  /**
   * @param $file o arquivo bruto que sera armazenado
   * @param $pathToBeSaved deve ser escolhido dentre as contantes declaradas da propria classe StorageService::
   * @return string sera retornada a url do arquivo que esta armazenada, pode ser salvo em um campo de banco de dados ou ate mesmo entregar para o usuario acessar */
  public function storeFile(
    UploadedFile $file,
    string $pathToBeSaved
  ): string {
    $path = $this->storage->put(
      $pathToBeSaved,
      $file,
      self::STORAGE_NAME
    );
    $fileUrl = url(self::STORAGE_NAME, 'storage', $path);
    return $fileUrl;
  }

  public function updateFile($oldPath, $newFile, string $newPath): string
  {
    if ($this->storage->exists($oldPath)) {
      $this->storage->delete($oldPath);
    }
    return $this->storeFile($newFile, $newPath);
  }

  public function deleteFile($pathToDelete): bool
  {
    if ($this->storage->exists($pathToDelete)) {
      return $this->storage->delete($pathToDelete);
    }
    return false;
  }
}
