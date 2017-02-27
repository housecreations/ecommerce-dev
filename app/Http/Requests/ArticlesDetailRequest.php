<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticlesDetailRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     * 'article_id', 'color', 'size', 'stock', 'discount', 'price'
     * @return array
     */
    public function rules()
    {
        return [
            'article_id' => 'required',
            'color' => 'required',
            'size' => 'required',
            'stock' => 'required',
            'discount' => 'required',
            'price' => 'required',
            'image' => 'required'
        ];
    }
}
