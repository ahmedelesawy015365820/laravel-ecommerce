<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
        if($this->method() == 'PUT' || $this->method() == 'PATCH'){

            return [
                'name' => "required|max:255|unique:product_categories,name,". $this->product_category->id,
                    'status' => 'required',
                    'category_id' => 'required',
                    'cover' => 'mimes:jpg,jpeg,png|max:2000',
            ];

        }elseif($this->method() == 'POST'){

            return [
                'name' => "required|max:255|unique:product_categories,name",
                    'status' => 'required',
                    'category_id' => 'required',
                    'cover' => 'required|mimes:jpg,jpeg,png|max:2000'
            ];
        }

        

    }
}
