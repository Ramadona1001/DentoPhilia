<?php

namespace Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestUpdate extends FormRequest
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
            'password' => 'confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => transWord('Name').' '.transWord('is required'),
            'password.confirmed' => transWord('Password does not match'),
        ];
    }
}
