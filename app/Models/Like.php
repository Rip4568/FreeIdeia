<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  /* Como funciona o sistema Like: A existencia dele ou não
   * ligado com a chave estrangeira (user_id, post_id)
   * sendo eles unico para cada usuário e post
   * ja determina que a quantidade de likes
   */
  use HasFactory;

  protected $table = 'likes';

  protected $fillable = ['user_id', 'post_id'];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function post()
  {
    return $this->belongsTo(Post::class, 'post_id');
  }
}
