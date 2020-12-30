<?php
namespace App\Http\Controllers;


use App\Models\BlogPost;
use Carbon\Carbon;

class CollectionTestController extends Controller{

    public function index(){
        $result = [];

        $collection = BlogPost::get();//Это из бд колекция

        $data1 = $collection->toArray();
        $data2 = collect($data1);//Это у нас сапорт колекция

        $result['one']['first'] = $data2->first();
        $result['one']['last'] = $data2->last();

        $result['where']['data'] = $data2->where('category_id', 1)->values()->keyBy('id');//= идет по умолчанию | 2 параметр можно поставить < или > (не помню как называется)
                            //values - забирает ключи(ставит по умолчанию) и берет только value
                            //keyBy('название поля') - делает поле индификатором массива

        $result['where']['count'] = $result['where']['data']->count();//Количество
        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();//Полезно для проверки
        $result['first_where'] = $data2->firstWhere('title', '==', 'кукуукукку1233');//очень похожое на where и получаем 1 запись


        $result['map']['all'] = $data2->map(function ($item){//Правильная запись колекции
            //dd($item);
            $newItem = new \stdClass();//Создаем 'экс' прост класс
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            return $newItem;
        });

        $data2->transform(function ($item){//Отличие от них то что transform не создает новую коллекцию в отличии от map
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->carbon = Carbon::parse($item['created_at']);

            return $newItem;//Я Василий забыл вернуть
        });

        $newItem = new \stdClass();//Кста черточка обязательная
        $newItem->id = 999999;

        $newItem2 = new \stdClass();
        $newItem2->id = 299999;

        $newItemFirst = $data2->prepend($newItem)->first();//Добавить в начало и взять первым=)
        $newItemLast = $data2->push($newItem2)->last();
        $pull = $data2->pull(0);//Забрать 1 елемент(по сути как удалить)
        $pull = $data2->pull(4);//Забрать 1 елемент(по сути как удалить)

        //orWhere

        $filter = $data2->filter(function ($item){//Доджет быть true или false
            $byDay = $item->carbon->isFriday();//Это пятница
            $byData = $item->carbon->day == 30;

            $result = $byDay && $byData;
            return $result;
        });

        $sort = collect([5, 3, 1, 2, 4])->sort()->values();
        $sortBy = $data2->sortBy('created_at');
        $sortByDesc = $data2->sortByDesc('item_id');//С конца

        dd($sortByDesc);
    }
}
