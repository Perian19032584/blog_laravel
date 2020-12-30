<?php
namespace App\Repositories;
use App\Models\BlogPost as Model;

class BlogPostRepository extends CoreRepository{

    protected function getModelClass(){
        return Model::class;
    }

    protected $select = ['id', 'title', 'slug', 'is_published', 'published_at', 'user_id', 'category_id', 'content_raw', 'excerpt'];

    public function getAllWithPaginate($col=null){
        return $this->startCondition()->select($this->select)->orderBy('id', 'DESC')->with([
            'category' => function ($query){
                $query->select('id', 'title');
            },
            'user:id,name',

        ])->paginate($col);
    } //with - говорит типо загрузи из моделей методы со связами(лучшая оптимизация) которую стоит запомнить

    public function getEdit($id){
        return $this->startCondition()->select($this->select)->find($id);
    }
}
