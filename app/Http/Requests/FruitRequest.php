<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FruitRequest extends FormRequest {
    /**
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'fruitId' => ['required'],
            'breedId' => ['required'],
            'memo' => ['max:255']
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'fruitId' => '果物',
            'breedId' => '品種',
            'memo' => 'メモ'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeを入力してください。',
            'max' => ':attributeは:max文字以下で入力してください。'
        ];

    }
}
