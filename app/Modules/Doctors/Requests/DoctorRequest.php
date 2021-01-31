<?php

namespace Doctors\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'username' => 'required|unique:users,username',
            'faculty' => 'required',
            'start_date' => 'required',
            'address' => 'required',
            'bio' => 'required'
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
            'faculty.required' => transWord('Faculty').' '.transWord('is required'),
            'start_date.required' => transWord('Start Study Date').' '.transWord('is required'),
            'address.required' => transWord('Address').' '.transWord('is required'),
            'bio.required' => transWord('BIO').' '.transWord('is required'),
        ];
    }
}
