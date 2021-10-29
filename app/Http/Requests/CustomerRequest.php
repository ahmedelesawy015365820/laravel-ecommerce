<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'first_name'    => 'required',
                    'last_name'     => 'required',
                    'username'      => 'required|max:20|unique:customers',
                    'email'         => 'required|email|max:255|unique:customers',
                    'mobile'        => 'required|numeric|unique:customers',
                    'status'        => 'required',
                    'password'      => 'required|min:8',
                    'customer_image'    => 'nullable|mimes:jpg,jpeg,png,svg|max:2000'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'first_name'    => 'required',
                    'last_name'     => 'required',
                    'username'      => 'required|max:20|unique:customers,username,'.$this->customer->id,
                    'email'         => 'required|email|max:255|unique:customers,email,'.$this->customer->id,
                    'mobile'        => 'required|numeric|unique:customers,mobile,'.$this->customer->id,
                    'status'        => 'required',
                    'password'      => 'nullable|min:8',
                    'customer_image'    => 'nullable|mimes:jpg,jpeg,png,svg|max:2000'
                ];
            }
            default: break;
        }
    }
}
