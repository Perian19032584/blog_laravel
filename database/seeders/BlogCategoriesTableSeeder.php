<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BlogCategoriesTableSeeder extends Seeder
{

    public function run(){
        $categories = [];

        $cName = "Без категории";
        $categories[]= [
          'title' => $cName,
          'slug' => Str::slug($cName),//Переобразовует текст из русского в агнлийский и заменяет пробел -(удобно для ссылок)
          'parent_id' => 0,
        ];

        for($i=0; $i<10; $i++){
            $cName = 'Категория #'.$i;
            $parentId = ($i > 4) ? rand(1, 4) : 1;

            $categories[] = [
                'title' => $cName,
                'slug' => Str::slug($cName),
                'parent_id' => $parentId,
            ];
        }
        DB::table('block_categories')->insert($categories);

    }
}
