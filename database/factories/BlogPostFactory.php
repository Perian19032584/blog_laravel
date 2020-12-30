<?php

//    Не получилось розобратся

use Faker\Generator as Faker;
use Illuminate\Support\Str;

//$factory = new Faker;

$factory->define(\App\Models\BlogPost::class, function (Faker $faker){
    $title = $faker->sentence(rand(3, 8), true);//от 3 до 8 предложений
    $txt = $faker->realText(rand(1000, 4000));//в realText это количество символов
    $isPublished = rand(1, 5) > 1;

    $create_at = $faker->dateTimeBetween('-3 months', '-2 months');

    $data = [
        'category_id' => rand(1, 10),
        'user_id' => (rand(1, 5) == 5) ? 1 : 2,
        'title' => $title,//Заголовок
        'slug' => Str::slug($title),
        'excerpt' => $faker->text(rand(40, 100)),//Породить текст похоже на real text(и сколько символов)
        'content_raw' => $txt,
        'content_html' => $txt,
        'is_published' => $isPublished,
        'published_at' => $isPublished ? $faker->dateTimeBetween('-2 months', '-1 days') : null,//Если опубликовано оно дает дату или null(дату какую-то 2 месяца назад или -1 день назад 'вчера')
        'created_at' => $create_at,
        'updated_at' => $create_at,
    ];
    return $data;

});

