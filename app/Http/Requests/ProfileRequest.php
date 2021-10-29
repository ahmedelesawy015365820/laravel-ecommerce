<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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

        if($this->method() == 'PUT' || $this->method() == 'PATCH')
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => "required|email|unique:users,email,{$this->profile->id}",
                'password' => 'same:confirm-password',
                'image' => 'image:mimes,png,jepg,jpg'
            ];

    }
}
