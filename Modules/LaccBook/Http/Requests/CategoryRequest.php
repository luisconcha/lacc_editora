<?php

namespace LaccBook\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $idCategory = ($this->route('category')) ? $this->route('category') : null;

        return [
            'name' => "required|max:100|unique:categories,name,$idCategory",
        ];
    }
}