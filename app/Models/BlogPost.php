<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content_raw', 'category_id', 'slug', 'excerpt', 'is_published', 'published_at', 'user_id'];

    public function category(){
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');//Ураа наконец-то получилось разобратся, теперь я про
    }
}
