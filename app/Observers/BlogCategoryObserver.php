<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryObserver
{

    public function creating(BlogCategory $blogCategory){//Срабатывает до save
        $this->setSlug($blogCategory);
    }

    protected function setSlug(BlogCategory $blogCategory){
        if(empty($blogCategory->slug)){
            $blogCategory->slug = Str::slug($blogCategory->title);
        }
    }
    public function updating(BlogCategory $blogCategory){
        $this->setSlug($blogCategory);
    }


    public function created(BlogCategory $blogCategory){//Выполняется логика до сохранения

    }


    public function updated(BlogCategory $blogCategory){//Выполняется логика до обновление
        //
    }


    public function deleted(BlogCategory $blogCategory){//Выполняется логика до удаление
        //
    }


    public function restored(BlogCategory $blogCategory){//Выполняется логика до востановление
        //
    }


    public function forceDeleted(BlogCategory $blogCategory){//Когда на прямую удаляют
        //
    }
}
