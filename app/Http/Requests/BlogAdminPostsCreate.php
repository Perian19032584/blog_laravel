<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogAdminPostsCreate extends FormRequest{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => 'required|min:5|max:200',
            'slug' => 'max:200',
            'excerpt' => 'max:500',
            'content_raw' => 'required|string|min:5|max:100000',
            'category_id' => 'required|integer|exists:block_categories,id',
        ];

    }
    public function messages()
    {
        return [
            'title.required' => 'Введите заголовок статьи',
            'content_raw.min' => 'Минимальная длина [:min] символов',
        ];
    }
}
