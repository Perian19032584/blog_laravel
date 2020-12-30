<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
//Теперь это главный контроллер - правильная запись
abstract class BaseController extends Controller
{
    use SoftDeletes;//Добавляет where и теперь deleted_at(где есть) не показывается
}
