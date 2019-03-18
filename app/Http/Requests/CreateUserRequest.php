<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:15|regex:/^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/|confirmed',
        ];
    }

    public function messages(){
        return  [
            'email.email' => __('validation.email'),
            'email.unique' => __('validation.unique'),
            'password.confirmed' => __('validation.confirmed'),
            'password.regex' => __('validation.regex'),
            'password.max' => __('validation.max.string'),
            'password.min' => __('validation.min.string'),
        ];
    }
}
