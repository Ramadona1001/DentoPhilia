<?php

namespace Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'username' => 'required|unique:users,username'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => transWord('Name').' '.transWord('is required'),

            'email.required' => transWord('Email').' '.transWord('is required'),
            'email.email' => transWord('Email').' '.transWord('is not valid'),
            'email.unique' => transWord('Email').' '.transWord('is already exists'),

            'password.required' => transWord('Password').' '.transWord('is required'),
            'password.confirmed' => transWord('Password does not match'),

            'username.required' => transWord('Username').' '.transWord('is required'),
            'username.unique' => transWord('Username').' '.transWord('is already exists'),
        ];
    }
}
