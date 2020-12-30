<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogAdminCategoryUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => 'required|min:5|max:200',
            'slug' => 'max:200',//unique:block_categories,slug - Проверка на уникальность поля slug
            'description' => 'string|max:500|min:3',
            'parent_id' => 'required|integer|exists:block_categories,id',
                                            //exists - обьезательное поле в бд
        ];

    }
    public function messages(){
        return [
            'title.min' => 'Минимальное количество символов 5',
        ];
    }
}
