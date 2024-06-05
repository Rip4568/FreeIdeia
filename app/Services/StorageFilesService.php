<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageFilesService
{
  public static function isUploadedFile($file) {
    return $file instanceof UploadedFile;
  }
}
