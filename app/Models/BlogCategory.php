<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BlogCategory extends Model
{
    use HasFactory;

    protected $table = "block_categories";

    protected $fillable = ['title', 'slug', 'parent_id', 'description'];

    public function parentCategory(){
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }
    public function getTitleAttribute($data){
        return 123;
    }
    public function setTitleAttribute($data){//Не работает
        $this->attributes['title'] = $data . "+ еще какой-то текст который мы добавили через мутатор";
    }



}
