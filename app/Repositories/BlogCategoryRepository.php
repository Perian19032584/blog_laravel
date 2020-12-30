<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;

class BlogCategoryRepository extends CoreRepository{

    protected function getModelClass(){
        return Model::class;//Получить путь модели
    }

    public function getEdit($id){
        return $this->startCondition()->find($id);//Если не найдет возвращает 404
    }
    public function getFormComboBox(){
         return $this->startCondition()->toBase()->get();//toBase - если просто получить данные, (оптимизация)

    }
    public function getAllWithPaginate($col=null){
        return $this->startCondition()->select('id', 'title', 'parent_id')->with(['parentCategory:id,title'])->paginate($col);
    }


}
