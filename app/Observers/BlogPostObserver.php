<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{

    protected function setPublishedAt(BlogPost $blogPost){
        if(empty($blogPost->published_at) && $blogPost->is_published){
            $blogPost->published_at = Carbon::now();
        }
    }
    protected function setSlug(BlogPost $blogPost){
        if(empty($blogPost->slug)){
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }
    protected function setContent_html(BlogPost $blogPost){
        if(empty($blogPost->content_html)){
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    public function creating(BlogPost $blogPost){
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setContent_html($blogPost);
    }
    public function deleting(){
        dd('Я обсервер, я не дам тебе удалить');
    }


    public function updating(BlogPost $blogPost){//Идет во время updated(до)
     ;
//        $test[] = $blogPost->isDirty(); - узнать изменялась ли модель(даст true если хоть одно поле изменилось)
//        $test[] = $blogPost->isDirty('is_published'); - для одного поля
//        $test[] = $blogPost->getAttribute('is_published'); - получить значени которые летят в базу(текущоее)
//        $test[] = $blogPost->getOriginal('is_published'); - получить значение которые были до


        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }


    public function created(BlogPost $blogPost){
        //
    }

    public function updated(BlogPost $blogPost){//Работает после сохранение

    }


    public function deleted(BlogPost $blogPost){
        //
    }


    public function restored(BlogPost $blogPost){
        //
    }

    public function forceDeleted(BlogPost $blogPost){
        //
    }
}
