<?php

use App\Http\Controllers\CollectionTestController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\Admin\CategoryController;
use App\Http\Controllers\Blog\Admin\PostController as AdminPostController;


Route::get('/', function (){
   return view('welcome');
});

Auth::routes();
Route::group(['prefix' => 'blog'], function (){
    Route::resource('posts', PostController::class)->names('blog.post');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin/blog'], function (){
    $method = ['index', 'edit', 'store', 'update', 'create'];
    Route::resource('categories', CategoryController::class)->only($method)->names('blog.admin.categories');//Какие методы в роутах будет(only)
    Route::resource('posts', AdminPostController::class)->except(['show'])->names('blog.admin.posts');//except - кроме метода show
});

//namespace - Для контроллеров чтобы не прописывать под каждым Папку\Контроллер
Route::group(['prefix' => 'collections'], function(){
    Route::get('/', [CollectionTestController::class, 'index'])->name('collections');
});
