<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class GetAllPostRequest extends FormRequest
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
            'page' => [
                'min:1',
                'integer'
            ],
            'limit' => [
                'min:1',
                'integer'
            ],
            'categories' => [
                'array'
            ],
            'categories.*' => [
                'integer',
                'exists:categories,id'
            ]
        ];
    }
}
