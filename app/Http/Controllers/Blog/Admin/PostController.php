<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogAdminPostsCreate;
use App\Http\Requests\BlogAdminPostsUpdate;
use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    private $blogPostRepository;
    private $blogCategoryRepository;

    public function __construct(){
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }


    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate(25);
        return view('blog.admin.posts.index', compact('paginator'));
    }


    public function create()
    {
        $item = new BlogPost();
        $categoryList = $this->blogCategoryRepository->getFormComboBox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }


    public function store(BlogAdminPostsCreate $request)
    {

        $item = new BlogPost($request->all());
        $item['user_id'] = Auth::user() != null ? Auth::user()->id : 1;

        $item->save();

        if($item){
            return redirect()->route('blog.admin.posts.edit', $item->id)->with('success', 'Успешно добавлено');
        }else{
            session()->flash('msg', 'Произошла ошибка..');
            return back()->withInput();
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        $categoryList = $this->blogCategoryRepository->getFormComboBox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }


    public function update(BlogAdminPostsUpdate $request, $id)
    {

        $item = $this->blogPostRepository->getEdit($id);

        if(empty($item)){
            session()->flash('msg', 'Произошла ошибка..');
            return back()->withInput();
        }

        $result = $item->update($request->all());

        if($result){
            return redirect()->route('blog.admin.posts.edit', $item->id)->with('success', 'Успешно сохранено');
        }else{
            session()->flash('msg', 'Произошла ошибка..');
            return back()->withInput();
        }
    }


    public function destroy($id)
    {
        $result = BlogPost::destroy($id);

        if($result){
            return redirect()->route('blog.admin.posts.index')->with('success', 'Запись была успешно удалена');
        }else{
            session()->flash('msg', 'Произошла ошибка удаление..');
            return back();
        }
    }
}
