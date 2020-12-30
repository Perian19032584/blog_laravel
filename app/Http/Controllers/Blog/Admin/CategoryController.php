<?php

namespace App\Http\Controllers\Blog\Admin;


use App\Http\Requests\BlogAdminCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{

    private $blogCategoryRepository;

    public function __construct(){
        parent::__construct();//Только вот это я не понял
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    public function index()
    {
//        $item = $this->blogCategoryRepository->getEdit(1);
//        //dd($item);
//        $v['test1'] = $item->title;//Мы в первую очередь попадает в акссесор(по названию поля) | getTitleAttribute
//                                  //Правильное название обязательно getНазвание_поляAttribute + название идет в заголовок метода
//
//        $item->title = 'Какой-то текст ';
//        $v['test2'] = $item->title;


        $pagination = $this->blogCategoryRepository->getAllWithPaginate(5);
        return view('blog.admin.category.index', compact('pagination'));
    }

    public function create(){

        $item = new BlogCategory();//Это просто гениально создать пустой класс и использовать при создании
        $categoryList = $this->blogCategoryRepository->getFormComboBox();//BlogCategory::all();

        return view('blog.admin.category.edit', compact('item', 'categoryList'));
    }



    public function store(BlogAdminCategoryUpdateRequest $request){

        $item = new BlogCategory($request->all());//Переобразить в обьект
        $item->save();//Оно сохраняет только в обьекте

        if($item){
            return redirect()->route('blog.admin.categories.edit', $item->id)->with('success', 'Успешно добавлено');
        }else{
            session()->flash('msg', 'Произошла ошибка..');
            return back()->withInput();
        }

    }


    public function edit($id)
    {

        $item = $this->blogCategoryRepository->getEdit($id);

        //dd(collect($item)->pluck('slug'));//Колекция поиск по ключу, почему-то оно видит только когда оно в массиве
        $categoryList = $this->blogCategoryRepository->getFormComboBox();

        return view('blog.admin.category.edit', compact('item', 'categoryList'));
    }


    public function update(BlogAdminCategoryUpdateRequest $request, $id)
    {


        $item = $this->blogCategoryRepository->getEdit($id);

        if(empty($item)){
            session()->flash('msg', 'Произошла ошибка..');
            return back()->withInput();//Какая-то альтернатива flash?
            //withInput - тот input который пришел верни назад, по типу old
        }

        //$result = $item->fill($data)->save();//fill вместо форича, удобная фича(она заменяет текст который я получаю в виде обьекта)
        $result = $item->update($request->all());


        if($result){
            return redirect()->route('blog.admin.categories.edit', $item->id)->with('success', 'Успешно сохранено');
        }else{
            session()->flash('msg', 'Произошла ошибка..');
            return back()->withInput();
        }
    }

}
