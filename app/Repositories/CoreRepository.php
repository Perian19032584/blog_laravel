<?php
namespace App\Repositories;

abstract class CoreRepository{

    protected $model;

    public function __construct(){
        $this->model = app($this->getModelClass());//Создание пустого обьекта данной модели
    }
    abstract protected function getModelClass();

    protected function startCondition(){
        return clone $this->model;//Чтобы не сохранялся обьект делается клон
    }

}
