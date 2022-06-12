<?php

namespace App\Http\Requests;

use App\Rules\maxNewCategoryName;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'new-categories' => ['unique:categories,name', new maxNewCategoryName],
            'categories' => 'exists:categories,id',
            'title' => 'required|max:255',
            'abstract' => 'required|max:255',
            'content' => 'required|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'required' => '入力必須の項目です。',
            'max' => ':max文字以内で入力してください。',
            'exists' => '不正なカテゴリが含まれています',
            'unique' => 'すでに存在するカテゴリです。'
        ];
    }
}
