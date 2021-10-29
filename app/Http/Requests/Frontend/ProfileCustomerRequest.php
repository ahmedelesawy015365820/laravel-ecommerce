<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ProfileCustomerRequest extends FormRequest
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
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:customers,email,'.auth()->guard('customer')->user()->id],
            'mobile' => ['required', 'numeric', 'unique:customers,mobile,'.auth()->guard('customer')->user()->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'customer_image' => ['nullable', 'mimes:jpg,jpeg,png,svg', 'max:10000']
        ];
    }

    public function attributes()
    {
        return [
            'customer_image' => 'Profile image',
        ];
    }
}
