<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "content",
        "user_id",
        "banner"
    ];

    protected $appends = ['banner_url'];

    public function getBannerUrlAttribute() 
    {
        return $this->banner ? asset('storage/' . $this->banner) : null;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
